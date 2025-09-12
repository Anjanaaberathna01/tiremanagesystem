<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionApproval extends Model
{
    protected $fillable = [
        'request_id', 'user_id', 'status', 'supervisor_comments', 'officer_services_number', 'updated_at'
    ];
    public $timestamps = false;

    public function tireRequest()
    {
        return $this->belongsTo(\App\Models\TireRequest::class, 'request_id');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}