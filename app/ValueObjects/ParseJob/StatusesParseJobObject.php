<?php

namespace App\ValueObjects\ParseJob;

use App\Enums\ParseJob\StatusParseJob;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Stringable;

class StatusesParseJobObject implements Jsonable, Arrayable, Stringable
{
    private Collection $value;

    public function __construct()
    {
        $this->value = collect();
    }

    public static function fromArray(array $data): self
    {
        $instance = new self();

        if (empty($data)) {
            return $instance;
        }

        $instance->value = collect($data)->map(function ($item) {
            if (!is_array($item) && !is_object($item)) {
                throw new \InvalidArgumentException('Item must be an array or object');
            }

            $item = (array) $item;

            $date = isset($item['date']) && $item['date'] ? $item['date'] : null;
            $dateCarbon = $date ? Carbon::parse($date) : null;

            $status = null;
            if (isset($item['status'])) {
                if ($item['status'] instanceof StatusParseJob) {
                    $status = $item['status'];
                } else {
                    $status = StatusParseJob::tryFrom((int) $item['status']);
                }
            }

            return [
                'id' => $item['id'] ?? null,
                'status' => $status,
                'date' => $date,
                // Дополнительные поля для UI
                'status_name' => $status ? $status->name : null,
                'status_text' => $status ? $status->text() : null,
                'date_format' => $dateCarbon ? $dateCarbon->format('d.m.Y H:i:s') : null,
                'message' => $item['message'] ?? null,
                'page' => $item['page'] ?? null,
            ];
        });

        return $instance;
    }

    public static function fromCollection(Collection $data): self
    {
        return self::fromArray($data->toArray());
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray());
    }

    public function __toString(): string
    {
        return $this->toJson();
    }

    public function toArray(): array
    {
        return $this->value->map(function ($item) {
            return [
                'id' => $item['id'],
                'status' => $item['status'] instanceof StatusParseJob ? $item['status']->value : $item['status'],
                'date' => $item['date'],
                'message' => $item['message'] ?? null,
                'page' => $item['page'] ?? null,
            ];
        })->toArray();
    }

    public function getStatusesData(): array
    {
        return $this->value->map(function ($item) {
            return [
                'id' => $item['id'],
                'status' => $item['status'] instanceof StatusParseJob ? $item['status']->value : $item['status'],
                'status_name' => $item['status_name'],
                'status_text' => $item['status_text'],
                'date' => $item['date'],
                'date_format' => $item['date_format'],
                'message' => $item['message'] ?? null,
                'page' => $item['page'] ?? null,
            ];
        })->toArray();
    }

    public function getLatestStatusMessage(): ?string
    {
        $latestStatus = $this->value->last();
        return $latestStatus['message'] ?? null;
    }

    public function addStatus(StatusParseJob $status, $message = null, $page = null): void
    {
        $maxId = $this->value->max('id');
        $id = $maxId === null ? 1 : $maxId + 1;

        $date = now()->toISOString();
        $dateCarbon = Carbon::parse($date);

        $this->value->push([
            'id' => $id,
            'status' => $status,
            'date' => $date,
            'status_name' => $status->name,
            'status_text' => $status->text(),
            'date_format' => $dateCarbon->format('d.m.Y H:i:s'),
            'message' => $message,
            'page' => $page,
        ]);
    }
}


