<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class ProjectMaterial extends Model
{
    protected $fillable = [
		'partitieId',
		'materialId',
		'costId',
        'quantity'
    ];

    public function material() {
    	return $this->belongsTo('Repo\Material', 'materialId')->first();
    }

    public function qty() {
        return $this->quantity;
    }

    public function cost() {
    	return $this->belongsTo('Repo\MaterialCost', 'costId')
            ->first()
            ->cost;
    }
}
