<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';

	protected $fillable = [
    	'name',
        'companieId',
        'categoryId',
        'depreciation'
    ];

    public function category() {
    	return $this->belongsTo('Cronos\Category', 'categoryId');
    }

    public function lastCost() {
    	return $this->costs()->orderBy('id', 'desc')->first()->cost;
    }

    public function costs() {
    	return $this->hasMany('Cronos\EquipmentCost', 'equipmentId');
    }
}
