<?php

namespace App\Http\Controllers\Paj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use App\Mahasiswa;

class MasterMahasiswaController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('paj');
    }

    public function index()
    {
    	$periodes = Periode::all();
    	$periodeAktif = Periode::where('status',1)->first();
    	return view('user.paj.mastermahasiswa.index',['periodes' => $periodes, 'periodeAktif'=>$periodeAktif]);
    }

    public function carimahasiswa(Request $request)
    {
    	$periodes = Periode::all();
    	$periodeAktif = Periode::findOrFail($request['periode_id']);
    	$mahasiswas = $periodeAktif->daftarMahasiswa;
    	return view('user.paj.mastermahasiswa.index',['periodes' => $periodes, 'periodeAktif'=>$periodeAktif,'mahasiswas'=>$mahasiswas]);
    }
}
