<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    protected $table = 'analytics';
    protected $fillable = ['type', 'resource_id', 'store_number', 'location', 'location_id'];

    public static function store($request)
    {
    	$event = Analytics::create([
    		'type' => $request->type,
 			'resource_id' => $request->resource_id,    		
    		'store_number' => $request->store_number,	
 			'location' => $request->location,
 			'location_id' => $request->location_id
 		]);

 		$event->save();
    }    
}
