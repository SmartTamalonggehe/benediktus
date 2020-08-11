<?php

namespace App\Http\Controllers\Mhs;

use App\Models\Khs;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class KhsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $khs=Khs::where('mhs_id',auth()->user()->id)->first();
        // return $matkul;
        if ($request->ajax()) {
            $view = view('mhs.khs.data', [
                'khs'=>$khs,
            ]);
            return $view;
        }
        return view('mhs.khs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $khs= Khs::with('mhs')
            ->where('mhs_id',auth()->user()->id)
            ->first();
        return $khs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'gambar_khs' => 'required|file|max:10000',
            // 'file.*' => 'mimes:doc,pdf,docx,zip'
         ];
         $customMessages = [
            'required' => 'Gambar KHS Tidak Bbleh Kosong.'
        ];

        $error = Validator::make($request->all(), $rules, $customMessages);

        if($error->fails())
        {
            return response()->json([
                'errors' => $error->errors()->all()
            ]);
        }

        if ($request->hasFile('gambar_khs')) {
            $name = time().'.'. $request->gambar_khs->getClientOriginalExtension();
            $foto=$request->gambar_khs->move( public_path() . '/gambar_khs/', $name);
            $simpanFoto='gambar_khs/'.$name;
        }

        $data = Khs::create([
            'mhs_id'=>auth()->user()->id,
            'semester_ak'=>'GENAP',
            'tahun_ak'=>2020,
            'IPK'=>0,
            'status'=>'Belum',
            'gambar_khs'=>$simpanFoto,
        ]);

        $output = array(
            'success' => 'Berhasil',
            );

        return response()->json($output);
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
        return Khs::find($id);
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
        $cari = Khs::find($request->id);
        $fotoLama=$cari->gambar_khs;

        $rules = [
            'gambar_khs' => 'required|file|max:10000',
         ];
        $customMessages = [
            'required' => 'Gambar KHS Tidak Bbleh Kosong.'
        ];

        $error = Validator::make($request->all(), $rules, $customMessages);

        if($error->fails())
        {
            return response()->json([
                'errors' => $error->errors()->all()
            ]);
        }

        if ($request->hasFile('gambar_khs')) {
            File::delete($fotoLama);
            $name = time().'.'. $request->gambar_khs->getClientOriginalExtension();
            $foto=$request->gambar_khs->move( public_path() . '/gambar_khs/', $name);
            $simpanFoto='gambar_khs/'.$name;
        }

        $data = Khs::find($id)
            ->update([
            'gambar_khs'=>$simpanFoto,
        ]);

        $output = array(
            'success' => 'Berhasil',
            );

        return response()->json($output);
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
