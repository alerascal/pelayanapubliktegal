<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganMagang extends Model
{
    use HasFactory;

    protected $table = 'lowongan_magang';

    protected $fillable = [
        'judul',
        'deskripsi',
        'kuota',
        'deadline',
        'periode',
        'tahun',
    ];

public function user()
{
    return $this->belongsTo(User::class);
}

    public function pendaftar()
    {
        return $this->hasMany(PendaftaranMagang::class, 'lowongan_id');
    }
    public function createdBy()
{
    return $this->belongsTo(User::class, 'created_by');
}
}

