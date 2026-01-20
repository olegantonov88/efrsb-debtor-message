<?php

namespace App\Casts\ParseJob;

use App\ValueObjects\ParseJob\StatusesParseJobObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class StatusesParseJobCast implements CastsAttributes
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): StatusesParseJobObject
    {
        if (empty($value)) {
            return StatusesParseJobObject::fromArray([]);
        }

        if (is_array($value)) {
            return StatusesParseJobObject::fromArray($value);
        }

        $decoded = json_decode((string) $value, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Invalid JSON data in statuses field');
        }

        return StatusesParseJobObject::fromArray($decoded);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (is_null($value)) {
            return json_encode([]);
        }

        if ($value instanceof StatusesParseJobObject) {
            return $value->toJson();
        }

        if ($value instanceof Collection) {
            return StatusesParseJobObject::fromCollection($value)->toJson();
        }

        if (is_array($value)) {
            return StatusesParseJobObject::fromArray($value)->toJson();
        }

        throw new InvalidArgumentException('The given value must be an instance of StatusesParseJobObject, Collection or array.');
    }
}


