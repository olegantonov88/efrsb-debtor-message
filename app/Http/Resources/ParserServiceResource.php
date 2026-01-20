<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParserServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'base_url' => $this->base_url,
                'is_active' => (bool) $this->is_active,
                'is_available' => (bool) $this->is_available,
                'current_state' => $this->current_state?->value ?? (string) $this->current_state,
                'current_state_text' => $this->current_state?->text() ?? (string) $this->current_state,
                'http_enabled' => $this->http_enabled,
                'ymq_enabled' => $this->ymq_enabled,
                'last_ping_at' => $this->last_ping_at?->timezone('Europe/Moscow')->format('d.m.Y H:i:s'),
                'last_ping_error' => $this->last_ping_error,
                'last_state_at' => $this->last_state_at?->timezone('Europe/Moscow')->format('d.m.Y H:i:s'),
                'last_job_id' => $this->last_job_id,
                'last_task_type' => $this->last_task_type,
                'updated_at' => $this->updated_at?->timezone('Europe/Moscow')->format('d.m.Y H:i:s'),
            ],
        ];
    }
}
