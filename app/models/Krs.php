<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';
    protected $guarded=[];

    public function perwalian()
    {
        return $this->belongsTo(Perwalian::class);
    }
}
