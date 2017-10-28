<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalSidang extends Model
{
	protected $table = 'jadwal_sidangs';
    protected $primaryKey = 'id';
	protected $fillable=['memo','periode_id','mahasiswa_id','tempat_jadwal_id'];
    public $timestamps=false;
	protected $guarded=['id'];

	public function mahasiswa()
	{
		return $this->belongsTo('App\Mahasiswa','mahasiswa_id');
	}

	public function periode()
	{
		return $this->belongsTo('App\Periode', 'periode_id');
	}

	public function tempatJadwal()
	{
		return $this->belongsTo('App\TempatJadwal', 'tempat_jadwal_id');
	}
}
