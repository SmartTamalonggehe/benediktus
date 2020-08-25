<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Jadwal;
use App\Models\Kontrak;
use App\Models\Perwalian;
use Illuminate\Http\Request;
use App\models\KomenPerwalian;
use App\Http\Controllers\Controller;
use App\Models\Krs;

class PerwalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perwalian=Perwalian::with('krs')
            ->where('dosen_id',auth()->user()->dosen->id)
            ->get();

        // return $perwalian;

        if ($request->ajax()) {
            $view = view('dosen.perwalian.data', [
                'perwalian'=>$perwalian,
            ]);
            return $view;
        }
        return view('dosen.perwalian.index', [
            'perwalian'=>$perwalian,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $krs=Krs::find($id);


        // Ganti Komen Menjadi Dibaca
        KomenPerwalian::where('perwalian_id',$krs->perwalian_id)
            ->where('id_pengkomen','!=',auth()->user()->id)
            ->update([
                'status'=>'Dibaca',
            ]);

        $kontrak=Kontrak::where('krs_id',$id)->get();

        $jadwal= Jadwal::where('semester_ak','GANJIL')
            ->where('tahun_ak',2020)
            ->orderByRaw('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu")')
            ->orderBy('jam_mulai')
            ->get();

        return view('dosen.kontrak.index', compact('kontrak','jadwal','krs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        Krs::find($id)
            ->update([
                'ket'=>$request->ket,
            ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
