<?php

namespace App\Models\StoreFeedback;

use Illuminate\Database\Eloquent\Model;

class FeedbackCode extends Model
{
    protected $table = 'feedback_codes_pivot'; 

    public static function getFeedbackCodes($feedback_id)
    {
    	$codes = FeedbackCode::join('store_feedback_codes', 'store_feedback_codes.id' , '=', 'feedback_codes_pivot.code_id')
    						->where('feedback_codes_pivot.feedback_id', $feedback_id)
    						->select('store_feedback_codes.*')
    						->first();
    	return $codes;
    }
}
