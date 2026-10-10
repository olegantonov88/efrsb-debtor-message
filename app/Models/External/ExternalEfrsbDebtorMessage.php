<?php

namespace App\Models\External;

use App\Enums\EfrsbMessage\EfrsbDebtorMessageBodyFormat;

class ExternalEfrsbDebtorMessage extends ExternalModel
{
    protected $table = 'efrsb_debtor_messages';

    protected $casts = [
        'body_format' => EfrsbDebtorMessageBodyFormat::class,
    ];
}
