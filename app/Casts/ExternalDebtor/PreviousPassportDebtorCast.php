<?php

namespace App\Casts\ExternalDebtor;

use App\ValueObjects\ExternalDebtor\PreviousPassportDebtorObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class PreviousPassportDebtorCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return PreviousPassportDebtorObject::fromArray(json_decode($value, true));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if(is_null($value)) $value = collect([]);

        if(!$value instanceof PreviousPassportDebtorObject && !$value instanceof Collection){
            throw new InvalidArgumentException('The given value is not Array or an PreviousPassportDebtor instance.');
        }

        if(is_a($value, 'Illuminate\Database\Eloquent\Collection')) $value = PreviousPassportDebtorObject::fromArray($value);

        return $value->toJson();
    }
}
