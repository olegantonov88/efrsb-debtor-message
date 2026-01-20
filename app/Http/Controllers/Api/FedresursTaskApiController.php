<?php

namespace App\Http\Controllers\Api;

use App\Enums\ParseJob\ParseJobType;
use App\Enums\ParseJob\StatusParseJob;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FedresursDebtorMessagesTaskRequest;
use App\Http\Requests\Api\FedresursMessageTablesTaskRequest;
use App\Http\Resources\ParseJob\ParseJobResource;
use App\Models\External\ExternalDebtor;
use App\Models\ParseJob;
use App\Services\FedresursTaskService;

class FedresursTaskApiController extends Controller
{
    public function enqueueDebtorMessages(FedresursDebtorMessagesTaskRequest $request, FedresursTaskService $service)
    {
        $data = $request->validated();

        $debtor = ExternalDebtor::query()->find((int) $data['debtor_id']);
        if (!$debtor) {
            return response()->json(['success' => false, 'message' => 'Должник не найден'], 404);
        }

        $userId = $data['user_id'] ?? null;

        $proxy = $data['proxy'] ?? ['use_proxy' => false, 'url' => null];

        $parseJob = ParseJob::create([
            'debtor_id' => (int) $debtor->getKey(),
            'type' => ParseJobType::DebtorMessages,
            'payload' => [],
            'user_id' => $userId,
        ]);
        $parseJob->updateStatus(StatusParseJob::CREATED);

        try {
            $task = $service->enqueueDebtorMessagesTask($debtor, $parseJob, $proxy);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка отправки в YMQ: ' . $e->getMessage(),
                'parse_job_id' => $parseJob->id,
                'parse_job' => $parseJob ? ParseJobResource::make($parseJob) : null,
            ], 502);
        }

        return response()->json([
            'success' => true,
            'message' => 'Запрос получен',
            'job_id' => (string) $task->job_id,
            'parse_job_id' => $parseJob->id,
            'parse_job' => $parseJob ? ParseJobResource::make($parseJob) : null,
        ]);
    }

    public function enqueueMessageTables(FedresursMessageTablesTaskRequest $request, FedresursTaskService $service)
    {
        $data = $request->validated();

        $proxy = $data['proxy'] ?? ['use_proxy' => false, 'url' => null];

        $userId = $data['user_id'] ?? null;

        $parseJob = ParseJob::create([
            'debtor_id' => 0,
            'type' => ParseJobType::MessageTables,
            'payload' => [],
            'user_id' => $userId,
            'callback_url' => $data['callback_url'] ?? null,
            'meeting_application_id' => $data['meeting_application_id'] ?? null,
        ]);
        $parseJob->updateStatus(StatusParseJob::CREATED);

        try {
            $task = $service->enqueueMessageTablesTask($parseJob, $data['messages'], $proxy);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка отправки в YMQ: ' . $e->getMessage(),
                'parse_job_id' => $parseJob->id,
            ], 502);
        }

        return response()->json([
            'success' => true,
            'message' => 'Запрос получен',
            'job_id' => (string) $task->job_id,
            'parse_job_id' => $parseJob->id,
        ]);
    }
}


