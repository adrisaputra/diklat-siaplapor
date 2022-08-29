<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    // use HasFactory;
	protected $table = 'surat_masuk_tbl';
	protected $fillable =[
        'nomor_surat',
        'perihal',
        'tanggal_surat',
        'pengirim',
        'arsip_surat_masuk',
        'user_id'
    ];
}
