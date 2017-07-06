<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class PartitieMaterial extends Model
{
    protected $fillable = [
		'partitieId',
		'materialId',
		'quantity',
		'uniq'
    ];

    public function material() {
        return $this->belongsTo('Repo\Material', 'materialId');
    }
}
