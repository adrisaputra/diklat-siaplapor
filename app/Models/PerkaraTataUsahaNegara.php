<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkaraTataUsahaNegara extends Model
{
    // use HasFactory;
	protected $table = 'litigasi_tbl';
	protected $fillable =[
        'kategori',
        'judul',
        'deskripsi',
        'tahun',
        'arsip_litigasi',
        'user_id'
    ];
}
