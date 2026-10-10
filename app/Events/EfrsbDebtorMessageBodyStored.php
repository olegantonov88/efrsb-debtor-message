<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

/**
 * Данные одного сообщения получены. Страница в CRM обновляет строку без перезагрузки,
 * не дожидаясь завершения всей задачи message_tables
 */
class EfrsbDebtorMessageBodyStored implements ShouldBroadcast
{
    use Dispatchable;

    public function __construct(
        public int $userId,
        public int $debtorId,
        public int $messageId,
        public ?string $number,
        public ?int $bodyFormat,
    ) {
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('Efrsb.Debtor.Messages.' . $this->userId);
    }

    public function broadcastAs(): string
    {
        return 'efrsb.debtor.message.body.stored';
    }

    public function broadcastWith(): array
    {
        return [
            'debtor_id' => $this->debtorId,
            'message_id' => $this->messageId,
            'number' => $this->number,
            'body_format' => $this->bodyFormat,
        ];
    }
}
