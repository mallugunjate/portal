<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use App\Models\Feature\Feature;
use Carbon\Carbon;
use Log;
use DB;
use App\Models\Utility\Utility;

class Notification extends Model
{
    public static function getAllNotifications($bannerId, $windowType, $windowSize)
    {

        $today = Carbon::today()->toDateString();
    	switch($windowType){
    		case 1:  //by number of days
    			$dateSince = Carbon::now()->subDays($windowSize)->toDateTimeString();

    			$notifications = Document::where('banner_id', $bannerId)
    							->where('updated_at', '>=', $dateSince)
                                ->where('start', '<=', $today)
                                // ->where('end', '>=', $today)
    							->orderBy('updated_at', 'desc')
    							->get();

                $counter = 0;
                foreach ($notifications as $notification) {
                    
                    if (!( $notification->end >= Carbon::today()->toDateString() || $notification->end == '0000-00-00 00:00:00' ) ) {

                        $notifications->forget($counter);
                    }
                    $counter++;
                }  
                // $notifications = array_values($notifications);


    			break;
    		case 2:  //by number of documents
    			$notifications = Document::where('banner_id', $bannerId)
    							->orderBy('updated_at', 'desc')
                                ->where('start', '<=', $today)
                                // ->where('end', '>=', $today)
    							// ->take($windowSize)
    							->get();

                $counter = 0;
                foreach ($notifications as $notification) {
                    
                    if (!( $notification->end >= Carbon::today()->toDateString() || $notification->end == '0000-00-00 00:00:00' ) ) {

                        $notifications->forget($counter);
                    }
                    $counter++;
                }
                // return $notifications;   
                $waste_chunk = $notifications->splice($windowSize);
                
    			break;

    		default:
    			$notifications ="not a valid parameter in getAllNotifications()";
    			break;
    	}

        Notification::prettifyNotifications($notifications);

        $i=0;
        foreach($notifications as $n){

            $link = Utility::getModalLink($n->filename, $n->title, $n->original_extension, 0);
            $link_with_icon = Utility::getModalLink($n->filename, $n->title, $n->original_extension, 1);
            $icon = Utility::getIcon($n->original_extension);

            $n->icon = $icon;
            $n->link = $link;
            $n->link_with_icon = $link_with_icon;

            $i++;
        }

    	return $notifications;
    }

    public static function getNotificationsByFeature($bannerId, $windowType, $windowSize, $featureId)
    {
        $today = Carbon::today()->toDateString();
        $documentIdArray = Feature::getDocumentsIdsByFeatureId($featureId);
        $documentIdArray = array_values($documentIdArray);

        switch($windowType){
            case 1:  //by number of days
                $dateSince = Carbon::now()->subDays($windowSize)->toDateTimeString();
                $notifications = Document::whereIn('id', $documentIdArray)
                                            ->orderBy('updated_at', 'desc')
                                            // ->where('start', '<=', $today)
                                            // ->where('end', '>=', $today)
                                            ->get();

                $i=0;
                foreach($notifications as $n){
                    if($n->updated_at < $dateSince){
                        $notifications->forget($i);
                    }
                    $i++;
                }
                
                break;
            case 2:  //by number of documents
                $notifications = Document::whereIn('id', $documentIdArray)
                                        ->orderBy('updated_at', 'desc')
                                        // ->where('start', '<=', $today)
                                        // ->where('end', '>=', $today)
                                        ->take($windowSize)
                                        ->get();
                break;

            default:
                $notifications ="not a valid parameter in getAllNotifications()";
                break;
        }

        Notification::prettifyNotifications($notifications);
        return $notifications;
    }

    public static function prettifyNotifications($notifications)
    {
       foreach($notifications as $n){
            //get folder info for the doc
            $folder_info = Document::getFolderInfoByDocumentId($n->id);
            $n->folder_name = $folder_info->name;
            $n->global_folder_id = $folder_info->global_folder_id;

            // get the human readable days since 
            $n->since =  Utility::getTimePastSinceDate($n->updated_at);

            //adjust the verbage
            if( $n->created_at == $n->updated_at ){
                $n->verb = "added to";
            } else {
                $n->verb = "updated in";
            }            
            
            //make the timestamp on the file a little nicer
            $n->prettyDate =  Utility::prettifyDate($n->updated_at);
        }
        return $notifications;
    }

}
