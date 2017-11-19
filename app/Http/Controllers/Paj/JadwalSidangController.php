<?php

namespace App\Http\Controllers\Paj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use App\Jadwal;
use App\Mahasiswa;
use App\Dosen;
use App\TempatJadwal;
use App\JadwalSidang;

class JadwalSidangController extends Controller
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
        $periodeAktif = Periode::where('status', 1)->first();
        $mahasiswasId = $periodeAktif->daftarMahasiswa->pluck('id');
        $jadwalPeriodeAktif = $periodeAktif->jadwal->pluck('id');
        $dosens = Dosen::withCount(['jadwalKosong' => function($query) use($jadwalPeriodeAktif){
            $query->whereIn('id', $jadwalPeriodeAktif);
        }])->orderBy('jadwal_kosong_count','asc')->get();
        $mahasiswas =  collect();
        foreach ($dosens as $key => $dosen) {
            foreach ($dosen->pembimbing1->whereIn('id', $mahasiswasId) as $key => $mahasiswa) {
                $mahasiswas->push($mahasiswa);
            }
            foreach ($dosen->pembimbing2->whereIn('id', $mahasiswasId) as $key => $mahasiswa) {
                $mahasiswas->push($mahasiswa);
            }
        }
        $mahasiswas = $mahasiswas->unique('id')->values()->all();
    	return view('user.paj.jadwalsidang.jadwalsidang', ['periodeAktif' => $periodeAktif, 'mahasiswas' => $mahasiswas]);
    }

    public function lihat($id)
    {
        $periode = Periode::where('status',1)->first();
        $tanggals = Jadwal::where('periode_id', $periode->id)->distinct()->select('tanggal')->get();
        $jadwals = Jadwal::where('periode_id', $periode->id)->get();
        $mahasiswa =  Mahasiswa::find($id);
        return view('user.paj.jadwalsidang.lihat', ['periode' => $periode, 'tanggals' => $tanggals, 'jadwals' => $jadwals, 'mahasiswa' => $mahasiswa]);
    }

    public function getWaktuUji(Request $request)
    {
        $periodeAktif = Periode::where('status', 1)->first();
        $mahasiswa = Mahasiswa::find($request->idMahasiswa);
        $pembimbing1 = $mahasiswa->pembimbing1;
        $pembimbing2 = $mahasiswa->pembimbing2;
        //return $pembimbing1;
        $jadwalKosongPembimbing1 = $pembimbing1->jadwalKosong()->wherePivot('diambil', 0)->where('periode_id',$periodeAktif->id)->where('disabled', 0)->pluck('id');
        $jadwalKosongPembimbing2 = $pembimbing2->jadwalKosong()->wherePivot('diambil', 0)->where('periode_id',$periodeAktif->id)->where('disabled', 0)->pluck('id');
        $tempatJadwalId = TempatJadwal::doesntHave('jadwalSidang')->whereIn('jadwal_id', $jadwalKosongPembimbing1)->whereIn('jadwal_id', $jadwalKosongPembimbing2)->get()->pluck('id')->push($request->pilih);
        if(isset($mahasiswa->sekretaris) && isset($mahasiswa->ketua)){
            $jadwalKosongSekretaris = $mahasiswa->sekretaris->jadwalKosong()->wherePivot('diambil', 0)->where('periode_id',$periodeAktif->id)->where('disabled', 0)->pluck('id');
            $jadwalKosongKetua = $mahasiswa->ketua->jadwalKosong()->wherePivot('diambil', 0)->where('periode_id',$periodeAktif->id)->where('disabled', 0)->pluck('id');
            $tempatJadwalId = TempatJadwal::doesntHave('jadwalSidang')->whereIn('jadwal_id', $jadwalKosongPembimbing1)->whereIn('jadwal_id', $jadwalKosongPembimbing2)->whereIn('jadwal_id', $jadwalKosongSekretaris)->whereIn('jadwal_id', $jadwalKosongKetua)->get()->pluck('id')->push($request->pilih);
        }
        $tempatJadwal = TempatJadwal::whereIn('id', $tempatJadwalId)->get();

        return $tempatJadwal->load('tempat','jadwal');
    }

    public function updateJadwal(Request $request, $id)
    {
        $pilihanSebelum = $request->pilihanSebelum;
        $pilihanSesudah = $request->pilihanSesudah;
        if($pilihanSebelum!=0){
            //jika sebelumnya ada jadwal yang sudah dipilih
            $jadwalSebelum = TempatJadwal::find($pilihanSebelum)->jadwal->id;
        }
        if($pilihanSesudah!=0){
            //jika ada jadwal yang dipilih
            $jadwalSesudah = TempatJadwal::find($pilihanSesudah)->jadwal->id;
            $jadwalSidang = JadwalSidang::find($id);
            $jadwalSidang->tempat_jadwal_id = $pilihanSesudah;
            $jadwalSidang->save();
        }
        else{
            //jika tidak ada jadwal yang dipilih
            $jadwalSidang = JadwalSidang::find($id);
            $jadwalSidang->tempat_jadwal_id = null;
            $jadwalSidang->save();
        }
        
        if($pilihanSebelum!=0)
        {
            //mengubah jadwal kosong dosen yang sebelumnya dipakai menjadi tidak diambil
            $jadwalSidang->mahasiswa->pembimbing1->jadwalKosong()->updateExistingPivot($jadwalSebelum, ['diambil' => false]);
            $jadwalSidang->mahasiswa->pembimbing2->jadwalKosong()->updateExistingPivot($jadwalSebelum, ['diambil' => false]);
            //jika memiliki sekretaris dan ketua
            if(isset($jadwalSidang->mahasiswa->sekretaris) && isset($jadwalSidang->mahasiswa->ketua)){
                $jadwalSidang->mahasiswa->sekretaris->jadwalKosong()->updateExistingPivot($jadwalSebelum, ['diambil' => false]);
                $jadwalSidang->mahasiswa->ketua->jadwalKosong()->updateExistingPivot($jadwalSebelum, ['diambil' => false]);
            }
        }
        if($pilihanSesudah!=0){
            //mengubah jadwal kosong dosen yang dipakai menjadi diambil
            $jadwalSidang->mahasiswa->pembimbing1->jadwalKosong()->updateExistingPivot($jadwalSesudah, ['diambil' => true]);
            $jadwalSidang->mahasiswa->pembimbing2->jadwalKosong()->updateExistingPivot($jadwalSesudah, ['diambil' => true]);
            //jika memiliki sekretaris dan ketua
            if(isset($jadwalSidang->mahasiswa->sekretaris) && isset($jadwalSidang->mahasiswa->ketua)){
                $jadwalSidang->mahasiswa->sekretaris->jadwalKosong()->updateExistingPivot($jadwalSesudah, ['diambil' => true]);
                $jadwalSidang->mahasiswa->ketua->jadwalKosong()->updateExistingPivot($jadwalSesudah, ['diambil' => true]);
            }
        }
        
        return response()->json([
            'hasil' => true,
        ]);
        
    }
}
