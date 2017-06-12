<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class ProjectMaterial extends Model
{
    protected $fillable = [
		'partitieId',
		'materialId',
		'costId',
    ];

    public function material() {
    	return $this->belongsTo('Cronos\Material', 'materialId')->first();
    }

    public function cost() {
    	return $this->belongsTo('Cronos\MaterialCost', 'costId')->first();
    }
}
