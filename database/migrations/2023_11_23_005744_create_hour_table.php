<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hour', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professional_id')->constrained();
            $table->date('date');
            $table->time('time');
            $table->boolean('checked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hour');
    }
};
