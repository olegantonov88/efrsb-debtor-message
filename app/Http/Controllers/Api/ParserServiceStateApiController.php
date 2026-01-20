<?php

namespace App\Http\Controllers\Api;

use App\Enums\ParserService\ParserServiceState;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ParserServiceStateRequest;
use App\Models\FedresursTask;
use App\Models\ParserService;
use App\Events\ParserServiceUpdated;
use Illuminate\Support\Facades\Log;

class ParserServiceStateApiController extends Controller
{
    public function store(ParserServiceStateRequest $request)
    {
        $data = $request->validated();
        Log::info('service-state', $data);

        $service = ParserService::query()->find((int) $data['service_id']);
        if (!$service) {
            return response()->json(['success' => false, 'message' => 'Service not found'], 404);
        }

        $state = (string) $data['state'];
        // Требование: после завершения сервис должен быть "Ожидает",
        // а job_id показываем только в состоянии "В работе".
        $newState = $state === 'started' ? ParserServiceState::STARTED : ParserServiceState::IDLE;

        if ($state === 'started') {
            $service->update([
                'current_state' => $newState,
                'last_state_at' => now(),
                'last_job_id' => (string) $data['job_id'],
                'last_task_type' => (string) $data['task_type'],
            ]);
        } else {
            $service->update([
                'current_state' => $newState,
                'last_state_at' => now(),
                'last_job_id' => null,
                'last_task_type' => null,
            ]);
        }
        event(new ParserServiceUpdated($service->fresh()));

        // Логика статусов задач: при started помечаем processing, финальный статус — через task-status.
        if ($state === 'started') {
            FedresursTask::query()
                ->where('job_id', (string) $data['job_id'])
                ->update([
                    'status' => 'processing',
                ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'State received',
        ]);
    }
}
