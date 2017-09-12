<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class ProjectWorkforce extends Model
{
    protected $fillable = [
		'partitieId',
		'workforceId',
		'costId',
        'quantity'
    ];

    public function workforce() {
    	return $this->belongsTo('Repo\Workforce', 'workforceId')->first();
    }

    public function qty() {
        return $this->quantity;
    }

    public function cost() {
    	return $this->belongsTo('Repo\WorkforceCost', 'costId')
            ->first()
            ->cost;
    }
}
