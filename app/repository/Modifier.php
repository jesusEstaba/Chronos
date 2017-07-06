<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class Modifier extends Model
{
    protected $fillable = [
		'name',
		'amount',
		'type',
		'projectId',
	];
}
