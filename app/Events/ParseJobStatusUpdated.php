<?php

namespace App\Events;

use App\Http\Resources\ParseJob\ParseJobResource;
use App\Models\ParseJob;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParseJobStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public int $userId,
        public ParseJob $parseJob
    ) {
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('Efrsb.Debtor.Messages.' . $this->userId);
    }

    public function broadcastAs(): string
    {
        return 'efrsb.debtor.messages.updated';
    }

    public function broadcastWith(): array
    {
        return ParseJobResource::make($this->parseJob)->resolve();
    }
}
