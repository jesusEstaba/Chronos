<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class ProjectMaterial extends Model
{
    protected $fillable = [
		'partitieId',
		'materialId',
		'costId',
    ];

    public function material() {
    	return $this->belongsTo('Repo\Material', 'materialId')->first();
    }

    public function qty()
    {
        $partitieId = ProjectPartitie::find($this->partitieId)->partitieId;

        return PartitieMaterial::where('partitieId', $partitieId)
            ->where('materialId', $this->materialId)
            ->first()
            ->quantity;
    }

    public function cost() {
    	return $this->belongsTo('Repo\MaterialCost', 'costId')
            ->first()
            ->cost;
    }
}
