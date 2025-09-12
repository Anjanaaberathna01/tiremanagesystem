<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tire extends Model
{
    use HasFactory;

    protected $fillable = [
        'size','brand','reference_no', 'price', 'warranty_distance', 'supplier_id','reference_no','date'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function tireRequests()
    {
        return $this->hasMany(TireRequest::class);
    }
}