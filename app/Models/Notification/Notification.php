<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use Carbon\Carbon;
use Log;

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
                //return;
    			break;
    	}

       foreach($notifications as $n){
            $folder_info = Document::getFolderInfoByDocumentId($n->id);
            // Log::info( $folder_info->name);
            $n->folder_name = $folder_info->name;
            $n->global_folder_id = $folder_info->global_folder_id;

            $since = Carbon::now()->diffForHumans($n->updated_at, true);

            $n->since = $since;
            $updated_at = Carbon::create($n->udpated_at);
            $n->prettyDate = $updated_at->toDayDateTimeString();

            if( $n->created_at == $n->updated_at ){
                $n->verb = "added to";
            } else {
                $n->verb = "updated in";
            }
        }

    	return $notifications;
    	
    }

    public static function getNotificationsByFeature($bannerId, $windowType, $windowSize, $featureId)
    {

    }

}
