<?php

namespace App\Models;

use App\Casts\ParseJob\StatusesParseJobCast;
use App\Enums\ParseJob\ParseJobType;
use App\Enums\ParseJob\StatusParseJob;
use App\Events\ParseJobStatusNotification;
use App\Events\ParseJobStatusUpdated;
use App\ValueObjects\ParseJob\StatusesParseJobObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ParseJob extends Model
{
    protected $guarded = [];

    protected $casts = [
        'type' => ParseJobType::class,
        'latest_status' => StatusParseJob::class,
        'statuses' => StatusesParseJobCast::class,
        'payload' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->public_id)) {
                $model->public_id = (string) Str::uuid();
            }
        });
    }

    public function updateStatus(StatusParseJob|string|int $status, ?string $message = null, ?int $page = null): void
    {
        if (!$this->statuses instanceof StatusesParseJobObject) {
            $this->statuses = StatusesParseJobObject::fromArray([]);
        }

        $statusEnum = $status instanceof StatusParseJob ? $status : StatusParseJob::tryFrom((int) $status);
        if (!$statusEnum) {
            return;
        }

        $this->statuses->addStatus($statusEnum, $message, $page);
        $this->latest_status = $statusEnum;

        $this->save();

        // Отправляем уведомление через Pusher, если задача вызвана пользователем и статус финальный
        if ($this->user_id && in_array($statusEnum, [StatusParseJob::SUCCESS, StatusParseJob::ERROR])) {
            $title = $statusEnum === StatusParseJob::SUCCESS
                ? 'Сведения обновлены'
                : 'Ошибка обновления сведений';

            $message = $statusEnum === StatusParseJob::SUCCESS
                ? 'Сведения о публикации сообщений на ЕФРСБ обновлены'
                : 'Не удалось обновить сведения о публикации сообщений на ЕФРСБ';

            // Отправляем данные задачи для обновления на странице
            event(new ParseJobStatusUpdated(
                userId: $this->user_id,
                parseJob: $this->fresh()
            ));

            // Отправляем уведомление пользователю
            event(new ParseJobStatusNotification(
                userId: $this->user_id,
                title: $title,
                message: $message,
                type: $statusEnum === StatusParseJob::SUCCESS ? 'success' : 'error',
                life: 6000
            ));
        }
    }

    public function fedresursTasks(): HasMany
    {
        return $this->hasMany(FedresursTask::class, 'parse_job_id');
    }
}


