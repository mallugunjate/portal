<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event\Event;
use App\Models\Event\EventType;

class EventTypesAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventtypes = EventType::all();
        return view('admin.eventtypes.index')
           ->with('eventtypes', $eventtypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event_types_list = EventType::all();
        return view('admin.eventtypes.create')
            ->with('event_types_list', $event_types_list);
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
        );

        $eventType = EventType::create($eventTypeDetails);
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
        $eventType = EventType::find($id);

        return view('admin.eventtypes.edit')
            ->with('eventType', $eventType);
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

        $eventType = EventType::find($id);

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
        $eventtype = EventType::find($id);
        $eventtype->delete();
    }
}
