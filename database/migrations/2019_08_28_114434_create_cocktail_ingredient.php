<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCocktailIngredient extends Migration
{
    public function up(): void
    {
        Schema::create('cocktail_ingredient', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cocktail_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->integer('order');
            $table->integer('percentage')->nullable();

            $table->foreign('cocktail_id')->references('id')->on('cocktails');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cocktail_ingredient');
    }
}
