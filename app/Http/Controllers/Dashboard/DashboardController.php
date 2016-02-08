<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\UserSelectedBanner;
use App\Models\Document\FileFolder;
use App\Models\Document\Package;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationTarget;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\Feature\Feature;
use App\Models\Dashboard\Quicklinks;
use App\Models\Dashboard\DashboardBranding;
use App\Models\Notification\Notification;
use App\Skin;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
    	$storeNumber = RequestFacade::segment(1);

        $storeAPI = env('STORE_API_DOMAIN', false);
        $storeInfoJson = file_get_contents( $storeAPI . "/store/" . $storeNumber);
        $storeInfo = json_decode($storeInfoJson);

        $storeBanner = $storeInfo->banner_id;

        $banner = Banner::find($storeInfo->banner_id);
    
        $skin = Skin::getSkin($storeBanner);
        
        $features = Feature::where('banner_id', $storeBanner)->orderBy('order')->get();

        $quicklinks = Quicklinks::getLinks($storeBanner, $storeNumber);

        $notifications = Notification::getAllNotifications($storeInfo->banner_id, $banner->update_type_id, $banner->update_window_size); //most recent 10 docs

        $communicationCount = Communication::getCommunicationCount($storeNumber);

        $communications = Communication::getCommunicationsByStoreNumber($storeNumber, 3);
            //dd($notifications);
        return view('site.dashboard.index')
            ->with('banner', $banner)
            ->with('skin', $skin)
            ->with('quicklinks', $quicklinks)
        	->with('communicationCount', $communicationCount)
            ->with('communications', $communications)
            ->with('features', $features)
            ->with('notifications', $notifications);
    }


}
