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
}
