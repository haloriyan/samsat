<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pkb extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','nopol','payment_date'
    ];

    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
