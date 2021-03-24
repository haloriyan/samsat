<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','session_id','token','has_used','valid_until',
        'action_route','route_value'
    ];

    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
