<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class editUserRequest extends Request
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
            'id_user' => 'required|min:13|max:13',
            'email'    => 'required|unique:users,email,'. $this->route()->parameter('user'),
            'password' => 'confirmed|min:6',
            'phone' => 'required|min:14|max:14',
            'streetAddress' => 'required|max:30',
            'secundaryAddress' => 'max:30',
            'postCode' => 'required|max:10',
            'role' => 'required|in:admin,edit,user'


        ];
    }
}
