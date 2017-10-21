<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempatJadwal extends Model
{
	protected $table = 'tempat_jadwals';
    protected $primaryKey = 'id';
	protected $fillable=['jadwal_id','tempat_id'];
    public $timestamps=false;
	protected $guarded=['id'];

	public function jadwalSidang()
	{
		return $this->hasOne('App\JadwalSidang', 'tempat_jadwal_id');
	}

	public function tempat()
	{
		return $this->belongsTo('App\Tempat', 'tempat_id');
	}

	public function jadwal()
	{
		return $this->belongsTo('App\Jadwal', 'jadwal_id');
	}
}
