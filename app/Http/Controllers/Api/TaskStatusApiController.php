<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskStatusIndexRequest;
use App\Http\Resources\TaskStatusResource;
use App\Models\ParseJob;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskStatusApiController extends Controller
{
    public function index(TaskStatusIndexRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();

        $query = ParseJob::query()
            ->with(['fedresursTasks' => function ($q) {
                $q->orderByDesc('id')->limit(1);
            }])
            ->orderByDesc('id');

        if (!empty($data['debtor_id'])) {
            $query->where('debtor_id', (int) $data['debtor_id']);
        }

        if (!empty($data['job_id'])) {
            $jobId = (string) $data['job_id'];
            $query->where(function ($q) use ($jobId) {
                $q->where('public_id', $jobId)
                    ->orWhereHas('fedresursTasks', fn ($tq) => $tq->where('job_id', $jobId));
            });
        }

        if (!empty($data['type'])) {
            $query->where('type', (string) $data['type']);
        }

        if (!empty($data['latest_status'])) {
            $query->where('latest_status', (string) $data['latest_status']);
        }

        if (!empty($data['task_type'])) {
            $query->whereHas('fedresursTasks', fn ($tq) => $tq->where('task_type', (string) $data['task_type']));
        }

        if (!empty($data['task_status'])) {
            $query->whereHas('fedresursTasks', fn ($tq) => $tq->where('status', (string) $data['task_status']));
        }

        $perPage = (int) ($data['per_page'] ?? 25);

        return TaskStatusResource::collection($query->paginate($perPage));
    }
}
