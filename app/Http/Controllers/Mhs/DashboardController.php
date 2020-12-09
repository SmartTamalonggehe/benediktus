<?php

namespace App\Http\Controllers\Mhs;

use App\Models\Krs;
use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $prodi = Prodi::all();
        $krs = Krs::where('ket', 'Terima')
            ->where('semester_ak', 'GANJIL')
            ->where('tahun_ak', 2020)
            ->get();

        return view('mhs.dashboard.index', [
            'krs' => $krs,
            'prodi' => $prodi,
        ]);

    }
}
