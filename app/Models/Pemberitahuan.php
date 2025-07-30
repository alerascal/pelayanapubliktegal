<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemberitahuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipe',
        'tipe_id',
        'judul',
        'pesan',
    ];

    // Relasi dengan Aspirasi
    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }

    }

 
