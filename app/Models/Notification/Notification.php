<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use App\Models\Feature\Feature;
use Carbon\Carbon;
use Log;
use DB;

class Notification extends Model
{
    public static function getAllNotifications($bannerId, $windowType, $windowSize)
    {
    	switch($windowType){
    		case 1:  //by number of days
    			$dateSince = Carbon::now()->subDays($windowSize)->toDateTimeString();

    			$notifications = Document::where('banner_id', $bannerId)
    							->where('created_at', '>=', $dateSince)
    							->orderBy('updated_at', 'desc')
    							->get();
    			break;
    		case 2:  //by number of documents
    			$notifications = Document::where('banner_id', $bannerId)
    							->orderBy('updated_at', 'desc')
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

    public static function getNotificationsByFeature($bannerId, $windowType, $windowSize, $featureId)
    {
        $documentIdArray = Feature::getDocumentsIdsByFeatureId($featureId);
        $documentIdArray = array_values($documentIdArray);

        switch($windowType){
            case 1:  //by number of days
                $dateSince = Carbon::now()->subDays($windowSize)->toDateTimeString();
                $notifications = Document::findMany($documentIdArray)->sortBy('updated_at')->reverse();

                $i=0;
                foreach($notifications as $n){
                    if($n->updated_at < $dateSince){
                        $notifications->forget($i);
                    }
                    $i++;
                }
                
                break;
            case 2:  //by number of documents
                $notifications = Document::findMany($documentIdArray)->sortBy('updated_at')->reverse()->take($windowSize);
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
            $since = Carbon::now()->diffForHumans($n->updated_at, true);
            $n->since = $since;
            //adjust the verbage
            if( $n->created_at == $n->updated_at ){
                $n->verb = "added to";
            } else {
                $n->verb = "updated in";
            }            
            
            //make the timestamp on the file a little nicer
            $updated_at = Carbon::create($n->udpated_at);
            $n->prettyDate = $updated_at->toDayDateTimeString();
        }
        return $notifications;
    }

}
