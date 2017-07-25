<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class ProjectPartitie extends Model
{
    protected $fillable = [
    	'yield',
		'quantity',
		'projectId',
		'partitieId',
        'userId',
        'order',
        'parent'
    ];

    public function partitie() {
        return $this->belongsTo('Repo\Partitie', 'partitieId')->first();
    }

    public function activity() {
        return $this->hasMany('Repo\Activity', 'partitieId')->first();
    }

    public function materials() {
        return $this->hasMany('Repo\ProjectMaterial', 'partitieId')->get();
    }
    

    public function equipments() {
        return $this->hasMany('Repo\ProjectEquipment', 'partitieId')->get();
    }

    public function workforces() {
        return $this->hasMany('Repo\ProjectWorkforce', 'partitieId')->get();
    }
}
