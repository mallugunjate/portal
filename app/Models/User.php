<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Profile\Profile;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

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
    protected $fillable = ['firstname', 'lastname', 'email', 'password', 'group_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function activateAccount($code)
    {
        $user = User::where('activation_code', '=', $code)->first();
        $user->active = 1;
        $user->activation_code = '';
        if($user->save()) {
        \Auth::login($user);
        }
        return $user;
    }
    public function approveAccount($code)
    {
        $user = User::where('approval_code', '=', $code)->first();
        $user->approved = 1;
        $approvalCode = $user->approval_code;
        $user->approval_code = '';

        if($user->save()) {
            
            $store = substr($approvalCode, 60);
            $profile = Profile::initiateProfile($store, $user);  

        }
        return $user;
    }
}
