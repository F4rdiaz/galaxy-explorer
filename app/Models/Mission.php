<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $casts = [
        'astronot' => 'array',
        'waktu_laporan' => 'datetime',
    ];

    protected $dates = ['waktu_laporan'];

    protected $fillable = [
        'nama_misi',
        'tahun_peluncuran',
        'tahun_kembali',
        'tujuan',
        'keterangan',
        'astronot',
        'status',
        'waktu_laporan',
        'user_id',
    ];
}
