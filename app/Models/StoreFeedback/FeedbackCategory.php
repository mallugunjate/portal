<?php

namespace App\Models\StoreFeedback;

use Illuminate\Database\Eloquent\Model;

class FeedbackCategory extends Model
{
    protected $table = 'feedback_category'; 

    public static function getFeedbackCategory($feedback_id)
    {
    	$codes = FeedbackCategory::join('feedback_category_types', 'feedback_category_types.id' , '=', 'feedback_category.category_id')
    						->where('feedback_category.feedback_id', $feedback_id)
    						->select('feedback_category_types.*')
    						->first();
    	return $codes;
    }

}
