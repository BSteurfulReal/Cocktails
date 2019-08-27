<?php

namespace App\Models;

use App\Events\Ingredients\IngredientDeleting;
use App\Models\Concerns\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 * @property float $volume
 * @property int|null $percentage
 * @property int|null $pump_id
 *
 * @property Pump $pump
 */
class Ingredient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'volume',
        'percentage',
        'pump_id'
    ];
    protected $dates = [
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];
    protected $casts = [
        'volume' => 'float',
        'percentage' => 'int',
        'pump_id' => 'int',
    ];
    protected $dispatchesEvents = [
        'deleting' => IngredientDeleting::class,
    ];

    public function pump(): BelongsTo
    {
        return $this->belongsTo(Pump::class);
    }
}
