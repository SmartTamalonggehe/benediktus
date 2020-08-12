<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')){
            return redirect()->route('admin');
        }
        if (Auth::user()->hasRole('Mahasiswa')){
            return redirect()->route('mhs');
        }
        if (Auth::user()->hasRole('Dosen')){
            return redirect()->route('dosen');
        }
        if (Auth::user()->hasRole('Staf')){
            return redirect()->route('staf');
        }

        return view('home');
    }
}
