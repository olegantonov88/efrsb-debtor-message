<?php

namespace App\Http\Controllers\Api;

use App\Enums\ParseJob\ParseJobType;
use App\Enums\ParseJob\StatusParseJob;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FedresursDebtorUuidRequest;
use App\Models\External\ExternalDebtor;
use App\Models\External\ExternalEfrsbDebtorMessage;
use App\Models\ParseJob;
use App\Services\FedresursMessageListClient;

class FedresursApiController extends Controller
{
    public function updateDebtorUuid(FedresursDebtorUuidRequest $request, FedresursMessageListClient $client)
    {
        $data = $request->validated();

        /** @var ExternalDebtor|null $debtor */
        $debtor = ExternalDebtor::query()->find((int) $data['debtor_id']);
        if (!$debtor) {
            return response()->json([
                'success' => false,
                'message' => 'Должник не найден',
            ], 404);
        }

        // Если пришёл debtor_uuid — это callback: просто сохраняем efrsb_id
        if (!empty($data['debtor_uuid'])) {
            $debtor->setEfrsbId((string) $data['debtor_uuid']);
            $debtor->save();

            // Статус выполнения задачи фиксируется отдельным callback: /api/fedresurs/task-status

            return response()->json([
                'success' => true,
                'message' => 'efrsb_id обновлён',
                'debtor_uuid' => (string) $data['debtor_uuid'],
            ]);
        }

        $debtorInn = (string) ($debtor->getAttribute('inn') ?? $debtor->getAttribute('debtor_inn') ?? '');
        if ($debtorInn === '') {
            return response()->json([
                'success' => false,
                'message' => 'У должника не заполнен ИНН',
            ], 422);
        }

        $debtorType = $debtor->getFedresursDebtorType();

        $lastMessageUuid = ExternalEfrsbDebtorMessage::query()
            ->where('debtor_id', (int) $debtor->getKey())
            ->orderByDesc('id')
            ->value('uuid');

        $payload = [
            'debtor_id' => (int) $debtor->getKey(),
            'debtor_inn' => $debtorInn,
            // debtor_uuid = properties->efrsb_id
            'debtor_uuid' => $debtor->getEfrsbId(),
            'debtor_type' => $debtorType,
            'last_message_uuid' => $lastMessageUuid,
            'proxy' => [
                'use_proxy' => false,
                'url' => null,
            ],
        ];

        $job = ParseJob::create([
            'debtor_id' => (int) $debtor->getKey(),
            'type' => ParseJobType::FindDebtorUuid,
            'payload' => $payload,
            'user_id' => (int) $data['user_id'] ?? null,
        ]);
        $job->updateStatus(StatusParseJob::CREATED);

        try {
            $job->updateStatus(StatusParseJob::PROCESSING);

            $response = $client->findDebtorUuid($payload);
            $json = $response->json();

            $job->update([
                'payload' => [
                    ...$payload,
                    'fedresurs_response' => $json,
                    'fedresurs_http_status' => $response->status(),
                ],
            ]);

            if (!$response->successful()) {
                $job->updateStatus(StatusParseJob::ERROR, 'HTTP ' . $response->status());
                return response()->json([
                    'success' => false,
                    'message' => 'Ошибка запроса в fedresurs-message-list',
                    'http_status' => $response->status(),
                ], 502);
            }

            $newUuid = $json['debtor_uuid'] ?? null;
            if (!is_string($newUuid) || $newUuid === '') {
                $job->updateStatus(StatusParseJob::ERROR, 'debtor_uuid не получен');
                return response()->json([
                    'success' => false,
                    'message' => 'debtor_uuid не получен',
                ], 422);
            }

            // debtor_uuid = properties->efrsb_id
            $debtor->setEfrsbId($newUuid);
            $debtor->save();

            $job->updateStatus(StatusParseJob::SUCCESS);

            return response()->json([
                'success' => true,
                'message' => 'efrsb_id обновлён',
                'debtor_uuid' => $newUuid,
                'parse_job_id' => $job->id,
            ]);
        } catch (\Throwable $e) {
            $job->updateStatus(StatusParseJob::ERROR, $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ошибка обновления debtor_uuid',
            ], 500);
        }
    }
}


