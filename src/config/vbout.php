<?php
/**
 * This is used in conjunction with Laravel and the VbooutServiceProvider
 * If you use a framework other than Laravel this is not most likely not interesting for you
 *
 * You can publish this config using: `php artisan vendor:publish --tag=vbout-config`
 */
return [
    'url'     => env('VBOUT_URL', 'https://api.vbout.com'),
    'api_key' => env('VBOUT_API_KEY', ''),
    'timeout' => env('VBOUT_API_TIMEOUT', 15), // Timeout für Requests in Sekunden

    'lists' => [
    ],
];
