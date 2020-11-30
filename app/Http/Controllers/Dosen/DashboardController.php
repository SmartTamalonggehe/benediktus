<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function grafikMhs(Request $request) {
        $dataGrafikMhs = DB::table('nilai')
            ->join('kontrak', 'nilai.kontrak_id', 'kontrak.id')
            ->join('krs','kontrak.krs_id','krs.id')
            ->join('perwalian','krs.perwalian_id','perwalian.id')
            ->where('dosen_id',auth()->user()->dosen->id)
            ->where('mhs_id', $request->mhs_id)
            ->select(DB::raw('tahun_ak, semester_ak, SUM(angka) * COUNT(angka)/4 as angka'))
            ->groupBy('tahun_ak','semester_ak',)
            ->get();

        $dataMhs = DB::table('nilai')
            ->join('kontrak', 'nilai.kontrak_id', 'kontrak.id')
            ->join('krs','kontrak.krs_id','krs.id')
            ->join('perwalian','krs.perwalian_id','perwalian.id')
            ->join('mhs','perwalian.mhs_id','mhs.id')
            ->select('mhs.id', 'nm_mhs')
            ->groupBy('id', 'nm_mhs',)
            ->get();



        return response([
            'dataGrafikMhs'=> $dataGrafikMhs,
            'dataMhs'=> $dataMhs,
        ]);
    }
}
