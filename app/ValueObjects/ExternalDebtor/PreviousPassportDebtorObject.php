<?php

namespace App\ValueObjects\ExternalDebtor;

class PreviousPassportDebtorObject
{
    public static function fromArray($data)
    {
        foreach($data ?? [] as $arr){
            $res[] = self::getArrayfromData($arr);
        }

        return collect($res ?? []);
    }


    private static function getArrayfromData($arr){
        $nullObj = (object) [
            'series' => null,
            'number' => null,
            'issuer' => null,
            'date' => null,
            'code' => null,
        ];

        return !empty($arr) ? (object) [
            'series' => $arr['series'] ?? null,
            'number' => $arr['number'] ?? null,
            'issuer' => $arr['issuer'] ?? null,
            'date' => $arr['date'] ?? null,
            'code' => $arr['code'] ?? null,
        ] : $nullObj;
    }

}
