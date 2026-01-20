<?php

namespace App\Http\Controllers\Api;

use App\Enums\ParseJob\StatusParseJob;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FedresursTaskStatusRequest;
use App\Models\FedresursTask;
use App\Models\ParseJob;
use Illuminate\Support\Facades\Log;

class FedresursTaskStatusApiController extends Controller
{
    public function store(FedresursTaskStatusRequest $request)
    {
        $data = $request->validated();
        Log::info('store FedresursTask ', $data ?? []);
        $jobId = (string) $data['job_id'];
        $ok = (bool) $data['ok'];

        $task = FedresursTask::query()->where('job_id', $jobId)->first();
        if ($task) {
            $task->update([
                'ok' => $ok,
                'callback_task_type' => (string) $data['task_type'],
                'callback_debtor_id' => (int) $data['debtor_id'],
                'start_ip' => $data['start_ip'] ?? null,
                'end_ip' => $data['end_ip'] ?? null,
                'callback_error' => $data['error'] ?? null,
                'stats' => $data['stats'] ?? null,
                'finished_at' => now(),
                'status' => $ok ? 'done' : 'error',
            ]);
        }

        $parseJob = ParseJob::query()->where('public_id', $jobId)->first();
        if ($parseJob) {
            $parseJob->update([
                'debtor_id' => (int) $data['debtor_id'],
                'payload' => [
                    ...($parseJob->payload ?? []),
                    'task_status' => $data,
                ],
            ]);

            if ($ok) {
                $parseJob->updateStatus(StatusParseJob::SUCCESS);
            } else {
                $parseJob->updateStatus(StatusParseJob::ERROR, $data['error'] ?? 'Ошибка выполнения задачи');
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Статус получен',
        ]);
    }
}
