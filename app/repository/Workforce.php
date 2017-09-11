<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class Workforce extends Model
{
	protected $fillable = [
    	'name',
        'companieId',
        'disabled'
    ];

    public function lastCost() {
    	return $this->costs()->orderBy('id', 'desc')->first()->cost;
    }

    public function lastCostId() {
        return $this->costs()->orderBy('id', 'desc')->first()->id;
    }

    public function costs() {
        return $this->hasMany('Repo\WorkforceCost', 'workforceId');
    }
}
