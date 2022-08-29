<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    protected $table = 'klasifikasi_tbl';
	protected $fillable =[
        'kode',
        'nama'
    ];

    public function surat_keluar(){
        return $this->hasOne('App\Models\SuratKeluar');
    }
}
