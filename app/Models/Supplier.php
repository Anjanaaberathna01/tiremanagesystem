<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tire_size',
        'brand',
        'address',
        'country',
        'phone_number',
        'email',
        'comment',
    ];

    //tires relationship
    public function tires()
    {
        return $this->hasMany(Tire::class);
    }


}