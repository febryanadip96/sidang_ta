<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periode;
use App\Dosen;
use App\Mahasiswa;
use App\JadwalSidang;
use Carbon\Carbon;

class DaftarController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	public function index()
	{
		$periodeAktif = Periode::where('status', 1)->first();
		$dosens = Dosen::all();
		$carbon = new Carbon();
		if($carbon>$periodeAktif->batas_pendaftaran){
			$tutup = true;
		}
		else{
			$tutup=false;
		}
		return view('daftar',['periodeAktif'=>$periodeAktif, 'dosens' => $dosens, 'tutup' => $tutup]);
	}

    public function daftar(Request $request)
    {
		$this->validate($request,[
			'id' => 'required',
			'nama' => 'required',
			'nrp' => 'required',
			'no_telp' => 'required|min:12',
			'judul' => 'required',
			'pembimbing_1_id' => 'required|numeric',
			'pembimbing_2_id' => 'required|numeric',
		],[
			'nama.required' => 'Nama harus diisi',
			'nrp.required' => 'NRP harus diiisi',
			'no_telp.required' => 'Nomor Telpon harus diisi',
			'pembimbing_1_id.required' => 'Data Pembimbing 1 tidak valid',
			'pembimbing_2_id.required' => 'Data Pembimbing 2 tidak valid',
			'pembimbing_1_id.numeric' => 'Data Pembimbing 1 tidak valid',
			'pembimbing_2_id.numeric' => 'Data Pembimbing 2 tidak valid',
		]);

		$periodeAktif = Periode::where('status', 1)->first();

		if($request->id==0){
			$mahasiswa = new Mahasiswa();
		}
		else{
			$mahasiswa = Mahasiswa::findOrFail($request->id);
		}

		$mahasiswa->nama = $request->nama;
		$mahasiswa->nrp = $request->nrp;
		$mahasiswa->no_telp = $request->no_telp;
		$mahasiswa->judul = $request->judul;
		$mahasiswa->pembimbing_1_id = $request->pembimbing_1_id;
		$mahasiswa->pembimbing_2_id = $request->pembimbing_2_id;
		$mahasiswa->persyaratan_1 = false;
		$mahasiswa->persyaratan_2 = false;
		$mahasiswa->persyaratan_3 = false;
		$mahasiswa->persyaratan_4 = false;
		$mahasiswa->persyaratan_5 = false;
		$mahasiswa->persyaratan_6 = false;
		$mahasiswa->status_lulus = false;
		$mahasiswa->save();


		$mahasiswa->periode()->attach($periodeAktif->id);

		$jadwalSidang = new JadwalSidang();
		$jadwalSidang->memo = $request->memo;
		$jadwalSidang->periode_id = $periodeAktif->id;
		$jadwalSidang->mahasiswa_id = $mahasiswa->id;
		$jadwalSidang->save();

		return back()->with('status', 'Daftar sidang TA berhasil. Silahkan datang ke PAJ untuk konfirmasi data dan bawa berkas persyaratan maju sidang TA ke petugas.');
	}

	public function cekMahasiswa(Request $request)
	{
		$mahasiswa = Mahasiswa::where('nrp',$request['nrp'])->first();
		$periodeAktif = Periode::where('status', 1)->first();
		$terdaftar=false;
		if($mahasiswa)//ada data siswa atau tidak
		{
			if($mahasiswa->periode)//sudah pernah mendaftar di periode lain
			{
				if($mahasiswa->periode->where('id',$periodeAktif->id)->first())//siswa terdaftar di periode aktif ini
				{
					$terdaftar=true;
				}
			}
			return response()->json([
				"mahasiswa" => $mahasiswa->toArray(),
				"terdaftar" => $terdaftar,
			]);
		}
		else{//belum terdaftar
			return response()->json([
				"terdaftar" => $terdaftar,
			]);
		}
		
	}
}
