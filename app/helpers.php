<?php

use App\states;

function currentUser()
{
    return auth()->user();
}

function isNotAdmin($role)
{
    return $role != 'admin';
}

function state()
{
    return states::lists('state', 'id')->toArray();
}



