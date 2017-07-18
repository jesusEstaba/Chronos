<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	'name',
		'start',
		'end',
		'finish',
		'companieId',
		'clientId',
		'stateId',
        'userId',
    ];

    public function client() {
        return $this->belongsTo('Repo\Client', 'clientId')->first();
    }


    public function modifiers() {
    	return $this->hasMany('Repo\Modifier', 'projectId')->get();
    }

    public function partities() {
        return $this->hasMany('Repo\ProjectPartitie', 'projectId')->get();
    }
}
