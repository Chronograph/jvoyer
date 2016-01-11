<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
	protected $table = 'servers';
	protected $guarded = ['id'];

	public function project(){
		return $this->belongsTo('App\Project');
	}



}
