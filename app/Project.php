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
}
