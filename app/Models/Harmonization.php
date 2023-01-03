<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harmonization extends Model
{
    use HasFactory;
    protected $fillable = [
        'office_id',
        'upload_fix',
        'upload_date',
        'taker_name',
        'taker_phone',
        'taker_date',
        'status',
        'depositor_name',
        'depositor_date',
        'initials1',
        'initials2',
        'signature',
        'receiver',
        'receiver_date'
    ];

    public function office()
    {
        return $this->belongsTo('App\Models\Office');
    }
}
