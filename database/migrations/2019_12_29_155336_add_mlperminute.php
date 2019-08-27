<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMlperminute extends Migration
{
    public function up(): void
    {
        Schema::table('pumps', function (Blueprint $table): void {
            $table->integer('ml_per_minute');
        });
    }

    public function down(): void
    {
        Schema::table('pumps', function (Blueprint $table): void {
            $table->dropColumn('ml_per_minute');
        });
    }
}
