<?php

namespace App\Http\Controllers\Mhs;

use App\Models\Perwalian;
use Illuminate\Http\Request;
use App\models\KomenPerwalian;
use App\Http\Controllers\Controller;

class KomenPerwalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perwalian_id=Perwalian::where('mhs_id', auth()->user()->id)->first();

        $komen=KomenPerwalian::where('perwalian_id',$perwalian_id->id)
            ->orderByDesc('created_at')
            ->paginate(10);
        // return $komen;

        if ($request->ajax()) {
            $view = view('mhs.perwalian.data_komen', [
                'komen'=>$komen->sortBy('created_at'),
            ]);
            return $view;
        }
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
        $perwalian_id=Perwalian::where('mhs_id', auth()->user()->id)->first();

        $data = KomenPerwalian::create([
            'id_pengkomen'=>auth()->user()->id,
            'perwalian_id'=>$perwalian_id->id,
            'pesan'=>$request->pesan,
            'status'=>'Belum',
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
