<?php

namespace App\Http\Controllers\Mhs;

use Carbon\Carbon;
use App\Models\Khs;
use App\Models\Krs;
use App\models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Kontrak;
use App\Models\Perwalian;
use App\models\prasyarat;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Staf\KontrakController;

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
    private function cekSyarat($jadwal_id) {

        $mhs_id=auth()->user()->id;

        $prasyarat=prasyarat::whereIn('matkul_id',Jadwal::whereIn('id',($jadwal_id))->get('matkul_id'))->select('syarat_id','matkul_id')
            ->get();
        // blm ada data kontrak
        $kontrak= Kontrak::with(['krs'=>function($krs) use ($mhs_id){
            $krs->with(['perwalian'=>function($perwalian) use ($mhs_id){
                $perwalian->where('mhs_id',$mhs_id);
            }]);
        }])->get()->whereNotNull('krs.perwalian')->count();

        // Data Tidak Lulus
        $tidakLulus= Nilai::with(['kontrak'=>function($kontrak) use ($prasyarat,$mhs_id){
            $kontrak->with(['krs'=>function($krs) use ($mhs_id){
                $krs->with(['perwalian'=>function($perwalian) use ($mhs_id){
                    $perwalian->where('mhs_id',$mhs_id);
                }]);
            }]);
            $kontrak->with(['jadwal'=>function($jadwal) use ($prasyarat){
                $jadwal->whereIn('matkul_id',($prasyarat));
                $jadwal->with('matkul');
            }]);
        }])
        ->where('nilai','D')
        ->orWhere('nilai','E')
        ->get()->whereNotNull('kontrak.krs.perwalian')->whereNotNull('kontrak.jadwal');

        // Belum ambil matkul Terkait
        $belumAmbil= Jadwal::whereIn('matkul_id',$prasyarat)
            ->leftJoin('kontrak','jadwal.id','=','kontrak.jadwal_id')
            ->leftJoin('nilai','kontrak.id','=','nilai.kontrak_id')
            ->leftJoin('krs','kontrak.krs_id','=','krs.id')
            ->leftJoin('perwalian','krs.perwalian_id','=','perwalian.id')
            ->where('mhs_id',$mhs_id)
            ->whereNull('nilai')
            ->get();

        // Data Lulus
        $lulus= Nilai::with(['kontrak'=>function($kontrak) use ($prasyarat,$mhs_id){
            $kontrak->with(['krs'=>function($krs) use ($mhs_id){
                $krs->with(['perwalian'=>function($perwalian) use ($mhs_id){
                    $perwalian->where('mhs_id',$mhs_id);
                }]);
            }]);
            $kontrak->with(['jadwal'=>function($jadwal) use ($prasyarat){
                $jadwal->whereIn('matkul_id',($prasyarat));
                $jadwal->with('matkul');
            }]);
        }])
        ->where('nilai','A')
        ->orWhere('nilai','B')
        ->orWhere('nilai','C')
        ->get()->whereNotNull('kontrak.krs.perwalian')->whereNotNull('kontrak.jadwal');

        $syarat=prasyarat::all();

        if (!$kontrak) {
            if ($prasyarat->count()) {
                return view('mhs.perwalian.kotrak_kosong',[
                    'syarat'=>$prasyarat,
                ]);
            }
        }
        if ($prasyarat->count()) {
            if ($tidakLulus->count()) {
                return view('mhs.perwalian.alur_matkul',[
                    'nilai'=>$tidakLulus,
                    'syarat'=>$syarat,
                ]);
            }
            if ($belumAmbil->count()) {
                return 'hallo';
            }
            if ($lulus->count()) {
                return 'hallo1';
            }
        }


    }


    public function store(Request $request)
    {
        $data = $request->all();

        $mhs_id=auth()->user()->id;

        $syarat_id=prasyarat::whereIn('matkul_id',Jadwal::whereIn('id',($request->jadwal_id))->get('matkul_id'))
            ->get('syarat_id');
        // blm ada data kontrak
        $belumKontrak= Kontrak::with(['krs'=>function($krs) use ($mhs_id){
            $krs->with(['perwalian'=>function($perwalian) use ($mhs_id){
                $perwalian->where('mhs_id',$mhs_id);
            }]);
        }])->get()->whereNotNull('krs.perwalian')->count();

        $belumKontrakSyarat_id = prasyarat::whereIn('matkul_id', Jadwal::whereIn('id', ($request->jadwal_id))->get('matkul_id'))->select('syarat_id', 'matkul_id')
        ->get();

        if ($belumKontrak==0) {
            if ($syarat_id->count()) {
                return view('mhs.perwalian.alur_matkul',[
                    'syarat'=> $belumKontrakSyarat_id,
                ]);
            }

        }

        $perwalian_id= Perwalian::where('mhs_id',$mhs_id)->first()->id;
        $krs_id=Krs::where('perwalian_id',$perwalian_id)->get();

        $lulus=DB::table('kontrak')
            ->join('nilai','kontrak.id','=','nilai.kontrak_id')
            ->join('jadwal','jadwal.id','=','kontrak.jadwal_id')
            ->whereIn('jadwal.matkul_id',$syarat_id)
            ->where('nilai','A')
            ->orWhere('nilai','B')
            ->orWhere('nilai','C')
            ->whereIn('krs_id',$krs_id)
            ->get('matkul_id');

        // $lulus= Jadwal::all('matkul_id');
        $lulus= json_decode( json_encode($lulus), true);

        $prasyarat= prasyarat::whereIn('syarat_id',$syarat_id)
                ->whereNotIn('syarat_id',$lulus)
                ->get();

        if ($prasyarat->count() > 0) {
            return view('mhs.perwalian.alur_matkul',[
                'syarat'=>$prasyarat,
            ]);
        }

        $perwalian_id=Perwalian::where('mhs_id', auth()->user()->id)->first();
        $tgl_krs=Carbon::now()->format('Y-m-d');


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
        $jadwal_id=collect([
            // '20',
            '18',
            '19',
            '16',
        ]);

        $mhs_id=auth()->user()->id;
        $lulusAmbil=[];
        $tidakAmbil=[];

        $syarat_id=prasyarat::whereIn('matkul_id',Jadwal::whereIn('id',($jadwal_id))->get('matkul_id'))
            ->get('syarat_id');
        // blm ada data kontrak
        $belumKontrak= Kontrak::with(['krs'=>function($krs) use ($mhs_id){
            $krs->with(['perwalian'=>function($perwalian) use ($mhs_id){
                $perwalian->where('mhs_id',$mhs_id);
            }]);
        }])->get()->whereNotNull('krs.perwalian')->count();

        $perwalian_id= Perwalian::where('mhs_id',$mhs_id)->first()->id;
        $krs_id=Krs::where('perwalian_id',$perwalian_id)->get();

        $lulus=DB::table('kontrak')
            ->join('nilai','kontrak.id','=','nilai.kontrak_id')
            ->join('jadwal','jadwal.id','=','kontrak.jadwal_id')
            ->whereIn('jadwal.matkul_id',$syarat_id)
            ->where('nilai','A')
            ->orWhere('nilai','B')
            ->orWhere('nilai','C')
            ->whereIn('krs_id',$krs_id)
            ->get('matkul_id');

        // $lulus= Jadwal::all('matkul_id');
        $lulus= json_decode( json_encode($lulus), true);

        $prasyarat= prasyarat::whereIn('syarat_id',$syarat_id)
                ->whereNotIn('syarat_id',$lulus)
                ->get();

        return $prasyarat;

        if (!$belumKontrak) {
            if ($syarat_id->count()) {
                return view('mhs.perwalian.kotrak_kosong',[
                    'syarat'=>$syarat_id,
                ]);
            }
        }






        // return view('mhs.perwalian.alur_matkul',[
        //     'nilai'=>$tidakLulus,
        //     'syarat'=>$syarat,
        // ]);

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
