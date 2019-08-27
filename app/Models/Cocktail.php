<?php

namespace App\Models;

use App\Models\Concerns\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property string $name
 * @property string|null $img
 * @property-read string|null $imgFolder
 * @property-read string|null $imgUrl
 * @property float $volume
 */
class Cocktail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'img',
        'volume',
    ];
    protected $dates = [
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];
    protected $casts = [
        'volume' => 'float',
    ];

    public function ingredients(): Collection
    {
        return DB::table('cocktail_ingredient')
            ->where(['cocktail_id' => $this['id']])
            ->get()
            ->map(fn(object $coupling): Ingredient => $this->mapIngredientFromCoupling($coupling));
    }

    private function mapIngredientFromCoupling(object $coupling): Ingredient
    {
        $ingredient = Ingredient::find($coupling->ingredient_id);

        $ingredient->coupling_order = $coupling->order;
        $ingredient->coupling_percentage = $coupling->percentage;

        return $ingredient;
    }

    protected function getImgFolder(): ?string
    {
        return $this->img
            ? "img/cocktails/$this->id"
            : null;
    }

    protected function getImgUrlAttribute(): ?string
    {
        return $this->img
            ? asset("$this->imgFolder/$this->img")
            : null;
    }
}
