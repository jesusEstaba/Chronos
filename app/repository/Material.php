<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
    	'name',
        'companieId',
        'unitId',
        'categoryId'
    ];

    public function unit() {
    	return $this->belongsTo('Repo\Unit', 'unitId');
    }

    public function category() {
    	return $this->belongsTo('Repo\Category', 'categoryId');
    }

    public function lastCost() {
    	return $this->costs()->orderBy('id', 'desc')->first()->cost;
    }

    public function lastCostId() {
        return $this->costs()->orderBy('id', 'desc')->first()->id;
    }

    public function costs() {
        return $this->hasMany('Repo\MaterialCost', 'materialId');
    }
}
