<?php

namespace Cronos;

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
        return $this->belongsTo('Cronos\Material', 'materialId');
    }
}
