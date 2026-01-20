<?php

namespace App\Casts\ExternalDebtor;

use App\ValueObjects\ExternalDebtor\BirthDebtorObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class BirthDebtorCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return BirthDebtorObject::fromArray(json_decode($value, true));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if(is_null($value)) $value = [];

        if (!$value instanceof BirthDebtorObject && !is_array($value)) {
            throw new InvalidArgumentException('The given value is not Array or an BirthDebtor instance.');
        }

        if (is_array($value)) $value = BirthDebtorObject::fromArray($value);

        return $value->toJson();
    }
}
