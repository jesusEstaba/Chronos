<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class MaterialCost extends Model
{
    protected $fillable = [
    	'materialId',
		'cost'
    ];
}
