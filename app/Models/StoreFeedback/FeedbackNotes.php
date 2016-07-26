<?php

namespace App\Models\StoreFeedback;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;

class FeedbackNotes extends Model
{
    protected $table = 'feedback_notes';

    public static function getFeedbackNotesByFeedbackId($id)
    {
    	$notes =  FeedbackNotes::where('feedback_id', $id)
    						->get()
    						->each(function($note){
    							$note->prettyStartDate = Utility::prettifyDate($note->created_at);
    							$note->prettyUpdateDate = Utility::prettifyDate($note->updated_at);
    							$note->displayDate = $note->created_at;
    							$note->displayText = 'Added at:';
    							if($note->updated_at > $note->created_at)
    							{
    								$note->displayDate = $note->created_at;
    								$note->displayText = 'Updated at:';
    							}
    							$note->prettyDisplayDate = Utility::prettifyDate($note->displayDate);
    						})
    						->sortByDesc('displayDate');
    	return $notes;
    }
}
