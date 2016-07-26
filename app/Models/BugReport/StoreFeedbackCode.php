<?php

namespace App\Models\BugReport;

use Illuminate\Database\Eloquent\Model;

class StoreFeedbackCode extends Model
{
    protected $table = 'store_feedback_codes'; 

    public static function getFeedbackCodeList()
    {
    	return StoreFeedbackCode::all()->lists('name', 'id')->prepend('');
    }
}
