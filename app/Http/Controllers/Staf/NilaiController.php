<?php

namespace App\Http\Controllers\Staf;

use App\Http\Controllers\Controller;
use App\Models\Kontrak;
use App\models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kontrak = Kontrak::with(['krs' => function ($krs) use ($request) {
            $krs->where('semester_ak', $request->semester_ak)->where('tahun_ak', $request->tahun_ak)
                ->with(['perwalian' => function ($perwalian) {
                    $perwalian->with('mhs');
                }]);
        }])->get()->whereNotNull('krs');

        $nilai = Nilai::with(['kontrak' => function ($kontrak) use ($request) {
            $kontrak->with(['krs' => function ($krs) use ($request) {
                $krs->where('semester_ak', $request->semester_ak)->where('tahun_ak', $request->tahun_ak)
                    ->with(['perwalian' => function ($perwalian) {
                        $perwalian->with('mhs');
                    }]);
            }]);
        }])->get()->whereNotNull('kontrak.krs');

        $tahun = Kontrak::with(['krs' => function ($krs) {
        }])->get();

        $nilai = $nilai->keyBy('kontrak.krs.perwalian.mhs_id');
        $kontrak = $kontrak->keyBy('krs.perwalian.mhs_id');

        if ($request->ajax()) {
            $view = view('staf.nilai.data', [
                'kontrak' => $kontrak,
                'nilai' => $nilai
            ]);
            return $view;
        }
        return view('staf.nilai.index', [
            'kontrak' => $kontrak,
            'tahun' => $tahun,
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
        $data = $request->all();


        foreach ($data['kontrak_id'] as $index => $kontrak_id) {

            if ($data['nilai'][$index] == 'A') {
                $angka = 4;
            } elseif ($data['nilai'][$index] == 'B') {
                $angka = 3;
            } elseif ($data['nilai'][$index] == 'C') {
                $angka = 2;
            } elseif ($data['nilai'][$index] == 'D') {
                $angka = 1;
            } else {
                $angka = 0;
            }

            Nilai::create([
                'kontrak_id' => $kontrak_id,
                'nilai' => $data['nilai'][$index],
                'angka' => $angka,
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
        $nilai = Nilai::with(['kontrak' => function ($kontrak) use ($id) {
            $kontrak->where('krs_id', $id);
            $kontrak->with(['jadwal' => function ($jadwal) {
                $jadwal->with('matkul');
            }]);
        }])->get()->whereNotNull('kontrak');


        $kontrak = Kontrak::where('krs_id', $id)
            ->with(['jadwal' => function ($jadwal) {
                $jadwal->with('matkul');
            }])->get()->sortBy('jadwal.matkul.nm_matkul');

        return [
            "nilai" => $nilai,
            "kontrak" => $kontrak
        ];
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
        $data = $request->all();
        foreach ($data['kontrak_id'] as $index => $kontrak_id) {
            if ($data['nilai'][$index] == 'A') {
                $angka = 4;
            } elseif ($data['nilai'][$index] == 'B') {
                $angka = 3;
            } elseif ($data['nilai'][$index] == 'C') {
                $angka = 2;
            } elseif ($data['nilai'][$index] == 'D') {
                $angka = 1;
            } else {
                $angka = 0;
            }

            Nilai::where('id', $kontrak_id)
                ->update([
                    'nilai' => $data['nilai'][$index],
                    'angka' => $angka,
                ]);
        }
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
