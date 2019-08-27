<?php

namespace App\Listeners\Ingredients;

use App\Events\Ingredients\IngredientDeleting;
use Illuminate\Support\Facades\DB;

class CleanupChildModelsListener
{
    public function handle(IngredientDeleting $event): void
    {
        $ingredient = $event->getIngredient();

        $ingredient->update([
            'pump_id'=>null,
        ]);
    }
}
