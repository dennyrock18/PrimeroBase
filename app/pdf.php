<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pdf extends Model
{
    //protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
