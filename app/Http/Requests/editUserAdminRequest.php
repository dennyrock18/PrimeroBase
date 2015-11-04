<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class editUserAdminRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'fullname' => 'required',
            'id_user' => 'required|min:13|max:13|unique:users,id_user,'. $this->route()->parameter('administrator'),
            'email'    => 'required|unique:users,email,'. $this->route()->parameter('administrator'),
            'password' => 'confirmed|min:6',
            'phone' => 'required|min:14|max:14|unique:users,phone,'. $this->route()->parameter('administrator'),
            'streetAddress' => 'required|max:30',
            'postCode' => 'required|max:10',
        ];
    }
}
