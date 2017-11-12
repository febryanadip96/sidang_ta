<?php

namespace App\Http\Controllers\Kalab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use App\JadwalSidang;
use App\Dosen;

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

    public function getSekretaris(Request $request, $id)
    {
        //layak tidak layak
        //tidak boleh pembimbing, ketua
        //dijadwal yang bisa dan tidak diambil
        $jadwalSidang = JadwalSidang::find($id);
        $idExcpetion = collect();
        $idExcpetion->push($jadwalSidang->mahasiswa->pembimbing1->id);
        $idExcpetion->push($jadwalSidang->mahasiswa->pembimbing2->id);
        if($jadwalSidang->mahasiswa->ketua!=null){
            $idExcpetion->push($jadwalSidang->mahasiswa->ketua->id);
        }

        $layak = true;
        //pembimbing 1 dan 2 layak
        if($jadwalSidang->mahasiswa->pembimbing1->kelayakan && $jadwalSidang->mahasiswa->pembimbing2->kelayakan){
            $layak=false;//sekretaris boleh tidak layak
        }

        if($layak){
            $sekretarisId = $jadwalSidang->tempatJadwal->jadwal->dosenKosong()->wherePivot('diambil', false)->where('kelayakan', true)->whereNotIn('id', $idExcpetion)->get()->pluck('id')->push($request->pilih);
        }
        else{
            $sekretarisId = $jadwalSidang->tempatJadwal->jadwal->dosenKosong()->wherePivot('diambil', false)->whereNotIn('id', $idExcpetion)->get()->pluck('id')->push($request->pilih);
        }
        $sekretaris = Dosen::whereIn('id', $sekretarisId)->get();
        return $sekretaris->load('user');
    }

    public function getKetua(Request $request,$id)
    {
        //harus layak
        //tidak boleh pembimbing, sekretaris
        //dijadwal yang bisa dan tidak diambil

        $jadwalSidang = JadwalSidang::find($id);
        $idExcpetion = collect();
        $idExcpetion->push($jadwalSidang->mahasiswa->pembimbing1->id);
        $idExcpetion->push($jadwalSidang->mahasiswa->pembimbing2->id);
        if($jadwalSidang->mahasiswa->sekretaris!=null){
            $idExcpetion->push($jadwalSidang->mahasiswa->sekretaris->id);
        }

        $ketuaId = $jadwalSidang->tempatJadwal->jadwal->dosenKosong()->wherePivot('diambil', false)->where('kelayakan', true)->whereNotIn('id', $idExcpetion)->get()->pluck('id')->push($request->pilih);
        $ketua = Dosen::whereIn('id', $ketuaId)->get();
        
        return $ketua->load('user');
    }

    public function updateSekretaris(Request $request, $id){
        $jadwalSidang = JadwalSidang::find($id);
        $sekretarisSebelumId = $request->sekretarisSebelum;
        $sekretarisSesudahId = $request->sekretarisSesudah;
        if($sekretarisSebelumId!=0){
            Dosen::find($sekretarisSebelumId)->jadwalKosong()->updateExistingPivot($jadwalSidang->tempatJadwal->jadwal->id, ['diambil' => false]);
        }
        if($sekretarisSesudahId!=0){
            $jadwalSidang->mahasiswa->sekretaris_id = $sekretarisSesudahId;
            $jadwalSidang->mahasiswa->save();
            Dosen::find($sekretarisSesudahId)->jadwalKosong()->updateExistingPivot($jadwalSidang->tempatJadwal->jadwal->id, ['diambil' => true]);
        }
        else{
            $jadwalSidang->mahasiswa->sekretaris_id = null;
            $jadwalSidang->mahasiswa->save();
        }
        
        return response()->json([
            'hasil' => true,
        ]);
    }

    public function updateKetua(Request $request, $id){
        $jadwalSidang = JadwalSidang::find($id);
        $ketuaSebelumId = $request->ketuaSebelum;
        $ketuaSesudahId = $request->ketuaSesudah;
        if($ketuaSebelumId!=0){
            Dosen::find($ketuaSebelumId)->jadwalKosong()->updateExistingPivot($jadwalSidang->tempatJadwal->jadwal->id, ['diambil' => false]);
        }
        if($ketuaSesudahId!=0){
            $jadwalSidang->mahasiswa->ketua_id = $ketuaSesudahId;
            $jadwalSidang->mahasiswa->save();
            Dosen::find($ketuaSesudahId)->jadwalKosong()->updateExistingPivot($jadwalSidang->tempatJadwal->jadwal->id, ['diambil' => true]);
        }
        else{
            $jadwalSidang->mahasiswa->ketua_id = null;
            $jadwalSidang->mahasiswa->save();
        }
        
        return response()->json([
            'hasil' => true,
        ]);
    }
}
