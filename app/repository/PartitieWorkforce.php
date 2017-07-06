<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class PartitieWorkforce extends Model
{
    protected $fillable = [
		'partitieId',
		'workforceId',
		'quantity',
    ];

    public function workforce() {
        return $this->belongsTo('Repo\Workforce', 'workforceId');
    }
}
