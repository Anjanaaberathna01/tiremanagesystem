<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportApproval extends Model
{
    protected $fillable = [
        'request_id',
        'user_id',
        'status',
        'transport_comments',
        'transport_officer_number',
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