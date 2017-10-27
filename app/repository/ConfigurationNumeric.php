<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class ConfigurationNumeric extends Model
{
    public static function getByKey($key)
    {
        $number = static::where('name', $key)->first();
        
        if (!$number) {
            return 0;
        }
        
        return $number->value;
    }
}
