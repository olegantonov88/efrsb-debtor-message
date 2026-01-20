<?php

namespace App\Casts\ExternalDebtor;

use App\ValueObjects\ExternalDebtor\ContactsDebtorObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class ContactsDebtorCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return ContactsDebtorObject::fromArray(json_decode($value, true));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if(is_null($value)) $value = [];

        if (!$value instanceof ContactsDebtorObject && !is_array($value)) {
            throw new InvalidArgumentException('The given value is not Array or an ContactsDebtor instance.');
        }

        if (is_array($value)) $value = ContactsDebtorObject::fromArray($value);

        return $value->toJson();
    }
}
