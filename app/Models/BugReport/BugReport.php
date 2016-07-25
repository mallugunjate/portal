<?php

namespace App\Models\BugReport;

use Illuminate\Database\Eloquent\Model;

class BugReport extends Model
{
    protected $table = 'bug_reports';
    protected $fillable = ['banner', 'user', 'user_email', 'follow_up', 'store_number', 'current_url', 'description'];

    public static function storeBugReport($request)
    {
    	$bug = BugReport::create([
    		'banner' => $request->banner,	
 			'user' => $request->user,
 			'user_email' => $request->user_email,
 			'follow_up' => $request->follow_up,
 			'store_number' => $request->store_number,
 			'current_url' => $request->current_url,
 			'description' => $request->description
 		]);

 		$bug->save();
    }

    public static function getAllBugReports($banner_id)
    {
    	$reports = BugReport::where('banner', $banner_id)
    						->orderBy('created_at','desc')
    						->get();
    	return $reports;    
    }
}
