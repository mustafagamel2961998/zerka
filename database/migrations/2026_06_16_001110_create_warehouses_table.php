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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')
                  ->constrained('countries')
                  ->restrictOnDelete();
            $table->foreignId('city_id')
                  ->constrained('cities')
                  ->restrictOnDelete();
            $table->string('code')->unique();
            $table->string('phone')->unique();
            $table->text('street_details')->nullable();
            $table->string('status')->default('active');      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
