<?php

namespace Sashalenz\Binotel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Config;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;
use Sashalenz\Binotel\Enums\DispositionEnum;

class BinotelCall extends Model
{
    protected $guarded = [];

    protected $dates = [
        'start_time',
    ];

    protected $casts = [
        'waitsec' => 'integer',
        'billsec' => 'integer',
        'disposition' => DispositionEnum::class,
        'is_new_call' => 'boolean',
        'external_number' => E164PhoneNumberCast::class
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Config::get('binotel-api.customer_class'));
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Config::get('binotel-api.employee_class'));
    }

    public function pbx(): BelongsTo
    {
        return $this->belongsTo(Config::get('binotel-api.pbx_class'));
    }

    public function history(): HasMany
    {
        return $this->hasMany(BinotelCallHistory::class, 'binotel_call_id');
    }
}
