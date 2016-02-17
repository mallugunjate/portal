<?php

namespace App\Models;

use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Profile\Profile;
use App\Models\UserBanner;

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

    public static function getAdminUsers()
    {
        $users = User::whereIn('group_id', [1,2])->get();
        foreach ($users as $user) {
            $banners = UserBanner::where('user_id', $user->id)->get();
            $user["banners"] = $banners;
        }
        return $users;
    }
    
    public static function createAdminUser($request)
    {
        $user = User::create([
            'firstname' => $request['firstname'],
            'lastname'  => $request['lastname'],
            'email'     => $request['email'],
            'group_id'  => intval($request['group']),
            'password'  => Hash::make($request['password'])
        ]);

        $banners = $request['banners'];
        foreach ($banners as $banner) {
            UserBanner::create([
                'user_id' => $user->id,
                'banner_id' => $banner
            ]);
        }
        \Log::info($user);
        return;

    }

    public static function updateAdminUser($id, $request)
    {
        $user = User::find($id);

        $user['firstname'] = $request['firstname'];
        $user['lastname']  = $request['lastname'];
        $user['email']     = $request['email'];
        $user['group_id']     = intval($request['group']);

        if(isset($request['password']) && $request['password'] != ''){
            $user['password'] = Hash::make($request['password']);
        }
        $user->save();

        UserBanner::where('user_id', $id)->delete();
        $banners = $request['banners'];
        foreach ($banners as $banner) {
            UserBanner::create([
                'user_id' => $id,
                'banner_id' => $banner
            ]);
        }
        return;

    }
}
