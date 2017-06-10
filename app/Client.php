<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
    	'name',
		'rif',
		'address',
		'phone',
		'companieId'
    ];
}
