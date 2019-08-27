<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTable extends Migration
{
    public function up(): void
    {
        Schema::create('history', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->timestamp('time');
            $table->bigInteger('cocktail_id');
            $table->string('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history');
    }
}
