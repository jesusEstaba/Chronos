<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class PartitieMaterial extends Model
{
    protected $fillable = [
		'partitieId',
		'materialId',
		'quantity',
		'magnitude'
    ];

    public function material() {
        return $this->belongsTo('Repo\Material', 'materialId');
    }
}
