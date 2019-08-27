<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ingredient;
use App\Models\Pump;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IngredientsController extends Controller
{
    public function index(): View
    {
        return view('admin.ingredients.index', [
            'ingredients' => Ingredient::all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.ingredients.show', [
            'pumps' => Pump::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'volume' => 'required',
            'pump' => 'required|unique:ingredients,pump_id',
        ]);

        $ingredient = Ingredient::create([
            'name' => $request->get('name'),
            'volume' => $request->get('volume'),
            'percentage' => $request->get('percentage'),
            'pump_id' => $request->get('pump')
        ]);

        return redirect(route('ingredients.edit', $ingredient))
            ->with('success', __('Drank toegevoegd'));
    }

    public function show(Ingredient $ingredient): RedirectResponse
    {
        return redirect(route('ingredients.edit', $ingredient));
    }

    public function edit(Ingredient $ingredient): View
    {
        return view('admin.ingredients.show', [
            'ingredient' => $ingredient,
            'pumps' => Pump::all(),
        ]);
    }

    public function update(Request $request, Ingredient $ingredient): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'volume' => 'required',
            'pump' => "required|unique:ingredients,pump_id,$ingredient->id"
        ]);

        $ingredient->update([
            'name' => $request->get('name'),
            'volume' => $request->get('volume'),
            'percentage' => $request->get('percentage'),
            'pump_id' => $request->get('pump'),
        ]);

        return redirect(route('ingredients.edit', $ingredient))
            ->with('success', __('Drank bijgewerkt'));
    }

    public function destroy(Ingredient $ingredient): RedirectResponse
    {
        $ingredient->delete();

        return redirect(route('ingredients.index'))
            ->with('success', __('Drank verwijderd'));
    }
}
