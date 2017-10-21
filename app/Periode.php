<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
	protected $table = 'periodes';
    protected $primaryKey = 'id';
	protected $fillable=['nama','tanggal_awal','tanggal_akhir','batas_pendaftaran'];
    public $timestamps=false;
	protected $guarded=['id'];

	public function daftarMahasiswa()
	{
		return $this->belongsToMany('App\Mahasiswa', 'mahasiswa_periode', 'periode_id', 'mahasiswa_id');
	}

	public function dosenUji()
	{
		return $this->belongsToMany('App\Dosen', 'dosen_kaliuji', 'periode_id', 'dosen_id')->withPivot('jumlah_menguji');
	}

	public function jadwalSidang()
	{
		return $this->hasMany('App\JadwalSidang', 'periode_id');
	}

	public function jadwal()
	{
		return $this->hasMany('App\Jadwal', 'periode_id');
	}
}
