<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class WorkforceCost extends Model
{
    protected $fillable = [
    	'workforceId',
		'cost'
    ];
}
