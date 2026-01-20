<?php

namespace App\Jobs\Fedresurs;

use App\Models\FedresursTask;
use App\Services\YmqPublisher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PublishFedresursTaskToYmqJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $fedresursTaskId)
    {
    }

    public function uniqueId(): string
    {
        return 'ymq-publish-fedresurs-task-' . $this->fedresursTaskId;
    }

    public function handle(YmqPublisher $publisher): void
    {
        $task = FedresursTask::find($this->fedresursTaskId);
        if (!$task) {
            return;
        }

        // уже отправлено
        if ($task->sent_at) {
            return;
        }

        $queueUrl = (string) (config('queue.connections.sqs.prefix') ?? '');
        $queueName = (string) (config('queue.connections.sqs.queue') ?? '');
        $suffix = (string) (config('queue.connections.sqs.suffix') ?? '');

        // Если prefix уже содержит полный URL очереди (редкий кейс) — используем его как есть
        if (str_contains($queueUrl, '://') && str_contains($queueUrl, '/')) {
            $computed = rtrim($queueUrl, '/');
        } else {
            $computed = rtrim((string) config('queue.connections.sqs.prefix'), '/')
                . '/'
                . ltrim($queueName, '/')
                . ($suffix ? '/' . ltrim($suffix, '/') : '');
        }

        try {
            $messageId = $publisher->sendMessage($computed, $task->payload);
            $task->update([
                'status' => 'sent',
                'ymq_message_id' => $messageId !== '' ? $messageId : null,
                'sent_at' => now(),
                'attempts' => (int) $task->attempts + 1,
                'last_error' => null,
            ]);
        } catch (\Throwable $e) {
            Log::error('PublishFedresursTaskToYmqJob failed', [
                'fedresurs_task_id' => $task->id,
                'error' => $e->getMessage(),
            ]);
            $task->update([
                'status' => 'send_error',
                'attempts' => (int) $task->attempts + 1,
                'last_error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}


