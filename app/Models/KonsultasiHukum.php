<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsultasiHukum extends Model
{
    // use HasFactory;
	protected $table = 'non_litigasi_tbl';
	protected $fillable =[
        'kategori',
        'judul',
        'deskripsi',
        'tahun',
        'arsip_non_litigasi',
        'user_id'
    ];
}
