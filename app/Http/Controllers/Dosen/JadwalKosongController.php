<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use App\Jadwal;
use App\Dosen;

class JadwalKosongController extends Controller
{
    public function __construct()
    {
    	$this->middleware('dosen');
    }

    public function index()
    {
    	$periode = Periode::where('status',1)->first();
    	$tanggals = Jadwal::where('periode_id', $periode->id)->distinct()->select('tanggal')->get();
        $jadwals = Jadwal::where('periode_id', $periode->id)->get();
    	return view('user.dosen.jadwalkosong',['periode' => $periode, 'tanggals' => $tanggals, 'jadwals' => $jadwals]);
    }

    public function simpan(Request $request, $id)
    {
    	$dosen = Dosen::findOrfail($id);
    	$dosen->jadwalKosong()->detach();
    	$jadwals = $request->jadwal;
        foreach ($jadwals as $id => $kosong) {
        	if($kosong){
        		$dosen->jadwalKosong()->attach($id);
        	}
        }
        return back()->with('status', 'Jadwal kosong telah diperbarui.');
    }
}
