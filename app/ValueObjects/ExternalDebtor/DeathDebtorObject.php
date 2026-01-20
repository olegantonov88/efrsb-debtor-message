<?php

namespace App\ValueObjects\ExternalDebtor;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stringable;

class DeathDebtorObject implements Jsonable, Arrayable, Stringable
{
    public $date;
    public $deceased_series;
    public $deceased_number;
    public $deceased_date;


    public static function fromArray($data)
    {
        $instance = new DeathDebtorObject();
        $instance->date = $data['date'] ?? null;
        $instance->deceased_series = $data['deceased_series'] ?? null;
        $instance->deceased_number = $data['deceased_number'] ?? null;
        $instance->deceased_date = $data['deceased_date'] ?? null;

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
            'date' => $this->date,
            'deceased_series' => $this->deceased_series,
            'deceased_number' => $this->deceased_number,
            'deceased_date' => $this->deceased_date,
        ];
    }

}
