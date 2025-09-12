<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TireRequest extends Model
{
    protected $fillable = [
        'user_id', 'vehicle_id', 'tire_id','request_code', 'user_section', 'delivery_place_office', 'delivery_place_town',
        'last_replacement_date', 'existing_tire_make', 'tire_size_required', 'tire_brand_required',
        'number_of_tires', 'total_price', 'warranty', 'cost_center', 'present_km_reading',
        'previous_km_reading', 'tire_wear_pattern', 'comment', 'images'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function sectionApproval()
    {
        return $this->hasOne(SectionApproval::class, 'request_id');
    }

    public function mechanicalApprovalCheck()
    {
        return $this->hasOne(MechanicalApprovalCheck::class, 'request_id');
    }
}