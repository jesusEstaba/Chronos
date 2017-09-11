<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';

	protected $fillable = [
    	'name',
        'companieId',
        'categoryId',
        'depreciation',
        'disabled'
    ];

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
    	return $this->hasMany('Repo\EquipmentCost', 'equipmentId');
    }
}
