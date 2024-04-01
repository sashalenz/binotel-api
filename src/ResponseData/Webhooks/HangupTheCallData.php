<?php

namespace Sashalenz\Binotel\ResponseData\Webhooks;

use Spatie\LaravelData\Data;

class HangupTheCallData extends Data
{
    public function __construct(
        public int $generalCallID,
        public int $billsec,
        public string $disposition,
        public string $requestType,
        public string $method,
    ) { }
}
