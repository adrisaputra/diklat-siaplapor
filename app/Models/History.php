<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = [
        'office_id',
        'taker_name',
        'taker_phone',
        'taker_date',
        'depositor_name',
        'depositor_date',
    ];

    public function office()
    {
        return $this->belongsTo('App\Models\Office');
    }
}
