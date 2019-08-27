<?php

namespace App\Models\Concerns;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes as EloquentSoftDeletes;

/**
 * @property Carbon|null $deleted_at
 */
trait SoftDeletes
{
    use EloquentSoftDeletes;
}
