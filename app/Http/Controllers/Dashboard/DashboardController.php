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

class DashboardController extends Controller
{

    public function index(Request $request)
    {
    	$storeNumber = RequestFacade::segment(1);

        $banner = UserSelectedBanner::getBanner();

        $features = Feature::where("banner", $banner);

        $communicationCount = DB::table('communications_target')
	        ->where('store_id', $storeNumber)
	        ->whereNull('is_read')
	        ->count();


        return view('site.dashboard.index')
        	->with('communicationCount', $communicationCount)
            ->with('features', $features);
    }


}
