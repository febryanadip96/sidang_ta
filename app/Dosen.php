<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
	protected $table = 'dosens';
    protected $primaryKey = 'id';
	protected $fillable=['kelayakan','user_id'];
    public $timestamps=false;
	protected $guarded=['id'];

	public function user()
	{
		return $this->belongsTo('App\User','user_id');
	}

	public function menguji()
	{
		return $this->belongsToMany('App\Periode', 'dosen_kaliuji', 'dosen_id', 'periode_id')->withPivot('jumlah_menguji');
	}

	public function jadwalKosong()
	{
		return $this->belongsToMany('App\Jadwal', 'jadwal_kosong', 'dosen_id', 'jadwal_id')->withPivot('diambil');
	}

	public function pembimbing1()
	{
		return $this->hasMany('App\JadwalSidang','pembimbing_1_id');
	}

	public function pembimbing2()
	{
		return $this->hasMany('App\JadwalSidang','pembimbing_2_id');
	}

	public function sekretaris()
	{
		return $this->hasMany('App\JadwalSidang','sekretaris_id');
	}

	public function ketua()
	{
		return $this->hasMany('App\JadwalSidang','ketua_id');
	}
}
