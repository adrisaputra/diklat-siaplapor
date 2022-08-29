<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $fillable = [
        'office_id',
        'date',
        'type',
        'about',
        'cover_letter',
        'review_staff',
        'official_memo',
        'approval_concept',
        'draft',
        'status',
    ];

    public function office()
    {
        return $this->belongsTo('App\Models\Office');
    }
    
}
