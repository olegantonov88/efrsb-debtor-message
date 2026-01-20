<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MeetingApplicationCallbackService
{
    public function sendMessageBodyCallback(
        int $messageId,
        string $messageUuid,
        string $status,
        ?string $error,
        string $callbackUrl,
        ?int $meetingApplicationId
    ): void {
        $apiKey = (string) config('services.meeting_application.api_key');
        $timeout = (int) config('services.meeting_application.timeout', 10);

        $payload = [
            'message_id' => $messageId,
            'message_uuid' => $messageUuid,
            'status' => $status,
            'meeting_application_id' => $meetingApplicationId,
        ];

        if ($status === 'error' && $error !== null) {
            $payload['error'] = $error;
        }

        try {
            $http = Http::timeout($timeout)->acceptJson();

            if ($apiKey !== '') {
                $http->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                ]);
            }

            /** @var Response $response */
            $response = $http->post($callbackUrl, $payload);

            if (!$response->successful()) {
                Log::warning('MeetingApplicationCallback failed', [
                    'message_id' => $messageId,
                    'message_uuid' => $messageUuid,
                    'status' => $status,
                    'callback_url' => $callbackUrl,
                    'meeting_application_id' => $meetingApplicationId,
                    'http_status' => $response->status(),
                    'response_body' => $response->body(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('MeetingApplicationCallback exception', [
                'message_id' => $messageId,
                'message_uuid' => $messageUuid,
                'status' => $status,
                'callback_url' => $callbackUrl,
                'meeting_application_id' => $meetingApplicationId,
                'error' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
