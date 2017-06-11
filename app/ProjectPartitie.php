<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class ProjectPartitie extends Model
{
    protected $fillable = [
    	'yield',
		'quantity',
		'projectId',
		'partitieId',
    ];
}
