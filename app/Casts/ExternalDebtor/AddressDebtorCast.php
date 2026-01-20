<?php

namespace App\Casts\ExternalDebtor;

use App\ValueObjects\ExternalDebtor\AddressDebtorObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class AddressDebtorCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return AddressDebtorObject::fromArray(json_decode($value, true));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if(is_null($value)) $value = [];

        if(!$value instanceof AddressDebtorObject && !is_array($value)){
            throw new InvalidArgumentException('The given value is not Array or an AddressDebtor instance.');
        }

        if(is_array($value)) $value = AddressDebtorObject::fromArray($value);

        return $value->toJson();
    }
}
