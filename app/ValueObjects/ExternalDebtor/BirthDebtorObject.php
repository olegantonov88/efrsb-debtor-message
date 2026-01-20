<?php

namespace App\ValueObjects\ExternalDebtor;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stringable;

class BirthDebtorObject implements Jsonable, Arrayable, Stringable
{
    public $place;
    public $date;

    public static function fromArray($data)
    {
        $instance = new BirthDebtorObject();
        $instance->place = $data['place'] ?? null;
        $instance->date = $data['date'] ?? null;

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
            'place' => $this->place,
            'date' => $this->date,
        ];
    }

}
