<?php

namespace App\Enums\Debtor;

enum CategoryDebtor: int
{
    case PEOPLY = 1;

    case NONE = 21;
    case LIQUIDATION = 22;
    case ABSENT = 23;
    case CITY = 24;
    case AGRICULTURAL = 25;
    case STRATEGIC = 26;

    case BUILDING = 30;


    public function text()
    {
        return match ($this->value) {
            self::PEOPLY->value => 'Физическое лицо',
            self::NONE->value => 'Не относится к отдельным категориям должников',
            self::LIQUIDATION->value => 'Ликвидируемый должник',
            self::ABSENT->value => 'Отсутствующий должник',
            self::CITY->value => 'Градообразующая организация',
            self::AGRICULTURAL->value => 'Сельскохозяйственная организация',
            self::STRATEGIC->value => 'Стратегическая организация',
            self::BUILDING->value => 'Застройщик',
        };
    }

    static public function textAllTypeArray()
    {
        return [
            ['id' => self::PEOPLY->value, 'name' => self::PEOPLY->name, 'value' => 'Физическое лицо'],
            ['id' => self::NONE->value, 'name' => self::NONE->name, 'value' => 'Не относится к отдельным категориям'],
            ['id' => self::LIQUIDATION->value, 'name' => self::LIQUIDATION->name, 'value' => 'Ликвидируемый должник'],
            ['id' => self::ABSENT->value, 'name' => self::ABSENT->name, 'value' => 'Отсутствующий должник'],
            ['id' => self::CITY->value, 'name' => self::CITY->name, 'value' => 'Градообразующая организация'],
            ['id' => self::AGRICULTURAL->value, 'name' => self::AGRICULTURAL->name, 'value' => 'Сельскохозяйственная организация'],
            ['id' => self::STRATEGIC->value, 'name' => self::STRATEGIC->name, 'value' => 'Стратегическая организация'],
            ['id' => self::BUILDING->value, 'name' => self::BUILDING->name, 'value' => 'Застройщик'],
        ];
    }

    static public function textAllTypeImportArray()
    {
        return [
            ['id' => self::PEOPLY->value, 'name' => self::PEOPLY->name, 'value' => 'Физическое лицо'],
            ['id' => self::NONE->value, 'name' => self::NONE->name, 'value' => 'Не относится к отдельным категориям'],
            ['id' => self::LIQUIDATION->value, 'name' => self::LIQUIDATION->name, 'value' => 'Ликвидируемый должник'],
            ['id' => self::ABSENT->value, 'name' => self::ABSENT->name, 'value' => 'Отсутствующий должник'],
            ['id' => self::CITY->value, 'name' => self::CITY->name, 'value' => 'Градообразующая организация'],
            ['id' => self::AGRICULTURAL->value, 'name' => self::AGRICULTURAL->name, 'value' => 'Сельскохозяйственная организация'],
            ['id' => self::STRATEGIC->value, 'name' => self::STRATEGIC->name, 'value' => 'Стратегическая организация'],
        ];
    }

}
