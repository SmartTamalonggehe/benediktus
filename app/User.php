<?php

namespace App;

use App\Models\Dosen;
use App\Models\Mhs;
use App\Models\Tools;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tools()
    {
        return $this->hasOne(Tools::class,'id');
    }
    public function dosen()
    {
        return $this->hasOne(Dosen::class,'id');
    }
    public function mhs()
    {
        return $this->hasOne(Mhs::class,'id');
    }
    public function panitia()
    {
        return $this->hasOne(Panitia::class,'id');
    }
}
