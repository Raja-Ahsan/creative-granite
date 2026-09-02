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

    'adobe_fonts' => [
        'kit' => env('ADOBE_FONTS_KIT'),
    ],

    /*
    | Instagram Graph API (Business / Creator account)
    | Docs: https://developers.facebook.com/docs/instagram-platform/
    |
    | INSTAGRAM_ACCESS_TOKEN  — long-lived token (required for live feed)
    | INSTAGRAM_USER_ID       — optional IG user id when using Facebook Graph
    | INSTAGRAM_PROFILE_URL   — public profile link for “Follow” button
    */
    'instagram' => [
        'access_token' => env('INSTAGRAM_ACCESS_TOKEN'),
        'user_id' => env('INSTAGRAM_USER_ID'),
        'profile_url' => env('INSTAGRAM_PROFILE_URL', 'https://www.instagram.com/creativegraniteanddesign/'),
        'cache_minutes' => (int) env('INSTAGRAM_CACHE_MINUTES', 60),
    ],

];
