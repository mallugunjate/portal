<?php

namespace App\Models\StoreFeedback;

use Illuminate\Database\Eloquent\Model;

class FeedbackResponse extends Model
{
    protected $table = 'feedback_response';


    public static function getFeedbackResponse($feedback_id)
    {
    	return FeedbackResponse::where('feedback_id', $feedback_id)->first();
    }
}
