<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cocktail;
use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CocktailsController extends Controller
{
    public function index(): View
    {
        return view('admin.cocktails.index', [
            'cocktails' => Cocktail::all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.cocktails.show', [
            'ingredients' => Ingredient::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['name' => 'required']);

        $cocktail = Cocktail::create([
            'name' => $request->get('name'),
            'volume' => 1,
        ]);

        $this->applyImage($request, $cocktail);
        $this->applyIngredients($request, $cocktail);

        return Redirect::route('cocktails.edit', $cocktail->id)
            ->with('success', __('Cocktail toegevoegd!'));
    }

    public function show(Cocktail $cocktail): RedirectResponse
    {
        return redirect(route('cocktails.edit', $cocktail));
    }

    public function edit(Cocktail $cocktail): View
    {
        return view('admin.cocktails.show', [
            'cocktail' => $cocktail,
            'ingredients' => Ingredient::all(),
        ]);
    }

    public function update(Request $request, Cocktail $cocktail): RedirectResponse
    {
        $cocktail->update([
            'name' => $request->get('name'),
        ]);

        $this->applyImage($request, $cocktail);
        $this->applyIngredients($request, $cocktail);

        return redirect(route('cocktails.edit', $cocktail))
            ->with('success', __('Cocktail bijgewerkt'));
    }

    public function destroy(Cocktail $cocktail): RedirectResponse
    {
        $cocktail->delete();

        return redirect(route('cocktails.index'))
            ->with('success', __('Cocktail verwijderd'));
    }

    private function applyImage(Request $request, Cocktail $cocktail): void
    {
        if ($request->get('imgChanged') === 'true') {
            $this->upload($cocktail);

            $cocktail->update([
                'img' => $_FILES['imageFile']['name'],
            ]);
        }
    }

    private function upload(Cocktail $cocktail): void
    {
        $folder = $cocktail->imgFolder;

        if (!file_exists($folder)) {
            mkdir($folder, 0775, true);
        }

        move_uploaded_file(
            $_FILES['imageFile']['tmp_name'],
            $folder . $_FILES['imageFile']['name'],
        );
    }

    private function applyIngredients(Request $request, Cocktail $cocktail): void
    {
        $ingredients = $request->get('ingredients');
        $percentages = $request->get('percentages');

        DB::table('cocktail_ingredient')
            ->where(['cocktail_id' => $cocktail->id])
            ->delete();

        for ($i = 0; $i < sizeof($ingredients);) {
            DB::table('cocktail_ingredient')->insert([
                'cocktail_id' => $cocktail->id,
                'ingredient_id' => $ingredients[$i],
                'order' => ++$i,
                'percentage' => $percentages[$i]
            ]);
        }
    }
}
