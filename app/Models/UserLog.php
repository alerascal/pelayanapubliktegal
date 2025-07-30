<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $table = 'user_logs';

    protected $fillable = [
        'user_id',
        'activity',
        'activity_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
    'activity_at' => 'datetime',
];

}

