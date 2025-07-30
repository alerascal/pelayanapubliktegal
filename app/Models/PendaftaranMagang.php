<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranMagang extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_magang';

    protected $fillable = [
        'user_id',
        'lowongan_id',
        'nama',
        'alamat',
        'email',
        'telepon',
        'asal_sekolah',
        'cv',       
        'surat_izin',
        'status',
        'tahun',
        'tanggal_batas_kedatangan',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


    public function lowongan()
    {
        return $this->belongsTo(LowonganMagang::class, 'lowongan_id');
    }
}
