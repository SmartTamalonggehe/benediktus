<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Tools;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Support\Facades\Hash;

class ToolsController extends Controller
{
    private $permitted_chars = '12345678ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tool=Tools::all();
        $prodi=Prodi::orderBy('nm_prodi')->get();
        // return $tool;

        if ($request->ajax()) {
            $view = view('admin.tools.data', [
                'tool'=>$tool,
            ]);
            return $view;
        }
        return view('admin.tools.index', compact('prodi'));
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
        $password=app('App\Http\Controllers\Staf\MhsController')->generate_string($this->permitted_chars, 8);
        $id_user= User::orderByDesc('id')->first()->id+1;

        if ($request->hasFile('foto_tool')) {
            $name = time().'.'. $request->foto_tool->getClientOriginalExtension();
            $foto_tool=$request->foto_tool->move( public_path() . '/images/tool/', $name);
            $simpanFoto='images/tool/'.$name;
        }else {
            $simpanFoto='images/Tidak Ada.jpg';
        }

        $data = Tools::create([
            'id'=>$id_user,
            'nm_tool'=>$request->nm_tool,
            'id_prodi'=>$request->id_prodi,
            'username'=>$request->username,
            'password'=>$password,
            'jenkel'=>$request->jenkel,
            'jabatan'=>$request->jabatan,
            'alamat'=>$request->alamat,
            'foto_tool'=>$simpanFoto,
        ]);

        $user = User::create([
            'id'=>$id_user,
            'username'=>$request->username,
            'email' => $request->username,
            'password' => Hash::make($password),
        ]);

        $user->assignRole($request->jabatan);
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
        $tool = Tools::find($id);
        return $tool;
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
        Tools::where('id',$id)
            ->update([
                'nm_tool'=>$request->nm_tool,
                'id_prodi'=>$request->id_prodi,
                'username'=>$request->username,
                'jenkel'=>$request->jenkel,
                'alamat'=>$request->alamat,
            ]);
        User::where('id',$id)
            ->update([
                'username'=>$request->username,
                'email'=>$request->username,
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
        $role= $user->removeRole($user->tools->jabatan);
        Tools::destroy($id);
        User::destroy($user->id);
    }
}
