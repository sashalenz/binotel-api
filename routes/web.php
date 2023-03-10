<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Sashalenz\Binotel\Http\Controllers\WebhookController;

Route::prefix('binotel-api')
    ->domain(Config::get('binotel-api.domain'))
    ->as('binotel-api.')
    ->post('webhook', WebhookController::class)
    ->name('webhook');
