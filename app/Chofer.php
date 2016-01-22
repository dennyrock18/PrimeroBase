<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    protected $fillable = ['fullname', 'numero_licencia','email', 'password','phone' ,'streetAddress', 'city_id','postCode'];
}
