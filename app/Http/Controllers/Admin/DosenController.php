<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public $permitted_chars = '12345678ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function generate_string($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dosen=Dosen::all();
        $prodi=Prodi::orderBy('nm_prodi')->get();
        // return $jadwal;

        if ($request->ajax()) {
            $view = view('admin.dosen.data', [
                'dosen'=>$dosen,
            ]);
            return $view;
        }
        return view('admin.dosen.index',compact('prodi'));
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
        $password=app('App\Http\Controllers\Staf\MhsController')->generate_string($this->permitted_chars, 8);
        $id_user= User::orderByDesc('id')->first()->id+1;

        $this->validate($request,[
            'NIDN'=>'required|unique:dosen|max:18',
        ],[
            'NIDN.required'=>'Tidak Boleh Kosong Woyy',
            'NIDN.max'=>'Karakternya Kelebihan Woyy',
            'NIDN.unique'=>'NIDN Sudah ada',
        ]);

        $data= Dosen::create([
            'id' => $id_user,
            'NIDN'=>$request->NIDN,
            'nm_dosen'=>$request->nm_dosen,
            'password'=>$password,
            'prodi_id'=>$request->prodi_id,
            'jenkel'=>$request->jenkel,
            'status'=>$request->status,
            'alamat'=>$request->alamat,
            'foto_dosen'=>'images/Tidak Ada.jpg',
        ]);
        $user= User::create([
            'id' => $id_user,
            'username' => $request['NIDN'],
            'email' => $request['NIDN'],
            'password' => Hash::make($password),
        ]);

        $user->assignRole('Dosen');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dosen = Dosen::find($id);
        return $dosen;
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
            'NIDN'=>'required|max:18',
            'nm_dosen'=>'required',
            'jenkel'=>'required',
            'alamat'=>'required',
        ],[
            'NIDN.required'=>'Tidak Boleh Kosong Woyy',
            'NIDN.max'=>'Karakternya Kelebihan Woyy',
            'nm_dosen.required'=>'Tidak Boleh Kosong Woyy',
            'jenkel.required'=>'Tidak Boleh Kosong Woyy',
            'alamat.required'=>'Tidak Boleh Kosong Woyy',
        ]);


        dosen::where('id',$id)
            ->update([
                'NIDN'=>$request->NIDN,
                'nm_dosen'=>$request->nm_dosen,
                'prodi_id'=>$request->prodi_id,
                'jenkel'=>$request->jenkel,
                'status'=>$request->status,
                'alamat'=>$request->alamat,
            ]);

        User::find($id)
            ->update([
                'username'=>$request->NIDN,
                'email'=>$request->NIDN,
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
        $user=User::find($id);
        $role= $user->removeRole('Dosen');
        Dosen::destroy($id);
        User::destroy($user->id);
    }
}
