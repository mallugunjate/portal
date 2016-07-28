<?php

namespace App\Models\StoreFeedback;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreFeedback\FeedbackNotes;

class FeedbackResponse extends Model
{
    protected $table = 'feedback_response';

    protected $fillable = ['feedback_id', 'status_id', 'followed_up'];


    public static function getFeedbackResponse($feedback_id)
    {
    	return  FeedbackResponse::where('feedback_id', $feedback_id)->first();

    	// if ($response['closed']) {
    	// 	$response['status'] = 'Closed';
    	// }

    }

    public static function updateFeedbackResponse($feedbackId, $request)
    {
        if (isset($request['feedback_status_id'])) {

            FeedbackResponse::updateFeedbackStatus($feedbackId, $request['feedback_status_id']);
            FeedbackNotes::addFeedbackNote($feedbackId, 'Issue closed');
            
        }

        if(isset($request['feedback_category_id'])){
            
            if (FeedbackCategory::where('feedback_id', '=', $feedbackId)->exists()) {
                
                FeedbackResponse::updateFeedbackCategory($feedbackId, $request['feedback_category_id']);
                FeedbackNotes::addFeedbackNote($feedbackId, 'Category updated to ' . $request['feedback_category_id']);

            }
            else{

                FeedbackResponse::addFeedbackCategory($feedbackId, $request['feedback_category_id']);
                FeedbackResponse::updateFeedbackStatus($feedbackId, 1);
                FeedbackNotes::addFeedbackNote($feedbackId, 'New category assigned to feedback');
                
            }
            
        }

        if(isset($request['feedback_follow_up'])){
            
            FeedbackResponse::updateFeedbackFollowup($feedbackId, $request['feedback_follow_up']);
            FeedbackNotes::addFeedbackNote($feedbackId, 'Followed up changed');

        }
        
    }

    public static function updateFeedbackStatus($feedbackId, $statusId)
    {
        $feedbackResponse = FeedbackResponse::firstorNew(['feedback_id' => $feedbackId]);
        $feedbackResponse['feedback_status_id'] = intval( $statusId );
        $feedbackResponse->save();$feedbackResponse->save();
    }

    public static function updateFeedbackCategory($feedbackId, $categoyId)
    {
        $feedbackCategory = FeedbackCategory::where('feedback_id' , $feedbackId)->first();
        $feedbackCategory['category_id'] = intval($categoyId);
        $feedbackCategory->save();
    }

    public static function addFeedbackCategory($feedbackId, $categoryId)
    {
        FeedbackCategory::create([
            'feedback_id' => $feedbackId ,
            'category_id' => intval($categoryId)
        ]);

    }
    public static function updateFeedbackFollowup($feedbackId, $followupStatus)
    {
        $feedbackResponse = FeedbackResponse::firstorNew(['feedback_id' => $feedbackId]);
        $feedbackResponse['followed_up'] = intval( $followupStatus );
        $feedbackResponse->save();
    }

   

}
