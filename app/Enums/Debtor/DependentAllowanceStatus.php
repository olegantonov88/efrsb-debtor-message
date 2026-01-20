<?php

namespace App\Enums\Debtor;


enum DependentAllowanceStatus: int
{
    case FULL = 1;
    case HALF = 2;
    case OTHER = 3;

    case NONE = 9;

    public function text()
    {
        return match ($this->value) {
            self::FULL->value => 'Полностью',
            self::HALF->value => 'Половина',
            self::OTHER->value => 'Иной размер',
            self::NONE->value => 'Не выплачивается',
        };
    }

    static public function textAllTypeArray()
    {
        return [
            ['id' => self::FULL->value, 'name' => self::FULL->name, 'value' => 'Полностью'],
            ['id' => self::HALF->value, 'name' => self::HALF->name, 'value' => 'Половина'],
            ['id' => self::OTHER->value, 'name' => self::OTHER->name, 'value' => 'Иной размер'],
            ['id' => self::NONE->value, 'name' => self::NONE->name, 'value' => 'Не выплачивается'],
        ];
    }

}
