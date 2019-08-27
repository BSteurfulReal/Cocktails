<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * @mixin Builder
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
abstract class Model extends EloquentModel
{
    public const DELETED_AT = 'deleted_at';

    protected $dates = [
        self::CREATED_AT,
        self::UPDATED_AT,
    ];
}
