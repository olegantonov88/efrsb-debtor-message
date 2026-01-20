<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ParserService;
use Illuminate\Support\Facades\Http;
use App\Events\ParserServiceUpdated;

class PingParsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parsers:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping parser services by calling {base_url}/api/ping';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $services = ParserService::query()->where('is_active', true)->get();
        if ($services->isEmpty()) {
            $this->info('No active parser services.');
            return self::SUCCESS;
        }

        foreach ($services as $service) {
            $baseUrl = rtrim((string) $service->base_url, '/');
            $url = $baseUrl . '/api/ping';

            try {
                $response = Http::timeout(10)->acceptJson()->get($url);
                $json = $response->json();

                if ($response->successful() && is_array($json) && ($json['message'] ?? null) === 'pong') {
                    $service->update([
                        'is_available' => true,
                        'http_enabled' => isset($json['http_enabled']) ? (bool) $json['http_enabled'] : null,
                        'ymq_enabled' => isset($json['ymq_enabled']) ? (bool) $json['ymq_enabled'] : null,
                        'last_ping_at' => now(),
                        'last_ping_error' => null,
                    ]);
                    event(new ParserServiceUpdated($service->fresh()));

                    $this->line("OK  [{$service->id}] {$service->name} {$url}");
                } else {
                    $service->update([
                        'is_available' => false,
                        'last_ping_at' => now(),
                        'last_ping_error' => 'Unexpected response: HTTP ' . $response->status(),
                    ]);
                    event(new ParserServiceUpdated($service->fresh()));

                    $this->warn("BAD [{$service->id}] {$service->name} {$url} HTTP {$response->status()}");
                }
            } catch (\Throwable $e) {
                $service->update([
                    'is_available' => false,
                    'last_ping_at' => now(),
                    'last_ping_error' => $e->getMessage(),
                ]);
                event(new ParserServiceUpdated($service->fresh()));

                $this->error("ERR [{$service->id}] {$service->name} {$url} " . $e->getMessage());
            }
        }

        return self::SUCCESS;
    }
}
