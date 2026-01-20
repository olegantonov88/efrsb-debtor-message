<?php

namespace App\Enums\User;

enum UserRoles : int {
    case SYSTEM = 0;
    case USER = 1;
    case MANAGER = 2;
    case SUPERMANAGER = 3;
    case ACCOUNTANT = 4;
    case ADMIN = 7;


    public function text()
    {
        return match ($this->value) {
            self::SYSTEM->value => 'Система',
            self::USER->value => 'Пользователь',
            self::MANAGER->value => 'Менеджер',
            self::SUPERMANAGER->value => 'Руководитель',
            self::ACCOUNTANT->value => 'Бухгалтер',
            self::ADMIN->value => 'Администратор'
        };
    }

    static public function textAllType()
    {
        return [
            self::USER->value => 'Пользователь',
            self::MANAGER->value => 'Менеджер',
            self::SUPERMANAGER->value => 'Руководитель',
            self::ACCOUNTANT->value => 'Бухгалтер',
            self::ADMIN->value => 'Администратор'
        ];
    }

    static public function textAllOptions()
    {
        return [
            ['id' => self::USER->value, 'name' => 'Пользователь'],
            ['id' => self::MANAGER->value, 'name' => 'Менеджер'],
            ['id' => self::SUPERMANAGER->value, 'name' => 'Руководитель'],
            ['id' => self::ACCOUNTANT->value, 'name' => 'Бухгалтер'],
            ['id' => self::ADMIN->value, 'name' => 'Администратор']
        ];
    }

    static public function textStatusForSearchAdmin()
    {
        return [
            ['code' => self::USER->value, 'value' => 'Пользователь'],
            ['code' => self::MANAGER->value, 'value' => 'Менеджер'],
            ['code' => self::SUPERMANAGER->value, 'value' => 'Руководитель'],
            ['code' => self::ACCOUNTANT->value, 'value' => 'Бухгалтер'],
            ['code' => self::ADMIN->value, 'value' => 'Администратор']
        ];
    }
}
