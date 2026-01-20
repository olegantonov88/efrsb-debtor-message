<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParserServiceDeleted implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public function __construct(public int $serviceId)
    {
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('parsers');
    }

    public function broadcastAs(): string
    {
        return 'parser-service.deleted';
    }

    public function broadcastWith(): array
    {
        return [
            'service_id' => $this->serviceId,
        ];
    }
}


