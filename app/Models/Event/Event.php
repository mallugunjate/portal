<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tag\ContentTag;
use App\Models\Banner;
use App\Models\UserBanner;
use App\Models\UserSelectedBanner;
use Carbon\Carbon;

class Event extends Model
{
	use SoftDeletes;
    protected $table = 'events';
    protected $dates = ['deleted_at'];
    protected $fillable = ['banner_id', 'title', 'description', 'event_type', 'start', 'end'];

    public static function storeEvent($request)
    {
    	$banner = UserSelectedBanner::getBanner();
        $event = Event::create([

    		'banner_id' => $banner->id,
            'title' => $request['title'],
            'event_type' => $request['event_type'],
            'description' => $request['description'],
            'start' => $request['start'],
            'end' => $request['end']
    	]);

    	return;
    }

    public static function updateEvent($id, $request)
    {
        $event = Event::find($id);

        $event->title = $request['title'];
        $event->event_type = $request['event_type'];
        $event->description = $request['description'];
        $event->start = $request['start'];
        $event->end = $request['end'];
        
        Event::updateTags($id, $request["tags"]);
        $event->save();

    }

    public static function updateTags($id, $tags)
    {
    	ContentTag::where('content_type', 'event')->where('content_id', $id)->delete();
        foreach ($tags as $tag) {
            ContentTag::create([
                'content_type' => 'event',
                'content_id'      => $id,
                'tag_id'          => $tag
            ]);
        }
        return;
    }

     public static function prettify($event)
      {
        // get the human readable days since send
        $start  = Carbon::createFromFormat('Y-m-d', $event->start);
        $end    = Carbon::createFromFormat('Y-m-d', $event->end);
        $since  = Carbon::now()->diffForHumans($start, true);
        
        $event->since = $since;

        //make the timestamp on the message a little nicer
        $event->prettyDateStart = $start->format('D j F');
        $event->prettyDateEnd = $end->format('D j F');
        
        return $event;
      }  
}

