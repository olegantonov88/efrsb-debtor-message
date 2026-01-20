<?php

namespace App\Models;

use App\Enums\ParserService\ParserServiceState;
use Illuminate\Database\Eloquent\Model;

class ParserService extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'is_available' => 'boolean',
        'current_state' => ParserServiceState::class,
        'http_enabled' => 'boolean',
        'ymq_enabled' => 'boolean',
        'last_ping_at' => 'datetime',
        'last_state_at' => 'datetime',
    ];
}


