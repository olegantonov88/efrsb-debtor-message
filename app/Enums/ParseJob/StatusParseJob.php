<?php

namespace App\Enums\ParseJob;

enum StatusParseJob: int
{
    case CREATED = 1;
    case PROCESSING = 2;
    case SUCCESS = 7;
    case ERROR = 9;

    public function text(): string
    {
        return match ($this->value) {
            self::CREATED->value => 'Создана',
            self::PROCESSING->value => 'В работе',
            self::SUCCESS->value => 'Успешно обработана',
            self::ERROR->value => 'Ошибка',
        };
    }

    public function severity(): string
    {
        return match ($this->value) {
            self::CREATED->value => 'secondary',
            self::PROCESSING->value => 'info',
            self::SUCCESS->value => 'success',
            self::ERROR->value => 'danger',
            default => 'info',
        };
    }
}


