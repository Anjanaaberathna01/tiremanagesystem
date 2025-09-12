<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MechanicalApprovalCheck extends Model
{
    protected $fillable = [
        'request_id', 'user_id', 'warranty_state', 'incorrect_alignment', 'detective_steering_system',
        'detective_suspension', 'purchase_tires', 'mechanic_comments', 'mechanic_officer_services_number',
        'approval_status', 'updated_at'
    ];
    public $timestamps = false;

    public function tireRequest()
    {
        return $this->belongsTo(TireRequest::class, 'request_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}