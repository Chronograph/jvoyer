<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
    protected $table = 'deployments';
	protected $guarded = ['id'];

}
