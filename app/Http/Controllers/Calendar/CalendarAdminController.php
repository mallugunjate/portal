<?php

namespace App\Http\Controllers\Calendar;

// use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Event\Event;
use App\Models\Event\EventType;

class CalendarAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('site.calendar.index');
        $events = Event::paginate(15);
        return view('admin.calendar.index')
            ->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event_types_list = EventType::all();
        return view('admin.calendar.create')
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

        // $validator = Validator::make($request->all(), [
        //     'banner' => 'required',
        //     'title' => 'required',
        //     'start' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return redirect('/admin/calendar/create')
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $eventDetails = array(
            'banner' => $request['banner'],
            'title' => $request['title'],
            'event_type' => $request['event_type'],
            'description' => $request['description'],
            'start' => $request['start'],
            'end' => $request['end'],
        );

        $event = Event::create($eventDetails);
        $event->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.calendar.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $event_type = EventType::find($id);
        $event_types_list = EventType::all();

        return view('admin.calendar.edit')
            ->with('event', $event)
            ->with('event_type', $event_type)
            ->with('event_types_list', $event_types_list);
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

        $event = Event::find($id);

        $event->title = $request['title'];
        $event->event_type = $request['event_type'];
        $event->description = $request['description'];
        $event->start = $request['start'];
        $event->end = $request['end'];

        $event->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        $event = Event::find($id);
        $event->delete();
    }
}
