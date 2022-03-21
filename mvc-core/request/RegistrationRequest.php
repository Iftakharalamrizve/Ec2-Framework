<?php

namespace app\request;

use app\core\Request;

class RegistrationRequest extends Request
{
    public function __construct()
    {

    }


    /**
     * attributes can be changed here like the following
     * 'user_name'=>'User Name', or 'user_name'=>trnas('your_translation_file.user_name')
     * @return [type] [description]
     */
    public function attributes()
    {
        return [
            'first_name'=>'required|max:256',
            'last_name'=>'required|max:256',
            'email'=>'required|email',
            'password'=>'required|max:6|min:1',
            'c_password'=>'match:password',
        ];
    }

    /**
     * form validation messages can be changed and translated by this method like the following
     * 'user_name.required'=>'Please provide user name' or 'user_name.required'=>trans('your_translation_file.user_name_msg')
     * @return [type] [description]
     */
    public function messages()
    {
        return [

            'first_name'=>'First Name Is required',
            'first_name.max'=>'First Name length is gather than {max} length ',
            'last_name'=>'Last name is required',
            'last_name.max'=>'Last length is gather than {max} length ',
            'email'=>'Email Is Required',
            'email.email'=>'Email Is not valid',
            'password'=>'Password Is required',
            'password.max'=>'Password length is gather than {max}',
            'password.min'=>'Password length is less than {min}',
            'c_password.match'=>'Password is not match with Confirm Password'

        ];
    }
}