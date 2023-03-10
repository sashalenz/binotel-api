<?php

namespace Sashalenz\Binotel\DataTransferObjects;

final class CallTrackingDataTransferObject extends BinotelDataTransferObject
{
    public int $id;
    public string $gaClientId;
    public string $gaTrackingId;
    public string $utm_source;
    public string $utm_medium;
    public string $utm_campaign;
    public string $utm_content;
    public string $utm_term;
    public string $ipAddress;
    public string $geoipCountry;
    public string $geoipRegion;
    public string $geoipCity;
    public string $geoipOrg;
    public string $domain;
    public int $timeSpentOnSiteBeforeMakeCall;
    public bool $firstVisitAt;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => $array['id'],
            'gaClientId' => $array['gaClientId'],
            'gaTrackingId' => $array['gaTrackingId'],
            'utm_source' => $array['utm_source'],
            'utm_medium' => $array['utm_medium'],
            'utm_campaign' => $array['utm_campaign'],
            'utm_content' => $array['utm_content'],
            'utm_term' => $array['utm_term'],
            'ipAddress' => $array['ipAddress'],
            'geoipCountry' => $array['geoipCountry'],
            'geoipRegion' => $array['geoipRegion'],
            'geoipCity' => $array['geoipCity'],
            'geoipOrg' => $array['geoipOrg'],
            'domain' => $array['domain'],
            'timeSpentOnSiteBeforeMakeCall' => $array['timeSpentOnSiteBeforeMakeCall'],
            'firstVisitAt' => $array['firstVisitAt'],
        ]);
    }
}
