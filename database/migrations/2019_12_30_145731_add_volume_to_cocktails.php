<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVolumeToCocktails extends Migration
{
    public function up(): void
    {
        Schema::table('cocktails', function (Blueprint $table): void {
            $table->integer('volume');
        });
    }

    public function down(): void
    {
        Schema::table('cocktails', function (Blueprint $table): void {
            $table->dropColumn('volume');
        });
    }
}
