<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class ProjectMaterial extends Model
{
    protected $fillable = [
		'partitieId',
		'materialId',
		'costId',
    ];
}
