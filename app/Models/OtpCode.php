<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','session_id','token','valid_until'
    ];

    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
