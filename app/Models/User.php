<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomResetPassword;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nik',
        'phone',
        'alamat',
        'role',
        'is_master',
        'is_banned',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_banned' => 'boolean',
    ];

    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class);
    }
   public function anggotaDewan()
{
    return $this->hasOne(AnggotaDewan::class);
}

    public function userLogs()
    {
        return $this->hasMany(UserLog::class);
    }

  public function isAdmin()
{
    return in_array($this->role, ['admin', 'master']);
}

      public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }
    
public function sendPasswordResetNotification($token)
{
    $this->notify(new CustomResetPassword($token, $this));
}
public function getIsMasterAttribute()
{
    return $this->role === 'master';
}

}
