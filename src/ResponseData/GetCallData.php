<?php

namespace Sashalenz\Binotel\ResponseData;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

final class GetCallData extends Data
{
    public function __construct(
        public int $id,
        public string $gaClientId,
        public string $gaTrackingId,
        public string $utm_source,
        public string $utm_medium,
        public string $utm_campaign,
        public string $utm_content,
        public string $utm_term,
        public string $ipAddress,
        public string $geoipCountry,
        public string $geoipRegion,
        public string $geoipCity,
        public string $geoipOrg,
        public string $domain,
        public bool $isNewNumber,
        public bool $isProcessed,
        public int $requestsCounter,
        public int $attemptsCounter,
        public int $employeesDontAnswerCounter,
        public string $fullUrl,
        public string $description,
        #[WithCast(DateTimeInterfaceTransformer::class)]
        public ?Carbon $createdAt = null,
        #[WithCast(DateTimeInterfaceTransformer::class)]
        public ?Carbon $callAt = null,
        #[WithCast(DateTimeInterfaceTransformer::class)]
        public ?Carbon $processedAt = null,
    ) {}
}
