<?php

use App\Models\Capybara;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Capybara::insert([
            [
                'name' => 'Colossus',
                'hex_color' => '#825908',
                'length_inches' => 60,
                'height_inches' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Steven',
                'hex_color' => '#392703',
                'length_inches' => 48,
                'height_inches' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Capybaby',
                'hex_color' => '#5E3F04',
                'length_inches' => 36,
                'height_inches' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
};
