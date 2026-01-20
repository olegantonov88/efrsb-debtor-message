<?php

namespace App\Enums\Proxy;

enum ProxyUsageType: int
{
    case EFRSB = 1;
    case RUSSIAN_POST = 2;
    case EFRSB_DEBTOR_MESSAGE = 3;

    public function text()
    {
        return match ($this->value) {
            self::EFRSB->value => 'ЕФРСБ',
            self::RUSSIAN_POST->value => 'Почта России',
            self::RUSSIAN_POST->value => 'ЕФРСБ сообщение должника',
        };
    }


    static public function textAllTypeArray()
    {
        return [
            ['id' => self::EFRSB->value, 'name' => self::EFRSB->name, 'value' => 'ЕФРСБ'],
            ['id' => self::RUSSIAN_POST->value, 'name' => self::RUSSIAN_POST->name, 'value' => 'Почта России'],
            ['id' => self::EFRSB_DEBTOR_MESSAGE->value, 'name' => self::EFRSB_DEBTOR_MESSAGE->name, 'value' => 'ЕФРСБ сообщение должника'],
        ];
    }
}
