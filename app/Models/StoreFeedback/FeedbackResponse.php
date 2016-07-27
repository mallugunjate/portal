<?php

namespace App\Models\StoreFeedback;

use Illuminate\Database\Eloquent\Model;

class FeedbackResponse extends Model
{
    protected $table = 'feedback_response';


    public static function getFeedbackResponse($feedback_id)
    {
    	$response =  FeedbackResponse::where('feedback_id', $feedback_id)->first();

    	// if ($response['closed']) {
    	// 	$response['status'] = 'Closed';
    	// }

    }
}
