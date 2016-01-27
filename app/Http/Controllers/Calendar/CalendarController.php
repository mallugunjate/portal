<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event\Event;
use App\Models\Event\EventTypes;
use App\Models\Banner;

use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationTarget;
use App\Skin;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $storeNumber = RequestFacade::segment(1);

        $storeAPI = env('STORE_API_DOMAIN', false);
        $storeInfoJson = file_get_contents( $storeAPI . "/store/" . $storeNumber);
        $storeInfo = json_decode($storeInfoJson);

        $storeBanner = $storeInfo->banner_id;

        $skin = Skin::getSkin($storeBanner);


        $communicationCount = DB::table('communications_target')
            ->where('store_id', $storeNumber)
            ->whereNull('is_read')
            ->count();

        $events = Event::where('banner_id', 1)->get(); 
        return view('site.calendar.index')
                ->with('skin', $skin)
                ->with('communicationCount', $communicationCount)
                ->with('events', $events);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
