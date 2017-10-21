<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalSidang extends Model
{
	protected $table = 'jadwal_sidangs';
    protected $primaryKey = 'id';
	protected $fillable=['memo','status_lulus','periode_id','mahasiswa_id','pembimbing_1_id','pembimbing_2_id','sekretaris_id','ketua_id','tempat_jadwal_id'];
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

	public function pembimbing1()
	{
		return $this->belongsTo('App\Dosen', 'pembimbing_1_id');
	}

	public function pembimbing2()
	{
		return $this->belongsTo('App\Dosen', 'pembimbing_2_id');
	}

	public function sekretatis()
	{
		return $this->belongsTo('App\Dosen', 'sekretaris_id');
	}

	public function ketua()
	{
		return $this->belongsTo('App\Dosen', 'ketua_id');
	}
}
