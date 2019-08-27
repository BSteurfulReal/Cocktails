<?php

namespace App\Events\Ingredients;

use App\Models\Ingredient;

abstract class IngredientEvent
{
    private Ingredient $ingredient;

    public function __construct(Ingredient $ingredient)
    {
        $this->ingredient = $ingredient;
    }

    public final function getIngredient(): Ingredient
    {
        return $this->ingredient;
    }
}
