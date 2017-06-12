<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class PartitieWorkforce extends Model
{
    protected $fillable = [
		'partitieId',
		'workforceId',
		'quantity',
    ];

    public function workforce() {
        return $this->belongsTo('Cronos\Workforce', 'workforceId')->first();
    }
}
