<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class Partitie extends Model
{
    protected $fillable = [
    	'name',
		'yield',
		'companieId',
		'unitId',
        'userId',
        'reference',
        'parent'
    ];

    public function unit() {
        return $this->belongsTo('Repo\Unit', 'unitId')->first();
    }

    public function materials() {
        return $this->hasMany('Repo\PartitieMaterial', 'partitieId');
    }

    public function equipments() {
        return $this->hasMany('Repo\PartitieEquipment', 'partitieId');
    }

    public function workforces() {
        return $this->hasMany('Repo\PartitieWorkforce', 'partitieId');
    }
}
