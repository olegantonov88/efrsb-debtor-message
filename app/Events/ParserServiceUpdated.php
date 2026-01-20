<?php

namespace App\Events;

use App\Http\Resources\ParserServiceResource;
use App\Models\ParserService;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParserServiceUpdated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public function __construct(public ParserService $service)
    {
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('parsers');
    }

    public function broadcastAs(): string
    {
        return 'parser-service.updated';
    }

    public function broadcastWith(): array
    {
        return [
            'service' => ParserServiceResource::make($this->service)->resolve(),
        ];
    }
}


