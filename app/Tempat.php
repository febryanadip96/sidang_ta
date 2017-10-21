<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
	protected $table = 'tempats';
    protected $primaryKey = 'id';
	protected $fillable=['nama'];
    public $timestamps=false;
	protected $guarded=['id'];

	public function tempat()
	{
		return $this->hasMany('App\TempatJadwal','tempat_id');
	}
}
