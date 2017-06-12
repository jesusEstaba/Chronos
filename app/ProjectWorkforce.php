<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class ProjectWorkforce extends Model
{
    protected $fillable = [
		'partitieId',
		'workforceId',
		'costId',
    ];

    public function workforce() {
    	return $this->belongsTo('Cronos\Workforce', 'workforceId')->first();
    }

    public function cost() {
    	return $this->belongsTo('Cronos\WorkforceCost', 'costId')->first();
    }
}
