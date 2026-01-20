<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EfrsbStoreMessageBodyRequest;
use App\Http\Requests\Api\EfrsbStoreMessagesRequest;
use App\Models\External\ExternalEfrsbDebtorMessage;
use App\Models\ParseJob;
use App\Enums\ParseJob\ParseJobType;
use App\Enums\ParseJob\StatusParseJob;
use App\Services\FedresursTaskService;
use App\Services\MeetingApplicationCallbackService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class EfrsbMessageApiController extends Controller
{
    public function storeMessages(EfrsbStoreMessagesRequest $request)
    {
        $data = $request->validated();
        $debtorId = (int) $data['debtor_id'];
        foreach ($data['messages'] as $message) {
            ExternalEfrsbDebtorMessage::query()->updateOrCreate(
                [
                    'debtor_id' => $debtorId,
                    'uuid' => $message['message_uuid'],
                ],
                [
                    'title' => $message['message_name'],
                    'publish_date' => $message['publish_date'] ? Carbon::parse($message['publish_date']) : null
                ]
            );
        }

        // Статус выполнения задачи фиксируется отдельным callback: /api/fedresurs/task-status

        return response()->json([
            'success' => true,
            'message' => 'Запрос получен',
        ]);
    }

    public function storeMessageBody(EfrsbStoreMessageBodyRequest $request)
    {
        try {
            $data = $request->validated();

            $decoded = base64_decode((string) $data['body_html_base64'], true);
            if ($decoded === false) {
                Log::warning('storeMessageBody: Invalid base64', [
                    'message_id' => $data['message_id'] ?? null,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Некорректный base64',
                ], 422);
            }

            $message = ExternalEfrsbDebtorMessage::query()
                ->where('id', (int) $data['message_id'])
                ->where('uuid', (string) $data['message_uuid'])
                ->first();

            if (!$message) {
                Log::warning('storeMessageBody: Message not found', [
                    'message_id' => $data['message_id'] ?? null,
                    'message_uuid' => $data['message_uuid'] ?? null,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Сообщение не найдено',
                ], 404);
            }

            $message->setAttribute('title', (string) $data['title']);
            $message->setAttribute('number', (string) $data['message_number']);
            $message->setAttribute('body_html', $data['body_html_base64']);
            $message->save();

            // Отправляем callback в meeting-application, если есть callback_url
            $parseJob = null;
            $searchMethod = null;

            // Ищем ParseJob по job_id (public_id) или meeting_application_id
            if (!empty($data['job_id'])) {
                $parseJob = ParseJob::where('public_id', $data['job_id'])->first();

                if (!$parseJob) {
                    Log::warning('storeMessageBody: ParseJob not found by job_id', [
                        'job_id' => $data['job_id'],
                    ]);
                }
            } elseif (!empty($data['meeting_application_id'])) {
                $parseJob = ParseJob::where('meeting_application_id', $data['meeting_application_id'])
                    ->where('type', ParseJobType::MessageTables)
                    ->orderBy('created_at', 'desc')
                    ->first();

                if (!$parseJob) {
                    Log::warning('storeMessageBody: ParseJob not found by meeting_application_id', [
                        'meeting_application_id' => $data['meeting_application_id'],
                    ]);
                }
            }


            // Если найден ParseJob с callback_url, отправляем callback
            if ($parseJob && $parseJob->callback_url) {
                try {
                    $callbackService = app(MeetingApplicationCallbackService::class);
                    $callbackService->sendMessageBodyCallback(
                        messageId: (int) $data['message_id'],
                        messageUuid: (string) $data['message_uuid'],
                        status: 'success',
                        error: null,
                        callbackUrl: $parseJob->callback_url,
                        meetingApplicationId: $parseJob->meeting_application_id
                    );
                } catch (\Throwable $e) {
                    Log::error('storeMessageBody: Exception while calling callback service', [
                        'message_id' => $data['message_id'],
                        'meeting_application_id' => $parseJob->meeting_application_id,
                        'callback_url' => $parseJob->callback_url,
                        'error' => $e->getMessage(),
                        'exception' => get_class($e),
                        'trace' => $e->getTraceAsString(),
                    ]);
                }
            } elseif ($parseJob && !$parseJob->callback_url) {
                Log::warning('storeMessageBody: ParseJob found but callback_url is empty', [
                    'parse_job_id' => $parseJob->id,
                    'message_id' => $data['message_id'],
                ]);
            } elseif (!$parseJob && ($data['job_id'] ?? null || $data['meeting_application_id'] ?? null)) {
                Log::warning('storeMessageBody: ParseJob not found for callback', [
                    'job_id' => $data['job_id'] ?? null,
                    'meeting_application_id' => $data['meeting_application_id'] ?? null,
                    'message_id' => $data['message_id'] ?? null,
                ]);
            }

            // Статус выполнения задачи фиксируется отдельным callback: /api/fedresurs/task-status

            return response()->json([
                'success' => true,
                'message' => 'Запрос получен',
            ]);
        } catch (\Throwable $e) {
            Log::error('storeMessageBody: Unexpected exception', [
                'error' => $e->getMessage(),
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Внутренняя ошибка сервера',
            ], 500);
        }
    }
}


