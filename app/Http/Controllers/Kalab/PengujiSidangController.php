<?php

namespace App\Http\Controllers\Kalab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;

class PengujiSidangController extends Controller
{
    public function __construct()
    {
    	$this->middleware('kalab');
    }

    public function index()
    {
    	$periodeAktif = Periode::where('status', 1)->first();
    	$mahasiswas = $periodeAktif->daftarMahasiswa;
    	return view('user.kalab.pengujisidang', ['periodeAktif' => $periodeAktif ,'mahasiswas' => $mahasiswas]);
    }
}
