<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Http\Request as Request;




class Profile extends Model
{
    protected $table = "profiles";
    protected $fillable = ['firstname', 'lastname', 'fullname', 'user_id', 'position_id', 'store_id'];

    public static function getManagerProfile($store)
    {
    	 $sgmPositionId = Position::where('name', 'SGM')->first()->id;
    	 $managerProfile = Profile::where('store_id', $store)
    	 		->where('position_id', $sgmPositionId)
    	 		->first();
    	 
    	 return ($managerProfile);
    }
    public static function getManagerEmail($store)
    {
    	$managerProfile = Profile::getManagerProfile($store);
    	$managerEmail = User::find($managerProfile->user_id)->email;
    	return $managerEmail;
    }

    public static function getStoreStaff($store)
    {
        $storeStaff = Profile::where('store_id', $store)
                            ->where('user_id', '!=', \Auth::user()->id)
                            ->orderBy('position_id', 'desc')
                            ->lists('fullname', 'id');
        return $storeStaff;

    }

    public static function initiateProfile($store, User $user)
    {
        Profile::create([
            'firstname'  => $user->firstname,
            'lastname'   => $user->lastname,
            'fullname'   => $user->firstname." ".$user->lastname,   
            'user_id'    => $user->id,
            'store_id'   => $store,
            'position_id'       =>0,
            'move_distance_id'  =>0,
            'career_path_id'    =>0,
            ]);

        return;
    }

    public static function updateProfile(Request $request)
    {
        
        $profile = Profile::where('user_id', \Auth::user()->id)->first();
        
        $profile->firstname       = $request->get('firstname');
        $profile->lastname        = $request->get('lastname');
        $profile->fullname        = $request->get('firstname')." ".$request->get('lastname');
        $profile->store_id        = $request->get('store');
        $profile->position_id     = $request->get('position');
        $profile->employee_id     = $request->get('employee_id');
        $profile->manager_id      = $request->get('manager');
        $profile->ulead           = $request->get('ulead');
        $profile->tribal_customs  = $request->get('tribal_customs');
        $profile->five_factors    = $request->get('five_factors');
        $profile->leadership_brand= $request->get('leadership_brand');
        $profile->move_distance_id= $request->get('move_distance');
        $profile->career_path_id  = $request->get('career_path');
        $profile->photo           = $request->file('profile_picture'); 

        $profile->save();

        Profile::updateSubscriptions($request);
        Profile::updateProfileHistory($request);
        Profile::updateProfileActivities($request);
        Profile::updateProfileEducation($request);
       
    }
     public static function getProfileSubscriptions($profile_id)
    {
        $subscription_group = \DB::table('profile_subscriptions')
                                        ->join('subscription_groups', 'profile_subscriptions.subscription_group_id', '=', 'subscription_groups.id')
                                        ->select('subscription_groups.id', 'subscription_groups.name' )
                                        ->where('profile_id', $profile_id)->lists('id');    
        return $subscription_group;

    }

    public static function updateSubscriptions(Request $request)
    {
        $profile = Profile::where('user_id', \Auth::user()->id)->first();

        \DB::table('profile_subscriptions')->where('profile_id', $profile->id)->delete();
        $subscriptions = $request->get('groups');
        foreach ($subscriptions as $subscription) {
            \DB::table('profile_subscriptions')->insert([
                'profile_id' => $profile->id,
                'subscription_group_id' => $subscription 
            ]);

        }
        

    }

    public static function getProfileHistory($profile_id)
    {
        $experiences = \DB::table('profile_history')->where('profile_id', $profile_id)->get();
        return $experiences;
    }
   

    public static function updateProfileHistory(Request $request)
    {
       
        $profile_id = Profile::where('user_id', \Auth::user()->id)->first()->id;

        
        $past_stores = $request->get('past_store');
        $past_starts = $request->get('past_start');
        $past_ends   = $request->get('past_end');
        $past_positions = $request->get('past_position');
        $counter = 0;
        
        if ($past_stores != null) {
            foreach ($past_stores as $key=>$value) {

                \DB::table('profile_history')->insert([
                        'profile_id' => $profile_id,
                        'start_date' => $past_starts[$counter],
                        'end_date'   => $past_ends[$counter],
                        'store_id'   => $value,
                        'position_id'=> $past_positions[$counter]        
                    ]);
                $counter++;
            }
        }
        
        
        $delete_histories = $request->get('delete_experience');
        
        if ($delete_histories != null) {
           foreach ($delete_histories as $history) {
                Profile::deleteProfileHistory($history);
            }

        }
        
        return;
    }

    public static function deleteProfileHistory($history_id)
    {
        \DB::table('profile_history')->where('id', $history_id)->delete();
    }


    public static function getProfileActivities($profile_id)
    {
        $activities = \DB::table('profile_activities')->where('profile_id', $profile_id)->get();
        return $activities;
    }

    public static function updateProfileActivities(Request $request)
    {
        $profile_id = Profile::where('user_id', \Auth::user()->id)->first()->id;

        
        $past_activities = $request->get('activity');
        $activity_levels = $request->get('activity_level');
        $activity_starts = $request->get('activity_start');
        $activity_ends   = $request->get('activity_end');
        $counter = 0;
        if ($past_activities != null) {
            foreach ($past_activities as $key=>$value) {

                \DB::table('profile_activities')->insert([
                        'profile_id' => $profile_id,
                        'activity_id'=> $value,
                        'level_id'   => $activity_levels[$counter],
                        'start'      => $activity_starts[$counter],
                        'finished'   => $activity_ends[$counter],
                              
                    ]);
                $counter++;

            }
        }
        

        $delete_activities = $request->get('delete_activity');
        if ($delete_activities != null) {
            foreach ($delete_activities as $activity) {
                Profile::deleteProfileActivity($activity);
            }
        }
        
        return;
    }

    public static function deleteProfileActivity($activity_id)
    {
        \DB::table('profile_activities')->where('id', $activity_id)->delete();
    }


    public static function getProfileEducation($profile_id)
    {
        $education = \DB::table('profile_education')->where('profile_id', $profile_id)->get();
        return $education;
    }

    public static function updateProfileEducation(Request $request)
    {
        // dd($request);
        $profile_id = Profile::where('user_id', \Auth::user()->id)->first() ->id;

        $edu_foci  = $request->get('edu_focus');
        $edu_level = $request->get('edu_level');
        $edu_start = $request->get('edu_start');
        $edu_end   = $request->get('edu_end');
        $school    = $request->get('school');
        $counter   = 0; 

        if ($edu_foci != null) {
            foreach ($edu_foci as $edu_focus) {
                \DB::table('profile_education')->insert([
                        'profile_id'           => $profile_id,
                        'focus'                => $edu_focus,
                        'education_level_id'   => $edu_level[$counter],
                        'education_start'      => $edu_start[$counter],
                        'education_end'        => $edu_end[$counter],
                        'school_name'          => $school[$counter]  

                    ]);
                $counter++;
            }
        }

        $delete_education = $request->get('delete_education');
        if ($delete_education != null) {
            foreach ($delete_education as $education) {
                Profile::deleteProfileEducation($education);
            }
        }
        return;

    }
    public static function deleteProfileEducation($education_id)
    {
        \DB::table('profile_education')->where('id', $education_id)->delete();
    }

    public static function getActivityList()
    {
        return \DB::table('activities')->lists('name', 'id');
    }

    public static function getActivityLevelList()
    {
        return \DB::table('activity_levels')->lists('level', 'id');
    }

    public static function getEducationLevelList()
    {
        return \DB::table('education_levels')->lists('level', 'id');
    }
}
