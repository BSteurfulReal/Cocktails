<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function addIngredient(Request $request)
    {
        return view('partials.add.ingredient', [
            'ingredient' => Ingredient::find($request->get('id')),
        ]);
    }
}
