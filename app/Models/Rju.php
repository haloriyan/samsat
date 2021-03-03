<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rju extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','name','address','npwp','phone','status'
    ];

    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
