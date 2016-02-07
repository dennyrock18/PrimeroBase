<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
//para cada ves que se elimine esto no se haga fisicamente en la BD
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fullname', 'id_user','email', 'password','phone' ,'streetAddress', 'city_id','secundaryAddress' ,'postCode'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function equipo()
    {
        return $this->hasMany(Equipo::class);
    }

    public function pdf()
    {
        return $this->hasMany(pdf::class);
    }

    public function city()
    {
        return $this->belongsTo(citys::class);
    }

    public function getDireccionAttribute()
    {
        return $this->streetAddress!='' ? $this->streetAddress . ' ' .$this->city->city . ' ' .$this->city->state->state .' '. $this->postCode
            : $this->secundaryAddress . ' ' .$this->city->city . ' ' .$this->city->state->state .' '. $this->postCode;
    }
    public function setPasswordAttribute($value)
    {
        //$this->attributes['password']=\Hash::make($value);
        if(!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function setCityidAttribute($value)
    {
        if(is_numeric($value)) {
            $this->attributes['city_id'] = $value;
        }
    }

    public function getStateidAttribute()
    {
        return $this->city->state->id;
    }

}
