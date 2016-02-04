<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use Carbon\Carbon;

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
    			$notifications ="";
    			break;
    	}

    	return $notifications;
    	
    }

    public static function getNotificationsByFeature($bannerId, $windowType, $windowSize, $featureId)
    {

    }

}
