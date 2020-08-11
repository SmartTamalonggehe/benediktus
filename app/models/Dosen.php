<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $guarded=[];

    public function prodi ()
    {
        return $this->belongsTo(Prodi::class);
    }
}
