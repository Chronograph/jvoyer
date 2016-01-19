<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
	protected $guarded = ['id'];

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function servers(){
		return $this->hasMany('App\Server');
	}

	public function deployments(){
		return $this->hasMany('App\Deployment');
	}



}
