<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
	protected $table = 'jadwals';
    protected $primaryKey = 'id';
	protected $fillable=['tanggal','waktu','disabled','periode_id'];
    public $timestamps=false;
	protected $guarded=['id'];

	public function periode()
	{
		return $this->belongsTo('App\Periode','periode_id');
	}

	public function tempatJadwal()
	{
		return $this->hasMany('App\TempatJadwal','jadwal_id');
	}

	public function dosenKosong()
	{
		return $this->belongsToMany('App\Dosen', 'jadwal_kosong', 'jadwal_id', 'dosen_id')->withPivot('diambil');
	}
}
