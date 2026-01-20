<?php

namespace App\ValueObjects\ExternalDebtor;

use App\Helpers\GetMask;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stringable;

class PassportDebtorObject implements Jsonable, Arrayable, Stringable
{
    public $number;
    public $issuer;
    public $date;
    public $code;

    public static function fromArray($data)
    {
        $instance = new PassportDebtorObject();
        $instance->number = $data['number'] ?? null;
        $instance->issuer = $data['issuer'] ?? null;
        $instance->date = $data['date'] ?? null;
        $instance->code = $data['code'] ?? null;

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
            'number' => $this->number,
            'issuer' => $this->issuer,
            'date' => $this->date,
            'code' => $this->code,
        ];
    }

    public function toText()
    {
        if(is_null($this->number) && is_null($this->issuer) && is_null($this->date)) return null;

        return GetMask::getPspNumberMask($this->number).' выдан '.$this->issuer.' '.$this->date;
    }

}
