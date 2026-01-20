<?php

namespace App\Http\Resources;

use App\Models\FedresursTask;
use App\Models\ParseJob;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskStatusResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\ParseJob $job */
        $job = $this->resource;

        /** @var FedresursTask|null $task */
        $task = $job->fedresursTasks->first();

        return [
            'data' => [
                'parse_job' => [
                    'id' => $job->id,
                    'public_id' => $job->public_id,
                    'debtor_id' => $job->debtor_id,
                    'type' => $job->type?->value ?? (string) $job->type,
                    'latest_status' => $job->latest_status?->value ?? (string) $job->latest_status,
                    'latest_status_name' => $job->latest_status?->name,
                    'latest_status_text' => $job->latest_status?->text(),
                    'latest_status_severity' => $job->latest_status?->severity(),
                    'latest_status_message' => $job->statuses?->getLatestStatusMessage() ?? null,
                    'statuses' => $job->statuses ? $job->statuses->getStatusesData() : [],
                    'payload' => $job->payload,
                    'created_at' => $job->created_at?->timezone('Europe/Moscow')->format('d.m.Y H:i:s'),
                    'updated_at' => $job->updated_at?->timezone('Europe/Moscow')->format('d.m.Y H:i:s'),
                ],
                'fedresurs_task' => $task ? [
                    'id' => $task->id,
                    'job_id' => $task->job_id,
                    'task_type' => $task->task_type,
                    'status' => $task->status,
                    'ymq_message_id' => $task->ymq_message_id,
                    'sent_at' => $task->sent_at?->timezone('Europe/Moscow')->format('d.m.Y H:i:s'),
                    'last_error' => $task->last_error,
                    'start_ip' => $task->start_ip,
                    'end_ip' => $task->end_ip,
                    'callback_error' => $task->callback_error,
                    'stats' => $task->stats,
                    'finished_at' => $task->finished_at?->timezone('Europe/Moscow')->format('d.m.Y H:i:s'),
                ] : null,
            ],
        ];
    }

}


