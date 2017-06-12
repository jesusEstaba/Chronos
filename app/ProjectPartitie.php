<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class ProjectPartitie extends Model
{
    protected $fillable = [
    	'yield',
		'quantity',
		'projectId',
		'partitieId',
    ];

    public function partitie() {
        return $this->belongsTo('Cronos\Partitie', 'partitieId')->first();
    }

    public function materials() {
        return $this->hasMany('Cronos\ProjectMaterial', 'partitieId')->get();
    }
    

    public function equipments() {
        return $this->hasMany('Cronos\ProjectEquipment', 'partitieId')->get();
    }

    public function workforces() {
        return $this->hasMany('Cronos\ProjectWorkforce', 'partitieId')->get();
    }
}
