<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FedresursMessageListClient
{
    public function process(array $payload): Response
    {
        return $this->post('/api/process', $payload);
    }

    public function findDebtorUuid(array $payload): Response
    {
        return $this->post('/api/find-debtor-uuid', $payload);
    }

    public function fetchMessageTables(array $payload): Response
    {
        return $this->post('/api/fetch-message-tables', $payload);
    }

    private function post(string $path, array $payload): Response
    {
        $baseUrl = rtrim((string) config('services.fedresurs_message_list.url'), '/');
        $apiKey = (string) config('services.fedresurs_message_list.api_key');
        $timeout = (int) config('services.fedresurs_message_list.timeout', 60);

        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Accept' => 'application/json',
        ])->timeout($timeout)->post($baseUrl . $path, $payload);
    }
}


