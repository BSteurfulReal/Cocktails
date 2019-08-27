<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePumps extends Migration
{
    public function up(): void
    {
        Schema::create('pumps', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->enum("type", ['BIG', 'SMALL'])->default('SMALL');
            $table->integer('pin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pumps');
    }
}
