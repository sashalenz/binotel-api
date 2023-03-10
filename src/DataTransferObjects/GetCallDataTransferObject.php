<?php

namespace Sashalenz\Binotel\DataTransferObjects;

use Carbon\Carbon;

final class GetCallDataTransferObject extends BinotelDataTransferObject
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
    public bool $isNewNumber;
    public Carbon $createdAt;
    public Carbon $callAt;
    public Carbon $processedAt;
    public bool $isProcessed;
    public int $requestsCounter;
    public int $attemptsCounter;
    public int $employeesDontAnswerCounter;
    public string $fullUrl;
    public string $description;

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
            'isNewNumber' => $array['isNewNumber'],
            'createdAt' => isset($array['createdAt'])
                ? Carbon::createFromFormat('Y-m-d H:i:s', $array['createdAt'])
                : null,
            'callAt' => isset($array['callAt'])
                ? Carbon::createFromFormat('Y-m-d H:i:s', $array['callAt'])
                : null,
            'processedAt' => isset($array['processedAt'])
                ? Carbon::createFromFormat('Y-m-d H:i:s', $array['processedAt'])
                : null,
            'isProcessed' => (bool) $array['isProcessed'],
            'requestsCounter' => $array['requestsCounter'],
            'attemptsCounter' => $array['attemptsCounter'],
            'employeesDontAnswerCounter' => $array['employeesDontAnswerCounter'],
            'fullUrl' => $array['fullUrl'],
            'description' => $array['description'],
        ]);
    }
}
