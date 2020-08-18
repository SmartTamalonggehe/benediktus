<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\Ruang;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Jadwal::create([
                'prodi_id'=>$request->prodi_id,
                'matkul_id'=>$request->matkul_id,
                'ruang_id'=>$request->ruang_id,
                'dosen_id'=>$request->dosen_id,
                'hari'=>$request->hari,
                'jam_mulai'=>$request->jam_mulai,
                'jam_seles'=>$request->jam_seles,
                'semester_ak'=>$request->semester_ak,
                'tahun_ak'=>$request->tahun_ak,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $prodi=Prodi::find($id);
        $matkul=Matkul::orderBy('nm_matkul')->get();
        $dosen=Dosen::orderBy('nm_dosen')->get();
        $ruang=Ruang::orderBy('nm_ruang')->get();
        $param=Jadwal::where('prodi_id',$id)->orderByDesc('tahun_ak')->get();
        $jadwal= Jadwal::where('prodi_id',$id)
            ->where('semester_ak',$request->semester_ak)
            ->where('tahun_ak',$request->tahun_ak)
            ->orderByRaw('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu")')
            ->orderBy('jam_mulai')
            ->get();

        if ($request->ajax()) {
            $view = view('admin.jadwal.data', [
                'jadwal'=>$jadwal,
            ]);
            return $view;
        }
        return view('admin.jadwal.index', [
            'jadwal'=>$jadwal,
            'prodi'=>$prodi,
            'param'=>$param,
            'matkul'=>$matkul,
            'dosen'=>$dosen,
            'ruang'=>$ruang,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwal = Jadwal::find($id);
        return $jadwal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        jadwal::find($id)
            ->update([
                'prodi_id'=>$request->prodi_id,
                'matkul_id'=>$request->matkul_id,
                'ruang_id'=>$request->ruang_id,
                'dosen_id'=>$request->dosen_id,
                'hari'=>$request->hari,
                'jam_mulai'=>$request->jam_mulai,
                'jam_seles'=>$request->jam_seles,
                'semester_ak'=>$request->semester_ak,
                'tahun_ak'=>$request->tahun_ak,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jadwal::destroy($id);
    }
}
