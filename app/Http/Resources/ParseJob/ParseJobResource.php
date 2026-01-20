<?php

namespace App\Http\Resources\ParseJob;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParseJobResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'debtor_id' => $this->debtor_id,
                'type' => $this->type?->value,
                'type_name' => $this->type?->name,
                'latest_status' => $this->latest_status?->value,
                'latest_status_name' => $this->latest_status?->name,
                'latest_status_text' => $this->latest_status?->text(),
                'latest_status_severity' => $this->latest_status?->severity(),
                'statuses' => $this->statuses ? $this->statuses->getStatusesData() : [],
                'payload' => $this->payload ?? [],
                'created_at' => $this->created_at?->timezone('Europe/Moscow')->format('d.m.Y H:i:s'),
                'updated_at' => $this->updated_at?->timezone('Europe/Moscow')->format('d.m.Y H:i:s'),
            ],
        ];
    }


}


