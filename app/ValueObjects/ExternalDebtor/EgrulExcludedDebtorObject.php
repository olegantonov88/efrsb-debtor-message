<?php

namespace App\ValueObjects\ExternalDebtor;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stringable;

class EgrulExcludedDebtorObject implements Jsonable, Arrayable, Stringable
{
    public $number;
    public $date;

    public static function fromArray($data)
    {
        $instance = new EgrulExcludedDebtorObject();
        $instance->number = $data['number'] ?? null;
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
            'number' => $this->number,
            'date' => $this->date,
        ];
    }

}
