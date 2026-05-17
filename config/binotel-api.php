<?php

return [
    'url' => env('BINOTEL_API_URL', 'https://api.binotel.com/api/'),
    'version' => env('BINOTEL_API_VERSION', '4.0'),
    'format' => env('BINOTEL_API_FORMAT', 'json'),

    'key' => env('BINOTEL_API_KEY', null),
    'secret' => env('BINOTEL_API_SECRET', null),

    'actions' => [
        'apiCallSettings' => \Sashalenz\Binotel\Actions\ApiCallSettings::class,
        'apiCallCompleted' => \Sashalenz\Binotel\Actions\ApiCallCompleted::class,
        'receivedTheCall' => \Sashalenz\Binotel\Actions\ReceivedTheCall::class,
        'answeredTheCall' => \Sashalenz\Binotel\Actions\AnsweredTheCall::class,
        'hangupTheCall' => \Sashalenz\Binotel\Actions\HangupTheCall::class
    ],

    'customer_class' => null,
    'employee_class' => null,
    'pbx_class' => null,

    'domain' => env('BINOTEL_API_DOMAIN', env('APP_URL')),

    'http' => [
        'timeout' => env('BINOTEL_API_TIMEOUT', 15),
        'connect_timeout' => env('BINOTEL_API_CONNECT_TIMEOUT', 10),
        'retry_times' => env('BINOTEL_API_RETRY_TIMES', 5),
        'retry_sleep' => env('BINOTEL_API_RETRY_SLEEP', 1000),
        'retry_max_sleep' => env('BINOTEL_API_RETRY_MAX_SLEEP', 15000),
        'throttle_ms' => env('BINOTEL_API_THROTTLE_MS', 200),
    ],
];
