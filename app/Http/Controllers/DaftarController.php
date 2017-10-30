<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periode;
use App\Dosen;
use App\Mahasiswa;
use App\JadwalSidang;

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
		return view('daftar',['periodeAktif'=>$periodeAktif, 'dosens' => $dosens]);
	}

    public function daftar(Request $request)
    {
		$this->validate($request,[
			'nama' => 'required',
			'nrp' => 'required',
			'no_telp' => 'required|min:12',
			'judul' => 'required',
			'pembimbing_1_id' => 'required|numeric',
			'pembimbing_2_id' => 'required|numeric',
		],[
			'nama.requied' => 'Nama harus diisi',
			'nrp.required' => 'NRP harus diiisi',
			'no_telp.required' => 'Nomor Telpon harus diisi',
			'pembimbing_1_id.required' => 'Data Pembimbing 1 tidak valid',
			'pembimbing_2_id.required' => 'Data Pembimbing 2 tidak valid',
			'pembimbing_1_id.numeric' => 'Data Pembimbing 1 tidak valid',
			'pembimbing_2_id.numeric' => 'Data Pembimbing 2 tidak valid',
		]);

		$periodeAktif = Periode::where('status', 1)->first();

		$mahasiswa=Mahasiswa::create([
			'nama' => $request['nama'],
			'nrp' => $request['nrp'],
			'no_telp' => $request['no_telp'],
			'judul' => $request['judul'],
			'pembimbing_1_id' => $request['pembimbing_1_id'],
			'pembimbing_2_id' => $request['pembimbing_2_id'],
			'status_lulus'=>false,
		]);

		$mahasiswa->periode()->attach($periodeAktif->id);

		JadwalSidang::create([
			'memo' => $request['memo'],
			'periode_id' => $periodeAktif->id,
			'mahasiswa_id' => $mahasiswa->id,
		]);

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
