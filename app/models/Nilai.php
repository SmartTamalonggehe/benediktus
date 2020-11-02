<?php

namespace App\models;

use App\Models\Kontrak;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $guarded=[];

    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class);
    }
}
