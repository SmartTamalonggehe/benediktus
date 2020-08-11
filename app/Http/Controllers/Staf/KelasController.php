<?php

namespace App\Http\Controllers\Staf;

use App\Models\Kelas;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $param=Jadwal::where('prodi_id',auth()->user()->tools->id_prodi)->orderByDesc('tahun_ak')->get();

        $kelas = Jadwal::leftJoin('kelas', function($join) {
            $join->on('jadwal.id', '=', 'kelas.jadwal_id');
            })
            ->select('jadwal.id as jadwal_ku','hari','matkul_id','ruang_id','prodi_id','semester_ak','tahun_ak','kelas.*')
            ->where('prodi_id',auth()->user()->tools->id_prodi)
            ->where('semester_ak',$request->semester_ak)
            ->where('tahun_ak',$request->tahun_ak)
            ->orderByRaw('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu")')
            ->orderBy('jam_mulai')
            ->get();

        // return $kelas;

        if ($request->ajax()) {
            $view = view('staf.kelas.data', [
                'kelas'=>$kelas,
            ]);
            return $view;
        }
        return view('staf.kelas.index', [
            'kelas'=>$kelas,
            'param'=>$param,
        ]);
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
        $kelas = new Kelas();
        $kelas->jadwal_id=$request->jadwal_id;
        $kelas->nm_kelas=$request->nm_kelas;
        $kelas->kuota=$request->kuota;
        $kelas->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas=Kelas::find($id);
        return $kelas;
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
        Kelas::where('id',$id)
            ->update([
                'jadwal_id'=>$request->jadwal_id,
                'nm_kelas'=>$request->nm_kelas,
                'kuota'=>$request->kuota,
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
        kelas::destroy($id);
    }
}
