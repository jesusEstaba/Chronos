<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class Partitie extends Model
{
    protected $fillable = [
    	'name',
		'yield',
		'companieId',
		'unitId'
    ];
}
