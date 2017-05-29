<?php

namespace Cronos;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'companieId'];
}
