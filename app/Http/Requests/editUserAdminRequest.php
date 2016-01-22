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
            'id_user' => 'required|min:13|max:13|unique:users,id_user,'. $this->route()->parameter('admin'),
            'email'    => 'required|unique:users,email,'. $this->route()->parameter('admin'),
            'password' => 'confirmed|min:6',
            'phone' => 'required|min:14|phone_number|max:14|unique:users,phone,'. $this->route()->parameter('admin'),
            'streetAddress' => 'required|max:30',
            'postCode' => 'required|max:5|post_code_v',
            //'role' => 'required|in:admin',
        ];
    }
}
