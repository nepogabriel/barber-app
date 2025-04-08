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
        Schema::table('hour_controls', function (Blueprint $table) {
            $table->foreignId('service_id')
                ->after('hour_id')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hour_controls', function (Blueprint $table) {
            $table->dropConstrainedForeignId('service_id');
        });
    }
};
