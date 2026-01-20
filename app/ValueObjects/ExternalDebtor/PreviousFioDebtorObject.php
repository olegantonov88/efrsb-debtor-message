<?php

namespace App\ValueObjects\ExternalDebtor;

class PreviousFioDebtorObject
{
    public static function fromArray($data)
    {
        foreach($data ?? [] as $arr){
            $res[] = self::getArrayfromData($arr);
        }

        return $res ?? [];
    }

    private static function getArrayfromData($arr){

        $nullObj = (object) [
            'firstname' => null,
            'lastname' => null,
            'middlename' => null,
        ];

        return !empty($arr) ? (object) [
            'firstname' => $arr['firstname'] ?? null,
            'lastname' => $arr['lastname'] ?? null,
            'middlename' => $arr['middlename'] ?? null,
        ] : $nullObj;
    }

}
