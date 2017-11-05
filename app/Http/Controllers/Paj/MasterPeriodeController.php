<?php

namespace App\Http\Controllers\Paj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;

class MasterPeriodeController extends Controller
{
    public function index()
    {
    	$periodes = Periode::orderBy('id', 'DESC')->get();
    	return view('user.paj.masterperiode.index',['periodes' => $periodes]);
    }

    public function simpan(Request $request)
    {
    	
    }
}
