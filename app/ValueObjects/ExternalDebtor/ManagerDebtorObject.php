<?php

namespace App\ValueObjects\ExternalDebtor;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stringable;

class ManagerDebtorObject implements Jsonable, Arrayable, Stringable
{
    public $firstname;
    public $lastname;
    public $middlename;

    public static function fromArray($data)
    {
        $instance = new ManagerDebtorObject();
        $instance->firstname = $data['firstname'] ?? null;
        $instance->lastname = $data['lastname'] ?? null;
        $instance->middlename = $data['middlename'] ?? null;

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
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'middlename' => $this->middlename,
        ];
    }

}
