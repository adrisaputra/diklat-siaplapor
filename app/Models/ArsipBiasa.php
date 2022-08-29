<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipBiasa extends Model
{
    // use HasFactory;
	protected $table = 'arsip_biasa_tbl';
	protected $fillable =[
        'nomor_arsip',
        'perihal',
        'tanggal_arsip',
        'arsip',
        'user_id'
    ];
}
