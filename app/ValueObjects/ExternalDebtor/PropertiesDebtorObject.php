<?php

namespace App\ValueObjects\ExternalDebtor;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stringable;

class PropertiesDebtorObject implements Jsonable, Arrayable, Stringable
{
    public $securitylevel;
    public $territoryfactor;
    public $efrsb_id;
    public $efrsb_message_id;

    public static function fromArray($data)
    {
        $instance = new PropertiesDebtorObject();
        $instance->securitylevel = $data['securitylevel'] ?? null;
        $instance->territoryfactor = $data['territoryfactor'] ?? null;
        $instance->efrsb_message_id = $data['efrsb_message_id'] ?? null;
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
            'securitylevel' => $this->securitylevel,
            'territoryfactor' => $this->territoryfactor,
            'efrsb_id' => $this->efrsb_id,
            'efrsb_message_id' => $this->efrsb_message_id,
        ];
    }

}
