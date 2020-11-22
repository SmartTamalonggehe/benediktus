<?php

namespace App\Http\Controllers\Staf;

use App\Models\Krs;
use App\Models\Mhs;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Kontrak;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $krs= Krs::where('semester_ak',$request->semester_ak)->where('tahun_ak',$request->tahun_ak)
            ->with(['perwalian'=>function($perwalian){
            $perwalian->with(['mhs'=>function($mhs){
                $mhs->where('prodi_id',auth()->user()->tools->id_prodi);
            }]);
        }])->get()->whereNotNull('perwalian.mhs');

        $tahun= Krs::with(['perwalian'=>function($perwalian){
            $perwalian->with(['mhs'=>function($mhs){
                $mhs->where('prodi_id',auth()->user()->tools->id_prodi);
            }]);
        }])->get()->whereNotNull('perwalian.mhs');

        // return $krs;

        $jadwal= Jadwal::where('prodi_id',auth()->user()->tools->id_prodi)->get();
        if ($request->ajax()) {
            $view = view('staf.krs.data', [
                'krs'=>$krs,
            ]);
            return $view;
        }

        return view('staf.krs.index', [
            'krs'=>$krs,
            'jadwal'=>$jadwal,
            'tahun'=>$tahun,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request->all();
        $mhs=Mhs::orderByDesc('NPM')
            ->where('prodi_id',auth()->user()->tools->id_prodi)
            ->with('perwalian')
            ->get()
            ->whereNotNull('perwalian')
            ->whereNotIn('perwalian.id',DB::table('krs')
                ->where('tahun_ak',$request->tahun_ak)
                ->where('semester_ak',$request->semester_ak)
                ->pluck('perwalian_id'));
        return $mhs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Krs::create([
            'perwalian_id'=>$request->perwalian_id,
            'semester_ak'=>$request->semester_ak,
            'tahun_ak'=>$request->tahun_ak,
            'tgl_krs'=>$request->tgl_krs,
            'ket'=>'Terima',
        ]);

        $krs_id=Krs::latest()->first();

        $data= $request->all();


        foreach ($data['jadwal_id'] as $index => $jadwal_id) {
            Kontrak::create([
                'krs_id' => $krs_id->id,
                'jadwal_id' => $jadwal_id,
            ]);
        }
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
        Krs::destroy($id);
    }
}
