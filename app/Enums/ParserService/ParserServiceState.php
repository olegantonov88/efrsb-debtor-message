<?php

namespace App\Enums\ParserService;

enum ParserServiceState: string
{
    case UNKNOWN = 'unknown';
    case IDLE = 'idle';
    case STARTED = 'started';
    case FINISHED = 'finished';
    case ERROR = 'error';

    public function text(): string
    {
        return match ($this) {
            self::UNKNOWN => 'Неизвестно',
            self::IDLE => 'Ожидание',
            self::STARTED => 'В работе',
            self::FINISHED => 'Завершил задачу',
            self::ERROR => 'Ошибка',
        };
    }
}


