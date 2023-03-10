<?php

namespace Sashalenz\Binotel\Enums;

enum DispositionEnum: string
{
    case ANSWER = 'ANSWER';
    case TRANSFER = 'TRANSFER';
    case ONLINE = 'ONLINE';
    case CALLING = 'CALLING';
    case BUSY = 'BUSY';
    case NOANSWER = 'NOANSWER';
    case CANCEL = 'CANCEL';
    case CONGESTION = 'CONGESTION';
    case CHANUNAVAIL = 'CHANUNAVAIL';
    case VM = 'VM';
    case VM_SUCCESS = 'VM-SUCCESS';
    case SMS_SENDING = 'SMS-SENDING';
    case SMS_SUCCESS = 'SMS-SUCCESS';
    case SMS_FAILED = 'SMS-FAILED';
    case SUCCESS = 'SUCCESS';
    case FAILED = 'FAILED';

    public static function toArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (DispositionEnum $enum) => [$enum->name => $enum->value])
            ->toArray();
    }
}
