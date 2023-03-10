<?php

namespace Sashalenz\Binotel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sashalenz\Binotel\Enums\DispositionEnum;

class BinotelCallHistory extends Model
{
    protected $guarded = [];
    protected $table = 'binotel_call_history';
    public $timestamps = false;

    protected $casts = [
        'waitsec' => 'integer',
        'billsec' => 'integer',
        'disposition' => DispositionEnum::class
    ];

    public function binotelCall(): BelongsTo
    {
        return $this->belongsTo(BinotelCall::class);
    }
}
