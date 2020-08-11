<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mhs extends Model
{
    protected $table = 'mhs';
    protected $guarded=[];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
    public function perwalian()
    {
        return $this->hasOne(Perwalian::class);
    }
}
