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
        Schema::create('observations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('capybara_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->boolean('has_hat')->default(false);

            $table->date('observed_at');
            $table->timestamps();

            $table->unique(['capybara_id', 'city_id', 'observed_at']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observations');
    }
};
