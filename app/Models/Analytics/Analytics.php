<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    protected $table = 'analytics';
    protected $fillable = ['store_number', 'resource_type', 'resource_id', 'resource_trigger_type', 'resource_trigger_id'];

    public static function store($request)
    {
    	$event = Analytics::create([
    		'store_number' => $request->store_number,	
 			'resource_type' => $request->resource_type,
 			'resource_id' => $request->resource_id,
 			'resource_trigger_type' => $request->follow_up,
 			'resource_trigger_id' => $request->store_number
 			// 'current_url' => $request->current_url,
 			// 'description' => $request->description
 		]);

 		$event->save();
    }    
}
