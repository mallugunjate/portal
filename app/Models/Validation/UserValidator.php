<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class UserValidator extends PortalValidator
{
    protected $rules = [
    	'firstname' => 'required',
    	'lastname'	=> 'required',
    	'email'		=> 'required|email|unique:users,email,id,$id',
    	'group'		=> 'required|exists:user_groups,id',
    	'banners'	=> 'required|exists:banners,id',
    	'password'	=> 'required|min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}$/|confirmed',
    	'password_confirmation' => 'required|min:8'

    ];
}
