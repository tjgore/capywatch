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
        Schema::create('capybaras', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('hex_color');
            $table->unsignedInteger('length_inches');
            $table->unsignedInteger('height_inches');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capybaras');
    }
};
