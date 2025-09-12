<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_number',
        'model',
        'brand',
        'register_year',
        'engine_number',
        'chassis_number',
        'branch',
        'department',
    ];

    public function tireRequests()
    {
        return $this->hasMany(TireRequest::class);
    }
}