<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;

class JadwalSidangController extends Controller
{
    public function __construct()
    {
    	$this->middleware('dosen');
    }

    public function index()
    {
    	$periodeAktif = Periode::where('status', 1)->first();
    	$mahasiswas = $periodeAktif->daftarMahasiswa;
    	return view('user.dosen.jadwalsidang', ['periodeAktif' => $periodeAktif ,'mahasiswas' => $mahasiswas]);
    }
}
