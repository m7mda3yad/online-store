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

    'google' => [
        'client_id' => '679452957810-v53f8r3d4lh4ge4sjcfkdk8dp9hjfe78.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '5000104723365893',
        'client_secret' => 'd80df2a86a607725c21518e2dcb00ada',
        'redirect' => 'http://127.0.0.1:8000/auth/facebook/callback',
    ],
    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
    ],
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],
    'mandrill' => [
        'secret' => null,
            ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
