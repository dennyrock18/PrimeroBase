<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(tipoEquipo::class,'tipo_equipos_id');
    }

    protected $fillable = ['s_n', 'model','tipo_equipos_id','observacion'];
}
