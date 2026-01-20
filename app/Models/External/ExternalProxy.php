<?php

namespace App\Models\External;

use App\Enums\Proxy\ProxyUsageType;
use App\Enums\Proxy\TypeProxy;

class ExternalProxy extends ExternalModel
{
    protected $table = 'proxys';

    protected $fillable = [
        'name',
        'address',
        'port',
        'username',
        'password',
        'type',
        'usage_type',
        'is_active',
        'expiration_date',
    ];

    protected $casts = [
        'type' => TypeProxy::class,
        'usage_type' => ProxyUsageType::class,
        'is_active' => 'boolean',
        'expiration_date' => 'datetime',
    ];

    public function isExpired(): bool
    {
        return $this->expiration_date->isPast();
    }

    public function getProxyUrl(): string
    {
        $auth = $this->username && $this->password
            ? "{$this->username}:{$this->password}@"
            : '';

        return "{$this->type->name}://{$auth}{$this->address}:{$this->port}";
    }
}


