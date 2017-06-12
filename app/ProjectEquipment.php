<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class ProjectEquipment extends Model
{
    protected $fillable = [
		'partitieId',
		'equipmentId',
		'costId',
    ];

    public function equipment() {
    	return $this->belongsTo('Cronos\Equipment', 'equipmentId')->first();
    }

    public function cost() {
    	return $this->belongsTo('Cronos\EquipmentCost', 'costId')->first();
    }
}
