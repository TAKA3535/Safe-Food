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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'line' => [
        'channel_access_token' => env('aS/bRdr0qd4OQTLDKZ+yL0LiEBpxsFiSjJGQRchdiKORpNLPNVnKRsCdlqAIr5mDyO963+hFltDrpZ98BkLqi0kY2LFGBernZwhs8+MGkMB9F1YNMwRyJR2wBotTd3QcMRbWaqY/iXec9t+cLoQDHQdB04t89/1O/w1cDnyilFU='),
        'channel_secret' => env('54dfad0ae02e1025b4d7bc7cd2427338'),
    ],
];
