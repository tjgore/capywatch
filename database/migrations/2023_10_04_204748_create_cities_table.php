<?php

use App\Models\City;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        City::insert([
            [
                'name' => 'Chicago',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Atlanta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'New York',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Houston',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            [
                'name' => 'San Francisco',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
