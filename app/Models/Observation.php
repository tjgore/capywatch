<?php

namespace App\Models;

use App\Models\City;
use App\Models\Capybara;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Observation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'observed_at' => 'datetime:Y-m-d',
    ];

    public function capybara()
    {
        return $this->belongsTo(Capybara::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
