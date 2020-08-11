<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $matkul=Matkul::orderBy('nm_matkul')->get();
        // return $matkul;
        if ($request->ajax()) {
            $view = view('admin.matkul.data', [
                'matkul'=>$matkul,
            ]);
            return $view;
        }
        return view('admin.matkul.index');
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
        $this->validate($request,[
            'kd_matkul'=>'required|unique:matkul|max:10',
            'nm_matkul'=>'required',

        ],[
            'kd_matkul.max'=>'Karakternya Kelebihan Woyy',
            'kd_matkul.unique'=>'Kode matkul Sudah ada',
        ]);

        Matkul::create([
                'kd_matkul'=>$request->kd_matkul,
                'nm_matkul'=>$request->nm_matkul,
                'sks'=>$request->sks,
                'semester'=>$request->semester,
            ]);

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
        $matkul = Matkul::find($id);
        return $matkul;
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
        $this->validate($request,[
            'kd_matkul'=>'required|max:10',
            'nm_matkul'=>'required',
            'sks'=>'required',
            'semester'=>'required',
        ],[
            'kd_matkul.required'=>'Tidak Boleh Kosong Woyy',
            'kd_matkul.max'=>'Karakternya Kelebihan Woyy',
            'nm_matkul.required'=>'Tidak Boleh Kosong Woyy',
            'sks.required'=>'Tidak Boleh Kosong Woyy',
            'semester.required'=>'Tidak Boleh Kosong Woyy',
        ]);
        matkul::find($id)
            ->update([
                'kd_matkul'=>$request->kd_matkul,
                'nm_matkul'=>$request->nm_matkul,
                'sks'=>$request->sks,
                'semester'=>$request->semester,
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
        Matkul::destroy($id);
    }
}
