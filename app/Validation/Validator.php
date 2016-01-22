<?php namespace App\Validation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator as LaravelValidator;

class Validator extends LaravelValidator {

    public function validatePhoneNumber($attribute, $value, $parameters)
    {
        return preg_match('/^\(\d{3}\)-\d{3}-\d{4}$/', $value);
    }

    public function validatePostCodeV($attribute, $value, $parameters)
    {
        return preg_match('/^\d{5}$/', $value);
    }

}