<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matkul;
use App\models\prasyarat;
use Illuminate\Http\Request;

class PrasyaratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prasyarat=prasyarat::with('syarat','matkul')->get();

        $matkul = Matkul::orderBy('nm_matkul')->get();
        // return $prasyarat;

        if ($request->ajax()) {
            $view = view('admin.prasyarat.data', [
                'prasyarat'=>$prasyarat,
            ]);
            return $view;
        }
        return view('admin.prasyarat.index',[
            'matkul'=>$matkul
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
        $data = prasyarat::create([
            'syarat_id'=>$request->syarat_id,
            'matkul_id'=>$request->matkul_id,
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
        return $prasyarat = prasyarat::find($id);
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
        prasyarat::find($id)
            ->update([
                'syarat_id'=>$request->syarat_id,
                'matkul_id'=>$request->matkul_id,
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
        prasyarat::destroy($id);
    }
}
