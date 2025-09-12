<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TireOrder extends Model
{
    protected $fillable = [
        'tire_request_id', 'supplier_id', 'order_status', 'order_date', 'ordered_at', 'arrived_at'
    ];

    public function request()
    {
        return $this->belongsTo(TireRequest::class, 'tire_request_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}