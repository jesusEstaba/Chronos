<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class PartitieEquipment extends Model
{
    protected $fillable = [
		'partitieId',
		'equipmentId',
		'quantity'
    ];

    public function equipment() {
        return $this->belongsTo('Cronos\Equipment', 'equipmentId');
    }
}
