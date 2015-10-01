<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Week extends Model
{
    protected $table = 'weeks';

    protected $fillable = ["id", 'week_number', 'start_date', 'end_date', 'year', 'parent_id'];


    public static function getCurrentWeek($parent_id)
    {
        $today = Carbon::now()->toDateString();
        $currentWeek = Week::where('start_date', '<=', $today)
                            ->where('end_date', '>=', $today)
                            ->where('parent_id', $parent_id)->first();
        return $currentWeek;

    }
   

    public static function generateWeekFolders($parent_id)
    {
        // echo "parent_id in generate weeks " . $parent_id;
    	$currentYear = Year::getCurrentYear();
        $weekFolder = Week::where('year', $currentYear->year)->where('parent_id', $parent_id)->first();
    	
        if(! $weekFolder == null) {
    		return ;
    	}
        
    	$yearStart = Carbon::createFromFormat('Y-m-d', $currentYear->start);
    	$yearEnd = Carbon::createFromFormat('Y-m-d', $currentYear->end);

    	$totalWeeks = $totalWeeks =  intval( ceil( ($yearStart->diff($yearEnd)->days)/7) );

    	$weekStarts = Carbon::createFromFormat('Y-m-d', $currentYear->start);
        
        $weekEnds = Carbon::createFromFormat('Y-m-d', $currentYear->start); 
    	$weekEnds   = $weekEnds->addDays(6);
    
    	for ($i = 1; $i<= $totalWeeks ; $i++) {
    		Week::create([
    				'week_number' => $i,
    				'start_date'  => $weekStarts->toDateString(),
    			 	'end_date'	  => $weekEnds->toDateString(),
    				'year'		  => $currentYear->year,
                    'parent_id'	  => $parent_id

    			]);
    		$weekStarts = $weekStarts->addDays(7);
    		$weekEnds   = $weekEnds->addDays(7); 
    	}
        return;
    }

    public static function getWeekWindow($currentWeek, $windowSize)
    {
        $currentWeekId = $currentWeek->id;
        $weeksBefore = intval(floor($windowSize/2));
        $weeksAfter = intval(floor($windowSize/2));
        $weeks = \DB::table('weeks')
                ->whereBetween('id', [$currentWeekId-$weeksBefore, $currentWeekId+$weeksAfter])->get();
        return $weeks;
      
    }
}
