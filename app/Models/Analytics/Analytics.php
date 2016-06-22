<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationTarget;
use App\Models\Communication\CommunicationType;

use App\Models\UrgentNotice\UrgentNotice;
use App\Models\UrgentNotice\UrgentNoticeTarget;


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


    public static function getTrafficLast24hrs()
    {
		$visitorTraffic = Analytics::select('id', 'type', 'resource_id', 'created_at')
			->where('created_at', '>=', Carbon::yesterday())
			->orderBy('created_at', 'ASC')
		    ->get()
		    ->groupBy(function($date) {
		        return Carbon::parse($date->created_at)->format('D g a'); 
		    });    	

		    $now = Carbon::now();
		    foreach($visitorTraffic as $t){
						   		

		   	}
		   //	dd($now);
          // dd($now->format("G"));
           // dd($now->hour);
           // dd($visitorTraffic);
        return $visitorTraffic;
    }

    public static function getTrafficLast30Days()
    {
		$visitorTraffic = Analytics::select('id', 'type', 'resource_id', 'created_at')
			->where('created_at', '>=', Carbon::now()->subMonth())
		    ->get()
		    ->groupBy(function($date) {
		        return Carbon::parse($date->created_at)->format('D M d'); 
		    });    	
           
        return $visitorTraffic;
    }

    public static function getCommunicationStats()
    {
    	//get all communciations for the last 30 days
    	$comms = Communication::select('id', 'subject', 'communication_type_id', 'send_at', 'archive_at', 'banner_id')
    		->where('archive_at', '>=', Carbon::now()->subDays(14))
    		->orderBy('send_at', 'DESC')
    		->get();
    		// ->groupBy(function($date) {
		    //     return Carbon::parse($date->created_at)->format('D M d'); 
		    // });  

    	return $comms;
    	//get type of each comm
    	
    	//figure out target stores for each 
    	
    	//figure out what stores opened it
    	
    	//calculate a percentage

    	//format a list of stores +/-
    }

    public static function getUrgentNoticeStats()
    {
    	$notices = UrgentNotice::select('id', 'title', 'start', 'end', 'banner_id')
    		->where('end', '>=', Carbon::now())
    		->orderBy('start')
    		->get();
    		// ->groupBy(function($date) {
		    //     return Carbon::parse($date->created_at)->format('D M d'); 
		    // });  

    	return $notices;
    }
}
