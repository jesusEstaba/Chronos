<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
    	'partitieId',
		'start',
		'stateId',
		'end',
		'finish',
		'progress',
		'note'
    ];
}
