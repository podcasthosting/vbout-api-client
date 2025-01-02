<?php

return [
    'url'     => env('VBOUT_URL', 'https://api.vbout.com'),
    'api_key' => env('VBOUT_API_KEY', ''),
    'timeout' => env('VBOUT_API_TIMEOUT', 15), // Timeout für Requests in Sekunden

    'lists' => [
    ],
];
