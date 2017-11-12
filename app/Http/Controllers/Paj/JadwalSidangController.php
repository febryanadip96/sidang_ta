<?php

namespace App\Http\Controllers\Paj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
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
        $mahasiswas =  collect();;
        foreach ($dosens as $key => $dosen) {
            foreach ($dosen->pembimbing1->whereIn('id', $mahasiswasId) as $key => $mahasiswa) {
                $mahasiswas->push($mahasiswa);
            }
            foreach ($dosen->pembimbing2->whereIn('id', $mahasiswasId) as $key => $mahasiswa) {
                $mahasiswas->push($mahasiswa);
            }
        }
        $mahasiswas = $mahasiswas->unique('id')->values()->all();
    	return view('user.paj.jadwalsidang', ['periodeAktif' => $periodeAktif, 'mahasiswas' => $mahasiswas]);
    }

    public function getWaktuUji(Request $request)
    {
        $periodeAktif = Periode::where('status', 1)->first();
        $pembimbing1 = Dosen::findOrFail($request->idPembimbing1);
        $pembimbing2 = Dosen::findOrFail($request->idPembimbing2);
        //return $pembimbing1;
        $jadwalKosongPembimbing1 = $pembimbing1->jadwalKosong->where('diambil', 0)->where('periode_id',$periodeAktif->id)->pluck('id');
        $jadwalKosongPembimbing2 = $pembimbing2->jadwalKosong->where('diambil', 0)->where('periode_id',$periodeAktif->id)->pluck('id');
        $tempatJadwalId = TempatJadwal::doesntHave('jadwalSidang')->whereIn('jadwal_id', $jadwalKosongPembimbing1)->whereIn('jadwal_id', $jadwalKosongPembimbing2)->get()->pluck('id')->push($request->pilih);
        $tempatJadwal = TempatJadwal::whereIn('id', $tempatJadwalId)->get();

        return $tempatJadwal->load('tempat','jadwal');
    }

    public function updateJadwal(Request $request, $id)
    {
        $pilihanSebelum = $request->pilihanSebelum;
        $pilihanSesudah = $request->pilihanSesudah;
        if($pilihanSebelum!=0){
            $jadwalSebelum = TempatJadwal::find($pilihanSebelum)->jadwal->id;
        }
        if($pilihanSesudah!=0){
            $jadwalSesudah = TempatJadwal::find($pilihanSesudah)->jadwal->id;
            $jadwalSidang = JadwalSidang::find($id);
            $jadwalSidang->tempat_jadwal_id = $pilihanSesudah;
            $jadwalSidang->save();
        }
        else{
            $jadwalSidang = JadwalSidang::find($id);
            $jadwalSidang->tempat_jadwal_id = null;
            $jadwalSidang->save();
        }
        
        if($pilihanSebelum!=0)
        {
            $jadwalSidang->mahasiswa->pembimbing1->jadwalKosong()->updateExistingPivot($jadwalSebelum, ['diambil' => false]);
            $jadwalSidang->mahasiswa->pembimbing2->jadwalKosong()->updateExistingPivot($jadwalSebelum, ['diambil' => false]);
        }
        if($pilihanSesudah!=0){
            $jadwalSidang->mahasiswa->pembimbing1->jadwalKosong()->updateExistingPivot($jadwalSesudah, ['diambil' => true]);
            $jadwalSidang->mahasiswa->pembimbing2->jadwalKosong()->updateExistingPivot($jadwalSesudah, ['diambil' => true]);
        }
        
        return response()->json([
            'hasil' => true,
        ]);
        
    }
}
