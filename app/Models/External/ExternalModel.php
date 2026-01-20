<?php

namespace App\Models\External;

use Illuminate\Database\Eloquent\Model;

abstract class ExternalModel extends Model
{
    protected $connection = 'external';

    protected $guarded = [];

    public $timestamps = false;
}


