<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class GetMask
{
    static public function getPhoneMask($str)
    {
        if(is_null($str)) return null;
        $phone = sprintf(
            "+%s (%s) %s-%s-%s",
            substr($str, 0, 1),
            substr($str, 1, 3),
            substr($str, 4, 3),
            substr($str, 7, 2),
            substr($str, 9)
        );
        return $phone;
    }

    static public function getMoneyMask($amount)
    {
        return number_format($amount, 2, ',', ' ') . ' руб.';
    }

    static public function getMoneyThousandMask($amount)
    {
        $amount = (float) $amount;

        return number_format($amount / 1000, 3, ',', ' ');
    }

    static public function getMoneyMaskWithoutCur($amount)
    {
        return $amount ? number_format($amount, 2, ',', ' ') : null;
    }

    static public function getPercentMask($amount, $cnt = 3)
    {
        return $amount ? number_format($amount, $cnt, ',', ' ') . '%' : null;
    }

    static public function getSnilsMask($snils)
    {

        if(is_null($snils) || mb_strlen($snils) == 0){
            return null;
        }

        return sprintf(
            "%s-%s-%s %s",
            substr($snils, 0, 3),
            substr($snils, 3, 3),
            substr($snils, 6, 3),
            substr($snils, 9, 2)
        );
    }

    static public function getPspNumberMask($str)
    {
        $number = sprintf(
            "%s %s",
            substr($str, 0, 4),
            substr($str, 4, 6)
        );
        return $number;

    }

    static public function getDateMask($value)
    {
        $string = null;

        if(!is_null($value) && Str::length($value) > 0){
            $string = "{$value} г.";
        }

        return $string;
    }
}

