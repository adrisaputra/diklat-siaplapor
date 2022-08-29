<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipDigital extends Model
{
    // use HasFactory;
	protected $table = 'arsip_digital_tbl';
	protected $fillable =[
        'pegawai_id',
        'nama_arsip',
        'arsip_digital',
        'user_id'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai');
    }
}
