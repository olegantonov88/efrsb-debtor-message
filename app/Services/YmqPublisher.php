<?php

namespace App\Services;

use Aws\Sqs\SqsClient;

class YmqPublisher
{
    public function sendMessage(string $queueUrl, array $payload): string
    {
        $client = $this->client();

        $result = $client->sendMessage([
            'QueueUrl' => $queueUrl,
            'MessageBody' => json_encode($payload, JSON_UNESCAPED_UNICODE),
        ]);

        return (string) ($result->get('MessageId') ?? '');
    }

    private function client(): SqsClient
    {
        $cfg = config('queue.connections.sqs');

        $args = [
            'version' => 'latest',
            'region' => $cfg['region'] ?? env('AWS_DEFAULT_REGION', 'ru-central1'),
            'credentials' => [
                'key' => $cfg['key'] ?? env('AWS_ACCESS_KEY_ID'),
                'secret' => $cfg['secret'] ?? env('AWS_SECRET_ACCESS_KEY'),
            ],
        ];

        if (!empty($cfg['endpoint'])) {
            $args['endpoint'] = $cfg['endpoint'];
        }

        return new SqsClient($args);
    }
}


