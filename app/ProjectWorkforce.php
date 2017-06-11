<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class ProjectWorkforce extends Model
{
    protected $fillable = [
		'partitieId',
		'workforceId',
		'costId',
    ];
}
