<?php

namespace App\Jobs\Fedresurs;

use App\Enums\ParseJob\StatusParseJob;
use App\Models\ParseJob;
use App\Services\FedresursMessageListClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendFetchMessageTablesJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $parseJobId)
    {
    }

    public function uniqueId(): string
    {
        return 'fedresurs-fetch-message-tables-' . $this->parseJobId;
    }

    public function handle(FedresursMessageListClient $client): void
    {
        $parseJob = ParseJob::find($this->parseJobId);
        if (!$parseJob) {
            return;
        }

        try {
            $response = $client->fetchMessageTables($parseJob->payload ?? []);

            $parseJob->update([
                'payload' => [
                    ...($parseJob->payload ?? []),
                    'fedresurs_response' => $response->json(),
                    'fedresurs_http_status' => $response->status(),
                ],
            ]);

            $parseJob->updateStatus($response->successful() ? StatusParseJob::PROCESSING : StatusParseJob::ERROR);
        } catch (\Throwable $e) {
            Log::error('SendFetchMessageTablesJob failed', [
                'parse_job_id' => $parseJob->id,
                'error' => $e->getMessage(),
            ]);
            $parseJob->updateStatus(StatusParseJob::ERROR, $e->getMessage());
        }
    }
}


