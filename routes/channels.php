<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('parsers', function ($user) {
    // Разрешаем доступ к каналу только аутентифицированным пользователям
    return $user !== null;
});

