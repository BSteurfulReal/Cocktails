<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredients extends Migration
{
    public function up(): void
    {
        Schema::create('ingredients', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name');
            $table->float('volume');
            $table->float('percentage')->nullable();
            $table->unsignedBigInteger('pump_id')->unique()->nullable();

            $table->foreign('pump_id')->references('id')->on('pumps');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
}
