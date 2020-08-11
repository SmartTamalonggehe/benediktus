<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    protected $table = 'khs';
    protected $guarded=[];

    public function mhs()
    {
        return $this->belongsTo(Mhs::class);
    }
}
