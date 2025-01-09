<?php

namespace Sashalenz\Binotel\ApiModels;

use Sashalenz\Binotel\Exceptions\BinotelException;
use Sashalenz\Binotel\ResponseData\StatData;
use Spatie\LaravelData\DataCollection;

final class Stats extends BaseModel
{
    protected string $model = 'stats';

    /**
     * @param int $startTime
     * @param int $stopTime
     * @return DataCollection
     * @throws BinotelException
     */
    public function incomingCallsForPeriod(int $startTime, int $stopTime): DataCollection
    {
        return $this
            ->method('incoming-calls-for-period')
            ->params([
                'startTime' => $startTime,
                'stopTime' => $stopTime,
            ])
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param int $startTime
     * @param int $stopTime
     * @return DataCollection
     * @throws BinotelException
     */
    public function outgoingCallsForPeriod(int $startTime, int $stopTime): DataCollection
    {
        return $this
            ->method('outgoing-calls-for-period')
            ->params([
                'startTime' => $startTime,
                'stopTime' => $stopTime,
            ])
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param int $startTime
     * @param int $stopTime
     * @return DataCollection
     * @throws BinotelException
     */
    public function callTrackingCallsForPeriod(int $startTime, int $stopTime): DataCollection
    {
        return $this
            ->method('calltracking-calls-for-period')
            ->params([
                'startTime' => $startTime,
                'stopTime' => $stopTime,
            ])
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param int $timestamp
     * @return DataCollection
     * @throws BinotelException
     */
    public function allIncomingCallsSince(int $timestamp): DataCollection
    {
        return $this
            ->method('all-incoming-calls-since')
            ->params([
                'timestamp' => $timestamp,
            ])
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param int $timestamp
     * @return DataCollection
     * @throws BinotelException
     */
    public function allOutgoingCallsSince(int $timestamp): DataCollection
    {
        return $this
            ->method('all-outgoing-calls-since')
            ->params([
                'timestamp' => $timestamp,
            ])
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param int $internalNumber
     * @param int $startTime
     * @param int $stopTime
     * @return DataCollection
     * @throws BinotelException
     */
    public function listOfCallsByInternalNumberForPeriod(int $internalNumber, int $startTime, int $stopTime): DataCollection
    {
        return $this
            ->method('list-of-calls-by-internal-number-for-period')
            ->params([
                'internalNumber' => $internalNumber,
                'startTime' => $startTime,
                'stopTime' => $stopTime
            ])
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param int|null $dayInTimestamp
     * @return DataCollection
     * @throws BinotelException
     */
    public function listOfCallsPerDay(int $dayInTimestamp = null): DataCollection
    {
        return $this
            ->method('list-of-calls-per-day')
            ->params([
                'dayInTimestamp' => $dayInTimestamp
            ])
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param int $startTime
     * @param int $stopTime
     * @return DataCollection
     * @throws BinotelException
     */
    public function listOfCallsForPeriod(int $startTime, int $stopTime): DataCollection
    {
        return $this
            ->method('list-of-calls-for-period')
            ->params([
                'startTime' => $startTime,
                'stopTime' => $stopTime,
            ])
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @return DataCollection
     * @throws BinotelException
     */
    public function listOfLostCallsForToday(): DataCollection
    {
        return $this
            ->method('list-of-lost-calls-for-today')
            ->cache(10)
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @return DataCollection
     * @throws BinotelException
     */
    public function onlineCalls(): DataCollection
    {
        return $this
            ->method('online-calls')
            ->cache(5)
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param array $externalNumbers
     * @return DataCollection
     * @throws BinotelException
     */
    public function historyByExternalNumber(array $externalNumbers): DataCollection
    {
        return $this
            ->method('history-by-external-number')
            ->params([
                'externalNumbers' => $externalNumbers,
            ])
            ->cache(5)
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param int|array $customerID
     * @return DataCollection
     * @throws BinotelException
     */
    public function historyByCustomerId(int | array $customerID): DataCollection
    {
        return $this
            ->method('history-by-customer-id')
            ->params([
                'customerID' => $customerID,
            ])
            ->cache(5)
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param int $internalNumber
     * @return DataCollection
     * @throws BinotelException
     */
    public function recentCallsByInternalNumber(int $internalNumber): DataCollection
    {
        return $this
            ->method('recent-calls-by-internal-number')
            ->params([
                'internalNumber' => $internalNumber,
            ])
            ->cache(5)
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param array $generalCallID
     * @return DataCollection
     * @throws BinotelException
     */
    public function callDetails(array $generalCallID): DataCollection
    {
        return $this
            ->method('call-details')
            ->params([
                'generalCallID' => $generalCallID,
            ])
            ->cache(10)
            ->toCollection(StatData::class, 'callDetails');
    }

    /**
     * @param int $generalCallID
     * @return string
     * @throws BinotelException
     */
    public function callRecord(int $generalCallID): string
    {
        $url = $this->method('call-record')
            ->params([
                'generalCallID' => $generalCallID,
            ])
            ->cache(10)
            ->get('url');

        return $url['url'];
    }
}