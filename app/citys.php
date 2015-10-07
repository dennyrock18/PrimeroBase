<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class citys extends Model
{
    public function state()
    {
        return $this->belongsTo(states::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
