<?php

namespace App\Models;

use App\models\KomenPerwalian;
use Illuminate\Database\Eloquent\Model;

class Perwalian extends Model
{
    protected $table = 'perwalian';
    protected $guarded=[];

    public function mhs()
    {
        return $this->belongsTo(Mhs::class);
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function komenPerwalian()
    {
        return $this->hasMany(KomenPerwalian::class);
    }
}
