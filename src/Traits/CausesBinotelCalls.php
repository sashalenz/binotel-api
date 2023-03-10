<?php

namespace Sashalenz\Binotel\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sashalenz\Binotel\Models\BinotelCall;

trait CausesBinotelCalls
{
    public function binotelCalls(): HasMany
    {
        return $this->hasMany(BinotelCall::class, 'employee_id');
    }

    public function binotelCallsToday(): HasMany
    {
        return $this->binotelCalls()->whereDate('start_time', Carbon::today());
    }
}
