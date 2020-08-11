<?php

namespace App\Http\Controllers\Mhs;

use App\Models\Khs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Return_;

class PerwalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $khs=Khs::where('mhs_id',auth()->user()->id)->first();
        $IPK=$khs->IPK;
        if ($IPK <= 2.0 ) {
            $beban=14;
        }
        if ($IPK <= 3.5 ) {
            $beban=20;
        }
        if ($IPK <= 4.0 ) {
            $beban=24;
        }

        $jadwal= Jadwal::where('prodi_id',auth()->user()->mhs->prodi->id)
            ->where('semester_ak','GANJIL')
            ->where('tahun_ak',2020)
            ->orderByRaw('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu")')
            ->orderBy('jam_mulai')
            ->get();

        $semester= Jadwal::with('matkul')->where('prodi_id',auth()->user()->mhs->prodi->id)
            ->where('semester_ak','GANJIL')
            ->where('tahun_ak',2020)
            ->get()
            ->sortBy('matkul.semester')->keyBy('matkul.semester');

        return view('mhs.perwalian.index',compact('khs','beban','jadwal','semester'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semester= Jadwal::with('matkul')->where('prodi_id',auth()->user()->mhs->prodi->id)
            ->where('semester_ak','GANJIL')
            ->where('tahun_ak',2020)
            ->get()
            ->sortBy('matkul.semester')->keyBy('matkul.semester');
        return response()->json([
                'semester' => $semester,
            ]);
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
        //
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
