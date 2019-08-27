<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use App\Models\Ingredient;
use Illuminate\Contracts\View\View;

class ApplicationController extends Controller
{
    public const redirectToAsGuest = '/';
    public const redirectToAfterLogin = '/admin';

    public function index(): View
    {
        return view('index', [
            'cocktails' => Cocktail::all(),
        ]);
    }

    public function admin(): View
    {
        return view('admin.index', [
            'data' => [
                'cocktailCount' => Cocktail::all()->count(),
                'ingredients' => [
                    'pumpCount' => Ingredient::withTrashed()->count('pump_id'),
                    'ingCount' => Ingredient::all()->count(),
                ],
            ],
        ]);
    }

    public function cocktail($id): View
    {
        return view('cocktail', [
            'cocktail' => Cocktail::find($id),
        ]);
    }
}
