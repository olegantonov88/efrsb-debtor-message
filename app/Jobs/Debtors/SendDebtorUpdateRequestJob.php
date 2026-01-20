<?php

namespace App\Jobs\Debtors;

use App\Enums\ParseJob\StatusParseJob;
use App\Models\ParseJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendDebtorUpdateRequestJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $parseJobId)
    {
    }

    public function uniqueId(): string
    {
        return 'debtor-update-' . $this->parseJobId;
    }

    public function handle(): void
    {
        $parseJob = ParseJob::find($this->parseJobId);
        if (!$parseJob) {
            return;
        }

        $baseUrl = rtrim((string) config('services.debtor_updater.url'), '/');
        $apiKey = (string) config('services.debtor_updater.api_key');
        $timeout = (int) config('services.debtor_updater.timeout', 60);

        if ($baseUrl === '') {
            Log::error('SendDebtorUpdateRequestJob failed', [
                'parse_job_id' => $parseJob->id,
                'error' => 'DEBTOR_UPDATER_URL не задан',
            ]);
            $parseJob->updateStatus(StatusParseJob::ERROR, 'DEBTOR_UPDATER_URL не задан');
            return;
        }

        try {
            /** @var Response $response */
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ])->timeout($timeout)->post($baseUrl . '/api/debtors/update-data', [
                'debtor_id' => $parseJob->debtor_id,
            ]);

            $parseJob->update([
                'payload' => [
                    ...($parseJob->payload ?? []),
                    'debtor_updater_response' => $response->json(),
                    'debtor_updater_http_status' => $response->status(),
                ],
            ]);

            $parseJob->updateStatus($response->successful() ? StatusParseJob::PROCESSING : StatusParseJob::ERROR);
        } catch (\Throwable $e) {
            Log::error('SendDebtorUpdateRequestJob failed', [
                'parse_job_id' => $parseJob->id,
                'error' => $e->getMessage(),
            ]);
            $parseJob->updateStatus(StatusParseJob::ERROR, $e->getMessage());
        }
    }
}


