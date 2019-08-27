<?php

/*
 * --------------------------------------------------------------------------
 * Web Routes
 * --------------------------------------------------------------------------
 * Here is where you can register web routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * contains the "web" middleware group. Now create something great!
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'ApplicationController@index')->name('home');
Route::get('/cocktail/{id}', 'ApplicationController@cocktail')->name('cocktail');
Route::post('/cocktail/{id}/serve', 'CocktailController@serve')->name('cocktail.serve');
Route::get('/cocktail/{id}/serve', 'CocktailController@serve')->name('cocktail.serve.get');

Route::middleware('auth')->group(function (): void {
    Route::get('/admin', 'ApplicationController@admin')->name('admin');

    Route::resource('/admin/cocktails', 'Admin\CocktailsController');
    Route::resource('/admin/ingredients', 'Admin\IngredientsController');
});
