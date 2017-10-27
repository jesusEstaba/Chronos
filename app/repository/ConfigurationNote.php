<?php

namespace Repo;

use Illuminate\Database\Eloquent\Model;

class ConfigurationNote extends Model
{
    public static function getByKey($key)
    {
        $text = static::where('name', $key)->first();
        
        if (!$text) {
            return '';
        }
        
        return $text->value;
    }
}
