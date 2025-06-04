<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    use HasFactory;

    // Specify the table name (optional, if the table name follows Laravel's naming convention)
    protected $table = 'weather_data';

    // Specify the fields that are mass assignable (i.e., fields that can be filled directly)
    protected $fillable = [
        'location_id',
        'date',
        'temperature',
        'humidity',
        'rain',
    ];

    // Define the relationship with the Location model
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
