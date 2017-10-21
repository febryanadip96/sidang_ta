<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
	protected $table = 'mahasiswas';
    protected $primaryKey = 'id';
	protected $fillable=['nrp','nama','judul','no_telp','persyaratan_1','persyaratan_2','persyaratan_3','persyaratan_4','persyaratan_5','persyaratan_6'];
    public $timestamps=false;
	protected $guarded=['id'];

	public function jadwalSidang()
	{
		return $this->hasMany('App\JadwalSidang','mahasiswa_id');
	}

	public function periode()
	{
		return $this->belongsToMany('App\Periode', 'mahasiswa_periode', 'mahasiswa_id', 'periode_id');
	}
}
