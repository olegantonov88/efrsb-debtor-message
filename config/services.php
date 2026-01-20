<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'fedresurs_message_list' => [
        'url' => env('FEDRESURS_MESSAGE_LIST_URL'),
        'api_key' => env('FEDRESURS_MESSAGE_LIST_API_KEY'),
        'incoming_api_key' => env('FEDRESURS_MESSAGE_LIST_INCOMING_API_KEY', '1234567890'),
        'timeout' => (int) env('FEDRESURS_MESSAGE_LIST_TIMEOUT', 60),
    ],

    'debtor_updater' => [
        'url' => env('DEBTOR_UPDATER_URL'),
        'api_key' => env('DEBTOR_UPDATER_API_KEY', '1234567890'),
        'timeout' => (int) env('DEBTOR_UPDATER_TIMEOUT', 60),
    ],

    'meeting_application' => [
        'url' => env('MEETING_APPLICATION_URL'),
        'api_key' => env('MEETING_APPLICATION_API_KEY', '1234567890'),
        'timeout' => (int) env('MEETING_APPLICATION_TIMEOUT', 10),
    ],

];
