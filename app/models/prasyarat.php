<?php

namespace App\models;

use App\Models\Matkul;
use Illuminate\Database\Eloquent\Model;

class prasyarat extends Model
{
    protected $table = 'prasyarat';
    protected $guarded=[];

    public function syarat()
    {
        return $this->belongsTo(Matkul::class,'syarat_id');
    }
    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }
}
