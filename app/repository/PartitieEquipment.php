<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class PartitieEquipment extends Model
{
    protected $fillable = [
		'partitieId',
		'equipmentId',
		'quantity',
		'workers'
    ];

    public function equipment() {
        return $this->belongsTo('Repo\Equipment', 'equipmentId');
    }
}
