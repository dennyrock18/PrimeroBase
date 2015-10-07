<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class states extends Model
{
    public function city()
    {
        return $this->hasMany(citys::class);
    }
}
