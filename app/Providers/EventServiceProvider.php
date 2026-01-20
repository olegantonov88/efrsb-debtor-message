<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class EventServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        // Включается через BROADCAST_DEBUG=true
        if (!filter_var(env('BROADCAST_DEBUG', false), FILTER_VALIDATE_BOOL)) {
            return;
        }

        Event::listen(JobProcessing::class, function (JobProcessing $event) {
            if (!str_contains($event->job->resolveName(), 'BroadcastEvent')) {
                return;
            }
            Log::info('Broadcast job processing', [
                'connection' => $event->connectionName,
                'queue' => $event->job->getQueue(),
                'name' => $event->job->resolveName(),
            ]);
        });

        Event::listen(JobProcessed::class, function (JobProcessed $event) {
            if (!str_contains($event->job->resolveName(), 'BroadcastEvent')) {
                return;
            }
            Log::info('Broadcast job processed', [
                'connection' => $event->connectionName,
                'queue' => $event->job->getQueue(),
                'name' => $event->job->resolveName(),
            ]);
        });

        Event::listen(JobFailed::class, function (JobFailed $event) {
            if (!str_contains($event->job->resolveName(), 'BroadcastEvent')) {
                return;
            }
            Log::error('Broadcast job failed', [
                'connection' => $event->connectionName,
                'queue' => $event->job->getQueue(),
                'name' => $event->job->resolveName(),
                'exception' => $event->exception->getMessage(),
            ]);
        });
    }
}

