<?php

namespace App\Casts\ExternalDebtor;

use App\ValueObjects\ExternalDebtor\PreviousFioDebtorObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class PreviousFioDebtorCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return PreviousFioDebtorObject::fromArray(json_decode($value, true));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if(is_null($value)) $value = [];

        if(!$value instanceof PreviousFioDebtorObject && !is_array($value)){
            throw new InvalidArgumentException('The given value is not Array or an PreviousFioDebtor instance.');
        }

        if(is_array($value)) $value = PreviousFioDebtorObject::fromArray($value);

        return json_encode($value);
    }
}
