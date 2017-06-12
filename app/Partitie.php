<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class Partitie extends Model
{
    protected $fillable = [
    	'name',
		'yield',
		'companieId',
		'unitId'
    ];

    public function unit() {
        return $this->belongsTo('Cronos\Unit', 'unitId')->first();
    }

    public function materials() {
        return $this->hasMany('Cronos\PartitieMaterial', 'partitieId');
    }

    public function equipments() {
        return $this->hasMany('Cronos\PartitieEquipment', 'partitieId');
    }

    public function workforces() {
        return $this->hasMany('Cronos\PartitieWorkforce', 'partitieId');
    }
}
