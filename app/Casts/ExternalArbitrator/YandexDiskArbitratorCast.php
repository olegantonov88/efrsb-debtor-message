<?php

namespace App\Casts\ExternalArbitrator;

use App\ValueObjects\ExternalArbitrator\YandexDiskArbitratorObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class YandexDiskArbitratorCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return YandexDiskArbitratorObject::fromArray(json_decode($value ?? '[]', true));
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (is_null($value)) {
            return null;
        }

        if (!$value instanceof YandexDiskArbitratorObject && !is_array($value)) {
            throw new InvalidArgumentException('The given value is not Array or a YandexDiskArbitratorObject instance.');
        }

        if (is_array($value)) {
            $value = YandexDiskArbitratorObject::fromArray($value);
        }

        return $value->toJson();
    }
}

