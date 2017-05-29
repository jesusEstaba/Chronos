<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name', 'abbreviature', 'companieId'];
}
