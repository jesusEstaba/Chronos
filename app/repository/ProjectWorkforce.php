<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class ProjectWorkforce extends Model
{
    protected $fillable = [
		'partitieId',
		'workforceId',
		'costId',
    ];

    public function workforce() {
    	return $this->belongsTo('Repo\Workforce', 'workforceId')->first();
    }

    public function qty() {
        $partitieId = ProjectPartitie::find($this->partitieId)->partitieId;

        return PartitieWorkforce::where('partitieId', $partitieId)
            ->where('workforceId', $this->workforceId)
            ->first()
            ->quantity;
    }

    public function cost() {
    	return $this->belongsTo('Repo\WorkforceCost', 'costId')
            ->first()
            ->cost;
    }
}
