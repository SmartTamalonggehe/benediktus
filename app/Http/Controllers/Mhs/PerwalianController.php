<?php

namespace App\Http\Controllers\Mhs;

use App\Models\Khs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kontrak;
use App\Models\Krs;
use App\Models\Perwalian;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Return_;

class PerwalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $khs=Khs::where('mhs_id',auth()->user()->id)->first();
        $IPK=$khs->IPK;
        if ($IPK <= 2.0 ) {
            $beban=10;
        }else if ($IPK <= 3.5 ) {
            $beban=15;
        }else if ($IPK <= 4.0 ) {
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

        $krs=Krs::where('semester_ak','GANJIL')->where('tahun_ak',2020)->
            with('perwalian')->get()
            ->where('perwalian.mhs_id',auth()->user()->id)->first();

        if ($krs) {
            $kontrak=Kontrak::where('krs_id',$krs->id)->get();
            if (!$krs->perwalian) {
                $data = '{
                    "ket": "Kosong"
                }';
                $krs = json_decode($data);
            }
        } else {
            $data = '{
                "ket": "Kosong"
            }';
            $krs = json_decode($data);
            $kontrak = json_decode($data);
        }


        if ($request->ajax()) {
            $view = view('mhs.perwalian.data',compact('khs','beban','jadwal','semester','krs','kontrak'));
            return $view;
        }

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
        $perwalian_id=Perwalian::where('mhs_id', auth()->user()->id)->first();
        $tgl_krs=Carbon::now()->format('Y-m-d');
        $data = $request->all();

        if ($request->krs_id) {
            Kontrak::where('krs_id', $request->krs_id)->delete();
            Krs::find($request->krs_id)
                ->update([
                    'ket'=>'Tunggu'
                ]);
            $krs_id=$request->krs_id;
        }else {
            $krs = Krs::create([
                'perwalian_id'=>$perwalian_id->id,
                'semester_ak'=>'GANJIL',
                'tahun_ak'=>2020,
                'tgl_krs'=>$tgl_krs,
                'ket'=>'Tunggu'
            ]);
            $krs_id=Krs::latest()->first();
            $krs_id=$krs_id->id;
        }

        // return $krs_id->id;

        foreach ($data['jadwal_id'] as $index => $val) {
            Kontrak::create([
                'krs_id' => $krs_id,
                'jadwal_id' => $val,
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
        //
    }
}
