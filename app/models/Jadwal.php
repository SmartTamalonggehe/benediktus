<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $guarded=[];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function kelas()
    {
        return $this->hasOne(kelas::class);
    }

    public function aturan()
    {
        return $this->hasOne(aturan::class);
    }
}
