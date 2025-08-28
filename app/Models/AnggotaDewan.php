<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaDewan extends Model
{
    use HasFactory;
    protected $table = 'anggota_dewan';


    protected $fillable = [
        'nama',
        'jabatan',
        'gambar_anggota',
        'fraksi',
        'user_id',
        'bio',
        'pendidikan',
        'pengalaman',
        'kontak',
        'sosmed',
        'bio_latar',
        'bio_karier',
        'bio_jabatan',
        'bio_visi',
        'bio_fokus',
    ];

    protected $casts = [
        'pendidikan' => 'array',
        'pengalaman' => 'array',
        'sosmed' => 'array',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
