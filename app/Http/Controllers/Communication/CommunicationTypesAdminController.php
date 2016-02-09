<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\UserBanner;
use App\Models\UserSelectedBanner;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationType;

class CommunicationTypesAdminController extends Controller
{

  public function __construct()
    {
        $this->middleware('admin.auth');
        $this->middleware('banner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = \Auth::user()->id;
        $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
        $banners = Banner::whereIn('id', $banner_ids)->get();        
        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
        $banner  = Banner::find($banner_id);

        // $eventtypes = EventType::all();
        $eventtypes = CommunicationType::where('banner_id', $banner_id)->get();

        return view('admin.eventtypes.index')
            ->with('eventtypes', $eventtypes)
            ->with('banner', $banner)
            ->with('banners', $banners);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = \Auth::user()->id;
        $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
        $banners = Banner::whereIn('id', $banner_ids)->get();        
        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
        $banner  = Banner::find($banner_id);

        $event_types_list = CommunicationType::all();
        return view('admin.eventtypes.create')
            ->with('event_types_list', $event_types_list)
            ->with('banner', $banner)
            ->with('banners', $banners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $eventTypeDetails = array(
            'event_type' => $request['event_type'],
            'banner_id' => $request['banner_id']
        );

        $eventType = CommunicationType::create($eventTypeDetails);
        $eventType->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = \Auth::user()->id;
        $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
        $banners = Banner::whereIn('id', $banner_ids)->get();        
        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
        $banner  = Banner::find($banner_id);

        $eventType = CommunicationType::find($id);

        return view('admin.eventtypes.edit')
            ->with('eventType', $eventType)
            ->with('banner', $banner)
            ->with('banners', $banners);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $eventType = CommunicationType::find($id);

        $eventType->event_type = $request['event_type'];
    
        $eventType->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $id = Request::input('event_id');
        // $id = $request['event_id'];
        $eventtype = CommunicationType::find($id);
        $eventtype->delete();
    }
}
