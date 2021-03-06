<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
    	'name',
		'rif',
		'address',
		'phone',
		'companieId',
		'disabled'
    ];

    public function projects() {
    	return $this->hasMany('Repo\Project', 'clientId');
    }
}
