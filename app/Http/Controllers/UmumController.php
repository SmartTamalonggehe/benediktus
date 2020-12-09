<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Illuminate\Http\Request;

class UmumController extends Controller
{
    public function mhsKontrak()
    {
        $krs = Krs::where('ket', 'Terima')
            ->where('semester_ak', 'GANJIL')
            ->where('tahun_ak', 2020)
            ->get();

        return $krs;
    }
}
