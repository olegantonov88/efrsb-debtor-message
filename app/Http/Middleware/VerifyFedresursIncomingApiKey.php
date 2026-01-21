<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Models\FedresursTask;
use App\Models\ParseJob;
use App\Enums\ParseJob\StatusParseJob;

class VerifyFedresursIncomingApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('Authorization');

        // Убираем префикс 'Bearer ' если он есть
        $cleanApiKey = $apiKey ? preg_replace('/^Bearer\s+/i', '', $apiKey) : null;
        $expectedKey = config('services.fedresurs_message_list.incoming_api_key');

        if ($cleanApiKey !== $expectedKey) {
            // Если неверный API-ключ, но при этом пришёл callback по задачам/состоянию сервиса,
            // всё равно помечаем связанные сущности как ошибочные.
            $routeName = optional($request->route())->getName();
            $errorMessage = 'Invalid API Key';

            if ($routeName === 'api.fedresurs.task-status') {
                $jobId = (string) $request->input('job_id');

                if (!empty($jobId)) {
                    // Обновляем FedresursTask
                    FedresursTask::query()
                        ->where('job_id', $jobId)
                        ->update([
                            'ok' => false,
                            'callback_error' => $errorMessage,
                            'finished_at' => now(),
                            'status' => 'error',
                        ]);

                    // Обновляем ParseJob и его статус
                    $parseJob = ParseJob::query()->where('public_id', $jobId)->first();
                    if ($parseJob) {
                        $payloadData = $request->all();
                        $payloadData['ok'] = false;
                        $payloadData['error'] = $errorMessage;

                        $parseJob->update([
                            'payload' => [
                                ...($parseJob->payload ?? []),
                                'task_status' => $payloadData,
                            ],
                        ]);

                        $parseJob->updateStatus(StatusParseJob::ERROR, $errorMessage);
                    }
                }
            }

            if ($routeName === 'api.efrsb-message.service-state') {
                $jobId = (string) $request->input('job_id');

                if (!empty($jobId)) {
                    FedresursTask::query()
                        ->where('job_id', $jobId)
                        ->update([
                            'status' => 'error',
                        ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid API Key',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}


