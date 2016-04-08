<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class delivery extends Model
{
    protected $table = 'deliveries';

    public function chofer()
    {
        return $this->belongsTo(User::class,'chofer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

