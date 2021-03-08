<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','nopol','nomor_rangka'
    ];

    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
