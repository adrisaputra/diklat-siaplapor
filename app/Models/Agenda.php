<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_of_entry',
        'letter_date',
        'letter_number',
        'letter_from',
        'about',
        'on_process',
    ];
}
