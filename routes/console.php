<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Ping parser services every N minutes (default 2).
$interval = (int) env('PARSER_PING_INTERVAL_MINUTES', 2);
if ($interval < 1) $interval = 1;
if ($interval > 59) $interval = 59;

Schedule::command('parsers:ping')
    ->cron('*/' . $interval . ' * * * *')
    ->withoutOverlapping();
