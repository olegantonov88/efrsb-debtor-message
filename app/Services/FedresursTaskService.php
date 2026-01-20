<?php

namespace App\Services;

use App\Enums\ParseJob\StatusParseJob;
use App\Models\External\ExternalDebtor;
use App\Models\External\ExternalEfrsbDebtorMessage;
use App\Models\FedresursTask;
use App\Models\ParseJob;
use Illuminate\Support\Facades\Log;

class FedresursTaskService
{
    public function __construct(private readonly YmqPublisher $publisher)
    {
    }

    /**
     * A) debtor: uuid + messages
     */
    public function enqueueDebtorMessagesTask(ExternalDebtor $debtor, ParseJob $parseJob, array $proxy): FedresursTask
    {
        $lastMessageUuid = ExternalEfrsbDebtorMessage::query()
            ->where('debtor_id', (int) $debtor->getKey())
            ->orderByDesc('id')
            ->value('uuid');

        $payload = [
            'job_id' => (string) $parseJob->public_id,
            'task_type' => 'debtor_messages',
            'payload' => [
                'debtor_id' => (int) $debtor->getKey(),
                'debtor_inn' => (string) ($debtor->getAttribute('inn') ?? $debtor->getAttribute('debtor_inn') ?? ''),
                'debtor_uuid' => $debtor->getEfrsbId(),
                'debtor_type' => $debtor->getFedresursDebtorType(),
                'last_message_uuid' => $lastMessageUuid,
                'proxy' => $proxy,
            ],
        ];

        $task = FedresursTask::create([
            'parse_job_id' => $parseJob->id,
            'job_id' => (string) $parseJob->public_id,
            'task_type' => 'debtor_messages',
            'payload' => $payload,
            'status' => 'created',
        ]);

        $parseJob->update(['payload' => $payload]);
        $parseJob->updateStatus(StatusParseJob::PROCESSING, 'Синхронная отправка в YMQ');

        $this->publishNow($task, $parseJob);

        return $task;
    }

    /**
     * B) message tables
     *
     * @param array<int,array{message_id:int,message_uuid:string}> $messages
     */
    public function enqueueMessageTablesTask(ParseJob $parseJob, array $messages, array $proxy): FedresursTask
    {
        $payload = [
            'job_id' => (string) $parseJob->public_id,
            'task_type' => 'message_tables',
            'payload' => [
                'messages' => $messages,
                'proxy' => $proxy,
            ],
        ];

        $task = FedresursTask::create([
            'parse_job_id' => $parseJob->id,
            'job_id' => (string) $parseJob->public_id,
            'task_type' => 'message_tables',
            'payload' => $payload,
            'status' => 'created',
        ]);

        $parseJob->update(['payload' => $payload]);
        $parseJob->updateStatus(StatusParseJob::PROCESSING, 'Синхронная отправка в YMQ');

        $this->publishNow($task, $parseJob);

        return $task;
    }

    private function publishNow(FedresursTask $task, ParseJob $parseJob): void
    {
        if ($task->sent_at) {
            return;
        }

        try {
            $queueUrl = $this->resolveQueueUrl();
            $messageId = $this->publisher->sendMessage($queueUrl, $task->payload);

            $task->update([
                'status' => 'sent',
                'ymq_message_id' => $messageId !== '' ? $messageId : null,
                'sent_at' => now(),
                'attempts' => (int) $task->attempts + 1,
                'last_error' => null,
            ]);
        } catch (\Throwable $e) {
            Log::error('FedresursTaskService publishNow failed', [
                'fedresurs_task_id' => $task->id,
                'error' => $e->getMessage(),
            ]);

            $task->update([
                'status' => 'send_error',
                'attempts' => (int) $task->attempts + 1,
                'last_error' => $e->getMessage(),
            ]);

            $parseJob->updateStatus(StatusParseJob::ERROR, $e->getMessage());

            // пробрасываем наверх, чтобы API сразу показал причину
            throw $e;
        }
    }

    private function resolveQueueUrl(): string
    {
        $queue = (string) config('queue.connections.sqs.queue');
        if (str_contains($queue, '://')) {
            return $queue;
        }

        $prefix = rtrim((string) config('queue.connections.sqs.prefix'), '/');
        $suffix = (string) config('queue.connections.sqs.suffix');

        return $prefix
            . '/'
            . ltrim($queue, '/')
            . ($suffix ? '/' . ltrim($suffix, '/') : '');
    }
}


