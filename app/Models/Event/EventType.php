<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Validation\EventTypeValidator;

class EventType extends Model
{
	use SoftDeletes;
    protected $table = 'event_types';
    protected $dates = ['deleted_at'];
    protected $fillable = ['event_type', 'banner_id'];

    public static function validateEventType($request)
    {
    	$validateThis = [
    						'event_type' => $request['event_type']
    					];

    	$v = new EventTypeValidator();
		return $v->validate($validateThis);
    }
}
