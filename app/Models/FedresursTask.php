<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FedresursTask extends Model
{
    protected $guarded = [];

    protected $casts = [
        'payload' => 'array',
        'reserved_at' => 'datetime',
        'sent_at' => 'datetime',
        'stats' => 'array',
        'finished_at' => 'datetime',
    ];

    public function parseJob(): BelongsTo
    {
        return $this->belongsTo(ParseJob::class, 'parse_job_id');
    }
}


