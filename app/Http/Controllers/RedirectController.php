<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::check()){
            if(\Auth::user()->role==1 || \Auth::user()->role==2 ){
                return redirect('paj/jadwalsidang');
            }
            else if(\Auth::user()->role==3 || \Auth::user()->role==4){
                return redirect('dosen/jadwalkosong');
            }
        }
        return redirect('login');
    }
}
