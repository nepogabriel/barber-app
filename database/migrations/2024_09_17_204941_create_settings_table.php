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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('template_client', 30)->default('default');
            $table->string('logo_header', 160)->nullable();
            $table->string('logo_footer', 160)->nullable();
            $table->string('favicon', 160)->nullable();
            $table->string('meta_title', 60)->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->string('meta_keywords', 160)->nullable();
            $table->string('address_store', 160)->nullable();
            $table->string('phone_store', 160)->nullable();
            $table->string('email_store', 160)->nullable();
            $table->string('opening_hours', 160)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
