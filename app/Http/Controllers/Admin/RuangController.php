<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ruang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ruang=Ruang::all();
        // return $jadwal;

        if ($request->ajax()) {
            $view = view('admin.ruang.data', [
                'ruang'=>$ruang,
            ]);
            return $view;
        }
        return view('admin.ruang.index');
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
            'kd_ruang'=>'required|unique:ruang|max:10',
            'nm_ruang'=>'required',
        ]);
        $ruang = new Ruang;
        $ruang->kd_ruang=$request->kd_ruang;
        $ruang->nm_ruang=$request->nm_ruang;
        $ruang->save();
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
        $ruang=ruang::find($id);
        return $ruang;
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
            'kd_ruang'=>'required|max:10',
            'nm_ruang'=>'required',
        ],[
            'kd_ruang.required'=>'Tidak Boleh Kosong Woyy',
            'kd_ruang.max'=>'Karakternya Kelebihan Woyy',
            'nm_ruang.required'=>'Tidak Boleh Kosong Woyy',
        ]);

        Ruang::find($id)
            ->update([
                'kd_ruang'=>$request->kd_ruang,
                'nm_ruang'=>$request->nm_ruang,
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
        Ruang::destroy($id);
    }
}
