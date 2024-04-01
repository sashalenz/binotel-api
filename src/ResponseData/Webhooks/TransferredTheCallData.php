<?php

namespace Sashalenz\Binotel\ResponseData\Webhooks;

use Spatie\LaravelData\Data;

class TransferredTheCallData extends Data
{
    public function __construct(
        public int $internalNumber,
        public int $generalCallID,
        public int $companyID,
        public string $requestType,
    ) { }
}
