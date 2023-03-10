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

    'domain' => env('BINOTEL_API_DOMAIN', env('APP_URL'))
];
