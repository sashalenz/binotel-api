<?php

namespace Sashalenz\Binotel\ResponseData;

use Spatie\LaravelData\Data;

final class CallTrackingData extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly string $gaClientId,
        public readonly string $gaTrackingId,
        public readonly string $utm_source,
        public readonly string $utm_medium,
        public readonly string $utm_campaign,
        public readonly string $utm_content,
        public readonly string $utm_term,
        public readonly string $ipAddress,
        public readonly string $geoipCountry,
        public readonly string $geoipRegion,
        public readonly string $geoipCity,
        public readonly string $geoipOrg,
        public readonly string $domain,
        public readonly int $timeSpentOnSiteBeforeMakeCall,
        public readonly bool $firstVisitAt
    ) {}
}
