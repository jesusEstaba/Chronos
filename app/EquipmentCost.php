<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class EquipmentCost extends Model
{
    protected $fillable = [
    	'equipmentId',
		'cost'
    ];
}
