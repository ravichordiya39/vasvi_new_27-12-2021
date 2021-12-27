<?php

return [

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // 'google' => [
    //   'client_id' => '1034535564143-64775hiermfgpi07at3t2s5ihogm6cug.apps.googleusercontent.com',
    //   'client_secret' => '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',
    //   'redirect' => 'https://vasvi.in/callback/google',
    // ],

    // 'facebook' => [
    //   'client_id' => '592489078831161',
    //   'client_secret' => '4819f233d6a09c10c090f9de92035e38',
    //   'redirect' => 'https://vasvi.in/callback/facebook',
    // ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => 'https://vasvi.in/callback/google',
      ],

      'facebook' => [
        'client_id' => env('FB_CLIENT_ID'),
        'client_secret' => env('FB_CLIENT_SECRET'),
        'redirect' => 'https://vasvi.in/callback/facebook',
      ],


];
