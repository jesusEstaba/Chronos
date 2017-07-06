<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class ProjectEquipment extends Model
{
    protected $fillable = [
		'partitieId',
		'equipmentId',
		'costId',
    ];

    public function equipment() {
    	return $this->belongsTo('Repo\Equipment', 'equipmentId')->first();
    }

    public function qty() {
        $partitieId = ProjectPartitie::find($this->partitieId)->partitieId;

        return PartitieEquipment::where('partitieId', $partitieId)
            ->where('equipmentId', $this->equipmentId)
            ->first()
            ->quantity;
    }

    public function cost() {
        return $this->belongsTo('Repo\EquipmentCost', 'costId')
            ->first()
            ->cost;
    }
}