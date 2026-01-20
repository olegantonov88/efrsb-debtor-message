<?php

namespace App\Enums\Proxy;

enum TypeProxy: int
{
    case http = 1;
    case https = 2;
    case socks4 = 3;
    case socks5 = 4;

    public function text()
    {
        return match ($this->value) {
            self::http->value => 'http',
            self::https->value => 'https',
            self::socks4->value => 'socks4',
            self::socks5->value => 'socks5',
        };
    }


    static public function textAllTypeArray()
    {
        return [
            ['id' => self::http->value, 'name' => self::http->name, 'value' => 'http'],
            ['id' => self::https->value, 'name' => self::https->name, 'value' => 'https'],
            ['id' => self::socks4->value, 'name' => self::socks4->name, 'value' => 'socks4'],
            ['id' => self::socks5->value, 'name' => self::socks5->name, 'value' => 'socks5'],
        ];
    }
}
