<?php

namespace Sashalenz\Binotel\ApiModels;

use Illuminate\Support\Collection;
use Sashalenz\Binotel\DataTransferObjects\StatDataTransferObject;
use Sashalenz\Binotel\Exceptions\BinotelException;

final class Stats extends BaseModel
{
    protected string $model = 'stats';

    /**
     * @param int $startTime
     * @param int $stopTime
     * @return Collection
     * @throws BinotelException
     */
    public function incomingCallsForPeriod(int $startTime, int $stopTime): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('incoming-calls-for-period')
                ->params([
                    'startTime' => $startTime,
                    'stopTime' => $stopTime,
                ])
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param int $startTime
     * @param int $stopTime
     * @return Collection
     * @throws BinotelException
     */
    public function outgoingCallsForPeriod(int $startTime, int $stopTime): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('outgoing-calls-for-period')
                ->params([
                    'startTime' => $startTime,
                    'stopTime' => $stopTime,
                ])
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param int $startTime
     * @param int $stopTime
     * @return Collection
     * @throws BinotelException
     */
    public function calltrackingCallsForPeriod(int $startTime, int $stopTime): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('calltracking-calls-for-period')
                ->params([
                    'startTime' => $startTime,
                    'stopTime' => $stopTime,
                ])
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param int $timestamp
     * @return Collection
     * @throws BinotelException
     */
    public function allIncomingCallsSince(int $timestamp): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('all-incoming-calls-since')
                ->params([
                    'timestamp' => $timestamp,
                ])
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param int $timestamp
     * @return Collection
     * @throws BinotelException
     */
    public function allOutgoingCallsSince(int $timestamp): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('all-outgoing-calls-since')
                ->params([
                    'timestamp' => $timestamp,
                ])
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param int $internalNumber
     * @param int $startTime
     * @param int $stopTime
     * @return Collection
     * @throws BinotelException
     */
    public function listOfCallsByInternalNumberForPeriod(int $internalNumber, int $startTime, int $stopTime): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('list-of-calls-by-internal-number-for-period')
                ->params([
                    'internalNumber' => $internalNumber,
                    'startTime' => $startTime,
                    'stopTime' => $stopTime,
                ])
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param int|null $dayInTimestamp
     * @return Collection
     * @throws BinotelException
     */
    public function listOfCallsPerDay(int $dayInTimestamp = null): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('list-of-calls-per-day')
                ->params(array_filter([
                    'dayInTimestamp' => $dayInTimestamp,
                ]))
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param int $startTime
     * @param int $stopTime
     * @return Collection
     * @throws BinotelException
     */
    public function listOfCallsForPeriod(int $startTime, int $stopTime): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('list-of-calls-for-period')
                ->params([
                    'startTime' => $startTime,
                    'stopTime' => $stopTime,
                ])
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @return Collection
     * @throws BinotelException
     */
    public function listOfLostCallsForToday(): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('list-of-lost-calls-for-today')
                ->cache(10)
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @return Collection
     * @throws BinotelException
     */
    public function onlineCalls(): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('online-calls')
                ->cache(5)
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param array $externalNumbers
     * @return Collection
     * @throws BinotelException
     */
    public function historyByExternalNumber(array $externalNumbers): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('history-by-external-number')
                ->params([
                    'externalNumbers' => $externalNumbers,
                ])
                ->cache(5)
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param int|array $customerID
     * @return Collection
     * @throws BinotelException
     */
    public function historyByCustomerId(int | array $customerID): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('history-by-customer-id')
                ->params([
                    'customerID' => $customerID,
                ])
                ->cache(5)
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param int $internalNumber
     * @return Collection
     * @throws BinotelException
     */
    public function recentCallsByInternalNumber(int $internalNumber): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('recent-calls-by-internal-number')
                ->params([
                    'internalNumber' => $internalNumber,
                ])
                ->cache(5)
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param array $generalCallID
     * @return Collection
     * @throws BinotelException
     */
    public function callDetails(array $generalCallID): Collection
    {
        return StatDataTransferObject::collectFromArray(
            $this->method('call-details')
                ->params([
                    'generalCallID' => $generalCallID,
                ])
                ->cache(10)
                ->request()
                ->get('callDetails')
        );
    }

    /**
     * @param int $generalCallID
     * @return string
     * @throws BinotelException
     */
    public function callRecord(int $generalCallID): string
    {
        return $this->method('call-record')
            ->params([
                'generalCallID' => $generalCallID,
            ])
            ->cache(10)
            ->request()
            ->get('url');
    }
}
