<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class ProjectAssignment extends Model
{
    protected $fillable = [
        'projectId',
        'userId'
    ];

    public function user() {
        return $this->belongsTo('Repo\User', 'userId')->first();
    }
}
