<?php

namespace App\Http\Controllers\Paj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use App\Mahasiswa;

class MasterMahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('paj');
    }

    public function index()
    {
    	$periodes = Periode::all();
    	$periodeAktif = Periode::where('status',1)->first();
    	$mahasiswas = $periodeAktif->daftarMahasiswa;
        return view('user.paj.mastermahasiswa.index',['periodes' => $periodes, 'periodeAktif'=>$periodeAktif,'mahasiswas'=>$mahasiswas]);
    }

    public function carimahasiswa(Request $request)
    {
    	$periodes = Periode::all();
    	$periodeAktif = Periode::findOrFail($request['periode_id']);
    	$mahasiswas = $periodeAktif->daftarMahasiswa;
    	return view('user.paj.mastermahasiswa.index',['periodes' => $periodes, 'periodeAktif'=>$periodeAktif,'mahasiswas'=>$mahasiswas]);
    }

    public function get($id)
    {
        return Mahasiswa::findOrFail($id);
    }

    public function editPersyaratan(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        if($request->persyaratan_1){
            $mahasiswa->persyaratan_1 = true;
        }
        else{
            $mahasiswa->persyaratan_1 = false;
        }
        if($request->persyaratan_2){
            $mahasiswa->persyaratan_2 = true;
        }
        else{
            $mahasiswa->persyaratan_2 = false;
        }
        if($request->persyaratan_3){
            $mahasiswa->persyaratan_3 = true;
        }
        else{
            $mahasiswa->persyaratan_3 = false;
        }
        if($request->persyaratan_4){
            $mahasiswa->persyaratan_4 = true;
        }
        else{
            $mahasiswa->persyaratan_4 = false;
        }
        if($request->persyaratan_5){
            $mahasiswa->persyaratan_5 = true;
        }
        else{
            $mahasiswa->persyaratan_5 = false;
        }
        if($request->persyaratan_6){
            $mahasiswa->persyaratan_6 = true;
        }
        else{
            $mahasiswa->persyaratan_6 = false;
        }
		if($request->status_lulus){
			$mahasiswa->status_lulus = true;
		}
		else{
			$mahasiswa->status_lulus = false;
		}
        $mahasiswa->save();
        return back()->with('status', 'Persyaratan mahasiswa '.$mahasiswa->nama.'('.$mahasiswa->nrp.') telah diperbarui.');
    }
}
