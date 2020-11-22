<?php

namespace App\Models;

use App\models\Nilai;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    protected $table = 'kontrak';
    protected $guarded=[];

    public function krs()
    {
        return $this->belongsTo(Krs::class);
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
    public function nilai(){
        return $this->hasOne(Nilai::class);
    }
}
