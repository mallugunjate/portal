<?php

namespace App\Models\BugReport;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreFeedback\FeedbackCode;
use App\Models\StoreFeedback\FeedbackResponse;
use App\Models\StoreFeedback\FeedbackNotes;

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
    						->get()
    						->each(function($report){
    							$report->feedback_code = FeedbackCode::getFeedbackCode($report->id);
                                $report->response = FeedbackResponse::getFeedbackResponse($report->id);
    						});
    	return $reports;    
    }

    public static function getBugReportById($id)
    {
        $report = BugReport::find($id);
        // $report = BugReport::join('feedback_response', 'feedback_response.feedback_id', '=', 'bug_reports.id')
        //                     ->join('feedback_notes', 'feedback_notes.feedback_id', '=', 'bug_reports.id')
        //                     ->join('feedback_codes_pivot', 'feedback_codes_pivot.feedback_id', '=', 'bug_reports.id')
        //                     // ->join('store_feedback_codes', 'store_feedback_codes.id', '=', 'feedback_codes_pivot.code_id' )
        //                     ->where('bug_reports.id', $id)
        //                     ->select('bug_reports.*', 'feedback_notes.note', 'feedback_codes_pivot.code_id', 'feedback_response.closed as closed', 'feedback_response.followed_up as followed_up'  )
        //                     ->get();

        $report->response = FeedbackResponse::getFeedbackResponse($id);
        $report->notes = FeedbackNotes::getFeedbackNotesByFeedbackId($id);
        $report->code = FeedbackCode::getFeedbackCode($id);
        return $report;    
    }
}
