# API for Binotel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sashalenz/binotel-api.svg?style=flat-square)](https://packagist.org/packages/sashalenz/binotel-api)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/sashalenz/binotel-api/run-tests?label=tests)](https://github.com/sashalenz/binotel-api/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/sashalenz/binotel-api/Check%20&%20fix%20styling?label=code%20style)](https://github.com/sashalenz/binotel-api/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/sashalenz/binotel-api.svg?style=flat-square)](https://packagist.org/packages/sashalenz/binotel-api)

## Installation

You can install the package via composer:

```bash
composer require sashalenz/binotel-api
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Sashalenz\Binotel\BinotelServiceProvider" --tag="binotel-api-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Sashalenz\Binotel\BinotelServiceProvider" --tag="binotel-api-config"
```

This is the contents of the published config file:

```php
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
```

## Usage

```php
$customersList = Sashalenz\Binotel\Binotel::customers()->list();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Oleksandr Petrovskyi](https://github.com/sashalenz)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
