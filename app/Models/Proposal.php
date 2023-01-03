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
        'responsible_person',
        'whatsapp',
        'cover_letter',
        'status1',
        'desc1',
        'review_staff',
        'status2',
        'desc2',
        'official_memo',
        'status3',
        'desc3',
        'approval_concept',
        'status4',
        'desc4',
        'draft',
        'status5',
        'desc5',
        'status',
        'date_disposition1',
        'date_disposition2',
        'date_disposition3',
        'date_disposition4',
        'date_disposition5',
    ];

    public function office()
    {
        return $this->belongsTo('App\Models\Office');
    }
    
}
