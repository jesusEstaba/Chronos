<?php

namespace Cronos;

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
    ];

    public function client() {
        return $this->belongsTo('Cronos\Client', 'clientId')->first();
    }


    public function modifiers() {
    	return $this->hasMany('Cronos\Modifier', 'projectId')->get();
    }

    public function partities() {
        return $this->hasMany('Cronos\ProjectPartitie', 'projectId')->get();
    }
}
