<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Profile\Position;
use App\Models\Profile\Profile;
use App\Models\Profile\Move;
use App\Models\Profile\Career;
use App\Models\Profile\SubscriptionGroups;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost:8080/stores']);

        $storeobj_list = ($client->request('GET')->getBody()->getContents());

        $store_list = [];

        foreach (json_decode($storeobj_list) as $store) {
            $store_list[$store->value] = $store->label;
        }
        
        $user       = \Auth::user();
        $store_id   = Profile::where('user_id', $user->id)->first()->store_id;
        $storeStaff = Profile::getStoreStaff($store_id);
        $profile    = Profile::where('user_id', $user->id)->first();
        
        $profile_groups      = Profile::getProfileSubscriptions($profile->id);
        $profile_experiences = Profile::getProfileHistory($profile->id);
        $profile_activities  = Profile::getProfileActivities($profile->id);
        $profile_education   = Profile::getProfileEducation($profile->id);

        $positions_list       = Position::getPositionsList();
        $groups_list          = SubscriptionGroups::getSubscriptionGroupList();
        $moves_list           = Move::getMovesList();
        $careers_list         = Career::getCareersList();
        $activity_list        = Profile::getActivityList();
        $activity_level_list  = Profile::getActivityLevelList();
        // $stores_list          = ["1"=>"stephen ave", '2'=>"other store", "3"=>"some other store", '21'=>"one more store"];
        $education_level_list = Profile::getEducationLevelList();

        return view('profile.create')->with('user', $user)
                                    ->with('profile', $profile)
                                    ->with('storeStaff', $storeStaff)
                                    ->with('profile_groups', $profile_groups)
                                    ->with('profile_experiences', $profile_experiences)
                                    ->with('profile_activities', $profile_activities)
                                    ->with('profile_education', $profile_education)
                                    ->with('positions_list', $positions_list)
                                    ->with('moves_list', $moves_list)
                                    ->with('careers_list', $careers_list)
                                    ->with('groups_list', $groups_list)
                                    ->with('storeobj_list', $storeobj_list)
                                    ->with('stores_list', $store_list)
                                    ->with('activity_list', $activity_list)
                                    ->with('activity_level_list', $activity_level_list)
                                    ->with('edu_level_list', $education_level_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //validate inputs
        Profile::updateProfile($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
