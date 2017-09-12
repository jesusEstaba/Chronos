<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class ProjectEquipment extends Model
{
    protected $fillable = [
		'partitieId',
		'equipmentId',
		'costId',
        'quantity'
    ];

    public function equipment() {
    	return $this->belongsTo('Repo\Equipment', 'equipmentId')->first();
    }

    public function qty() {
        return $this->quantity;
    }

    public function cost() {
        return $this->belongsTo('Repo\EquipmentCost', 'costId')
            ->first()
            ->cost;
    }
}
