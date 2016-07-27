<?php

namespace App\Models\StoreFeedback;

use Illuminate\Database\Eloquent\Model;

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

            $feedbackResponse = FeedbackResponse::where('feedback_id', $feedbackId)->first();
            $feedbackResponse['feedback_status_id'] = intval( $request['feedback_status_id'] );
            $feedbackResponse->save();
            
        }

        if(isset($request['feedback_category_id'])){

            \Log::info($request->all());
            $feedbackCategory = FeedbackCategory::where('feedback_id', $feedbackId)->first();
            $feedbackCategory['category_id'] = intval($request['feedback_category_id']);
			$feedbackCategory->save();
			\Log::info($feedbackCategory);
        }
        // return;
    }
}
