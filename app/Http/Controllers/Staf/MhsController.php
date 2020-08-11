<?php

namespace App\Http\Controllers\Staf;

use App\User;
use App\Models\Mhs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MhsController extends Controller
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
        $mhs=Mhs::where('prodi_id',auth()->user()->tools->id_prodi)->get();

        // return $mhs;

        if ($request->ajax()) {
            $view = view('staf.mhs.data', [
                'mhs'=>$mhs,
            ]);
            return $view;
        }
        return view('staf.mhs.index', [
            'mhs'=>$mhs,
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
        $this->validate($request,[
            'NPM'=>'required|unique:mhs|min:10|max:10',
        ],[
            'NPM.unique'=>'NPM Sudah ada',
        ]);

        $nm_mhs=strtolower($request->nm_mhs);
        $nm_mhs= ucwords($nm_mhs);

        $password=$this->generate_string($this->permitted_chars, 8);
        $id_user= User::orderByDesc('id')->first()->id+1;

        $mhs = new Mhs;
        $mhs->id=$id_user;
        $mhs->NPM=$request->NPM;
        $mhs->prodi_id=auth()->user()->tools->id_prodi;
        $mhs->nm_mhs=$nm_mhs;
        $mhs->password=$password;
        $mhs->jenkel=$request->jenkel;
        $mhs->angkatan=$request->angkatan;
        $mhs->alamat=$request->alamat;
        $mhs->save();

        $user= User::create([
            'id' => $id_user,
            'username' => $request['NPM'],
            'email' => $request['NPM'],
            'password' => Hash::make($password),
        ]);

        $user->assignRole('Mahasiswa');
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
        $mhs=Mhs::find($id);
        return $mhs;
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
        $nm_mhs=strtolower($request->nm_mhs);
        $nm_mhs= ucwords($nm_mhs);

        mhs::where('id',$id)
            ->update([
                'NPM'=>$request->NPM,
                'nm_mhs'=>$nm_mhs,
                'jenkel'=>$request->jenkel,
                'angkatan'=>$request->angkatan,
                'alamat'=>$request->alamat,
            ]);
        User::where('id',$id)
        ->update([
            'username' => $request['NPM'],
            'email' => $request['NPM'],
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
        $role= $user->removeRole('Mahasiswa');
        mhs::destroy($id);
        User::destroy($user->id);
    }
}
