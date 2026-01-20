<?php

namespace App\Enums\User;

enum UserType: int
{
    case PEOPLE = 1;
    case CITYMAN = 5;
    case COMPANY = 7;

    public function text()
    {
        return match ($this->value) {
            self::COMPANY->value => 'Юридическое лицо',
            self::PEOPLE->value => 'Физическое лицо',
            self::CITYMAN->value => 'Индивидуальный предприниматель',
        };
    }

    static public function textAllType()
    {
        return [

            self::PEOPLE->value => 'Физическое лицо',
            self::CITYMAN->value => 'ИП',
            self::COMPANY->value => 'Юридическое лицо',
        ];
    }

    static public function textAllTypeArray()
    {
        return [
            ['id' => self::PEOPLE->value, 'name' => self::PEOPLE->name, 'value' => 'Физическое лицо'],
            ['id' => self::CITYMAN->value, 'name' => self::CITYMAN->name, 'value' => 'ИП'],
            ['id' => self::COMPANY->value, 'name' => self::COMPANY->name, 'value' => 'Юридическое лицо'],
        ];
    }

    static public function textAllTypeShortArray()
    {
        return [
            ['id' => self::PEOPLE->value, 'name' => self::PEOPLE->name, 'value' => 'Физ. лицо'],
            ['id' => self::CITYMAN->value, 'name' => self::CITYMAN->name, 'value' => 'ИП'],
            ['id' => self::COMPANY->value, 'name' => self::COMPANY->name, 'value' => 'Юр. лицо'],
        ];
    }
}
