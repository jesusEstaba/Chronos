<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
    	'name',
        'companieId',
        'unitId',
        'categoryId'
    ];

    private function costs() {
    	return $this->hasMany('Cronos\MaterialCost', 'materialId');
    }

    public function unit() {
    	return $this->belongsTo('Cronos\Unit', 'unitId');
    }

    public function category() {
    	return $this->belongsTo('Cronos\Category', 'categoryId');
    }

    public function lastCost() {
    	return $this->costs()->orderBy('id', 'desc')->first()->cost;
    }
}
