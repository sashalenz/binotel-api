<?php

namespace Sashalenz\Binotel\ApiModels;

use Sashalenz\Binotel\Exceptions\BinotelException;

final class Calls extends BaseModel
{
    protected string $model = 'calls';

    /**
     * @param array $params
     * @return int|null
     * @throws BinotelException
     */
    public function internalNumberToExternalNumber(array $params):? int
    {
        return $this->method('internal-number-to-external-number')
            ->params($params)
            ->validate([
                'internalNumber' => ['required', 'numeric'],
                'externalNumber' => ['required', 'string', 'size:10'],
                'pbxNumber' => ['nullable', 'string', 'size:10'],
                'limitCallTime' => ['nullable', 'numeric', 'min:0'],
                'callTimeToExt' => ['nullable', 'numeric', 'min:0'],
                'playbackWaiting' => ['nullable', 'in:TRUE,FALSE'],
                'callerIdForEmployee' => ['nullable', 'string'],
                'async' => ['nullable', 'in:TRUE,FALSE'],
            ])
            ->request()
            ->get('generalCallID');
    }

    /**
     * @param array $params
     * @return int|null
     * @throws BinotelException
     */
    public function externalNumberToExternalNumber(array $params):? int
    {
        return $this->method('external-number-to-external-number')
            ->params($params)
            ->validate([
                'externalNumber1' => ['required', 'string', 'size:10'],
                'externalNumber2' => ['required', 'string', 'size:10'],
                'pbxNumber' => ['required', 'string', 'size:10'],
                'limitCallTime' => ['nullable', 'numeric', 'min:0'],
                'playbackWaiting' => ['nullable', 'in:TRUE,FALSE'],
            ])
            ->request()
            ->get('generalCallID');
    }

    /**
     * @param array $params
     * @return int|null
     * @throws BinotelException
     */
    public function externalNumberToIncomingCall(array $params):? int
    {
        return $this->method('external-number-to-incoming-call')
            ->params($params)
            ->validate([
                'externalNumber' => ['required', 'string', 'size:10'],
                'pbxNumber' => ['required', 'string', 'size:10'],
                'pbxNumberInExternalCall' => ['nullable', 'size:10'],
            ])
            ->request()
            ->get('generalCallID');
    }

    /**
     * @param int $generalCallID
     * @param string $externalNumber
     * @throws BinotelException
     */
    public function attendedCallTransfer(int $generalCallID, string $externalNumber): void
    {
        $this->method('attended-call-transfer')
            ->params([
                'generalCallID' => $generalCallID,
                'externalNumber' => $externalNumber,
            ])
            ->validate([
                'generalCallID' => ['required', 'numeric'],
                'externalNumber' => ['required', 'string', 'size:10'],
            ])
            ->request();
    }

    /**
     * @param int $generalCallID
     * @throws BinotelException
     */
    public function hangupCall(int $generalCallID): void
    {
        $this->method('attended-call-transfer')
            ->params([
                'generalCallID' => $generalCallID,
            ])
            ->validate([
                'generalCallID' => ['required', 'numeric'],
            ])
            ->request();
    }

    /**
     * @param array $params
     * @throws BinotelException
     */
    public function callWithAnnouncement(array $params): void
    {
        $this->method('call-with-announcement')
            ->params($params)
            ->validate([
                'externalNumber' => ['required', 'string', 'size:10'],
                'voiceFileID' => ['required', 'numeric'],
            ])
            ->request();
    }

    /**
     * @param array $params
     * @throws BinotelException
     */
    public function callWithInteractiveVoiceResponse(array $params): void
    {
        $this->method('call-with-interactive-voice-response')
            ->params($params)
            ->validate([
                'externalNumber' => ['required', 'string', 'size:10'],
                'ivrName' => ['required', 'string'],
                'rewriteInternalNumber' => ['nullable'],
            ])
            ->request();
    }
}
