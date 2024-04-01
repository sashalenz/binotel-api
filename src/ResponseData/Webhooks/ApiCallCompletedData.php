<?php

namespace Sashalenz\Binotel\ResponseData\Webhooks;

use Spatie\LaravelData\Data;

final class ApiCallCompletedData extends Data
{
    public function __construct(
        public string $requestType,
        public array $callDetails
    ){}
}
