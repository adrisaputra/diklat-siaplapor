<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    // use HasFactory;
	protected $table = 'surat_keluar_tbl';
	protected $fillable =[
        'klasifikasi_id',
        'nomor_surat',
        'perihal',
        'tanggal_surat',
        'tujuan',
        'arsip_surat_keluar',
        'kategori',
        'user_id'
    ];

    public function klasifikasi(){
        return $this->belongsTo('App\Models\Klasifikasi');
    }
}
