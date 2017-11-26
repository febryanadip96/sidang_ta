<?php

namespace App\Http\Controllers\Paj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use App\Jadwal;
use App\Tempat;
use App\TempatJadwal;
use DateInterval;
use DatePeriod;
use DateTime;

class MasterPeriodeController extends Controller
{
	public function __construct()
    {
        $this->middleware('paj');
    }
	
    public function index()
    {
    	$periodes = Periode::orderBy('id', 'DESC')->get();
    	return view('user.paj.masterperiode.index',['periodes' => $periodes]);
    }

    public function simpan(Request $request)
    {
    	$this->validate($request,[
    		'nama' => 'required',
    		'periode' => 'required',
    		'batas_pendaftaran' => 'required',
    	]);
    	Periode::where('status', 1)->update(['status' => 0]);
    	$tanggal_periode = explode(" - ", $request->periode);
    	$tanggal_awal = date("Y-m-d",strtotime(str_replace('/', '-', $tanggal_periode[0])));
    	$tanggal_akhir = date("Y-m-d",strtotime(str_replace('/', '-', $tanggal_periode[1])));
    	$periode = new Periode();
    	$periode->nama = $request->nama;
    	$periode->tanggal_awal = $tanggal_awal;
    	$periode->tanggal_akhir = $tanggal_akhir;
    	$periode->batas_pendaftaran = date("Y-m-d",strtotime(str_replace('/', '-', $request->batas_pendaftaran)));
    	$periode->status = 1;
    	$periode->save();

    	$oneday = new DateInterval("P1D");
    	$daterange = new DatePeriod(new DateTime($tanggal_awal), $oneday, new DateTime($tanggal_akhir));
   		foreach($daterange as $day) {
		    $day_num = $day->format("N"); /* 'N' number days 1 (mon) to 7 (sun) */
		    if($day_num < 6) { /* weekday */
		        $tanggal = $day->format("Y-m-d");
		        for ($i=1; $i < 7; $i++) {
		        	$jadwal = new Jadwal();
		        	$jadwal->tanggal = $tanggal;
		        	$jadwal->waktu = $i;
		        	$jadwal->periode_id = $periode->id;
		        	$jadwal->disabled = 0;
		        	$jadwal->save();
		        }
		    }
		}

		$jadwals = Jadwal::where('periode_id', $periode->id)->get();
		$tempats = Tempat::all();

		foreach ($tempats as $key => $tempat) {
			foreach ($jadwals as $key => $jadwal) {
	    		$tempatJadwal = new TempatJadwal();
	    		$tempatJadwal->tempat_id = $tempat->id;
	    		$tempatJadwal->jadwal_id = $jadwal->id;
	    		$tempatJadwal->save();
	    	}
		}

    	return back()->with('status', 'Data periode baru '.$request->nama.' telah disimpan.');
    }

    public function get($id)
    {
    	$periode = Periode::findOrFail($id);
    	$tanggals = Jadwal::where('periode_id', $periode->id)->distinct()->select('tanggal')->get();
        $jadwals = Jadwal::where('periode_id', $periode->id)->get();
        return view('user.paj.masterperiode.setting',['periode' => $periode, 'tanggals' => $tanggals, 'jadwals' => $jadwals]);
    }

    public function setting(Request $request, $id)
    {
        $jadwals = $request->jadwal;
        foreach ($jadwals as $id => $disabled) {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->disabled = $disabled;
            $jadwal->save();
        }
        return back()->with('status', 'Data jadwal telah diperbarui');
    }
}
