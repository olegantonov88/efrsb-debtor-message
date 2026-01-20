<?php

namespace App\ValueObjects\ExternalDebtor;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stringable;

class ContactsDebtorObject implements Jsonable, Arrayable, Stringable
{
    public $mobile;
    public $phone;
    public $fax;
    public $email;

    public static function fromArray($data)
    {
        $instance = new ContactsDebtorObject();
        $instance->mobile = $data['mobile'] ?? null;
        $instance->phone = $data['phone'] ?? null;
        $instance->fax = $data['fax'] ?? null;
        $instance->email = $data['email'] ?? null;

        return $instance;
    }

    public function toJson($options = 0)
    {
        return json_encode($this);
    }

    public function __toString()
    {
        return $this->toJson();
    }

    public function toArray()
    {
        return $this;
    }

}
