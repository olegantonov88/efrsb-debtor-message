<?php

namespace App\ValueObjects\ExternalDebtor;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stringable;

class LivingWageDebtorObject implements Jsonable, Arrayable, Stringable
{
    public $region;
    public $transfer_type;
    public $account;
    public $person;
    public $requisites;
    public $living_wage_type;


    public static function fromArray($data)
    {
        $instance = new LivingWageDebtorObject();
        $instance->region = $data['region'] ?? null;
        $instance->transfer_type = $data['transfer_type'] ?? null;
        $instance->account = $data['account'] ?? null;
        $instance->person = $data['person'] ?? null;
        $instance->requisites = $data['requisites'] ?? null;
        $instance->living_wage_type = $data['living_wage_type'] ?? null;

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
            'region' => $this->region,
            'transfer_type' => $this->transfer_type,
            'account' => $this->account,
            'person' => $this->person,
            'requisites' => $this->requisites,
            'living_wage_type' => $this->living_wage_type,
        ];
    }

}
