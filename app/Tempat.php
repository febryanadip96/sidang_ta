<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tempat extends Model
{
    use SoftDeletes;
	protected $table = 'tempats';
    protected $primaryKey = 'id';
	protected $fillable=['nama'];
    public $timestamps=false;
	protected $guarded=['id'];
	protected $dates = ['deleted_at'];

	public function tempat()
	{
		return $this->hasMany('App\TempatJadwal','tempat_id');
	}
}
