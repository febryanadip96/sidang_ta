<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $dosen = Auth::user()->dosen;
        $idMahasiswas = $dosen->pembimbing1->pluck('id');
        $idMahasiswas = $idMahasiswas->concat($dosen->pembimbing2->pluck('id'));
        $idMahasiswas = $idMahasiswas->concat($dosen->sekretaris->pluck('id'));
        $idMahasiswas = $idMahasiswas->concat($dosen->ketua->pluck('id'));
    	$mahasiswas = $periodeAktif->daftarMahasiswa->whereIn('id', $idMahasiswas);
    	return view('user.dosen.jadwalsidang', ['periodeAktif' => $periodeAktif ,'mahasiswas' => $mahasiswas]);
    }
}
