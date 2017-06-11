<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class Workforce extends Model
{
	protected $fillable = [
    	'name',
        'companieId',
    ];

    public function lastCost() {
    	return $this->costs()->orderBy('id', 'desc')->first()->cost;
    }

    public function lastCostId() {
        return $this->costs()->orderBy('id', 'desc')->first()->id;
    }

    public function costs() {
        return $this->hasMany('Cronos\WorkforceCost', 'workforceId');
    }
}
