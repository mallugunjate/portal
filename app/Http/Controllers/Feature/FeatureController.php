<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Feature\Feature;
use App\Models\Notification\Notification;
use App\Skin;
use App\Models\Feature\FeatureDocument;
use App\Models\Feature\FeaturePackage;
use App\Models\Feature\FeatureCommunication;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationTarget;
use App\Models\Document\Document;
use App\Models\Document\Package;
use App\Models\StoreInfo;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Alert\Alert;
use App\Models\Utility\Utility;
use App\Models\Banner;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $storeNumber = RequestFacade::segment(1);

        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);

        $alertCount = Alert::getActiveAlertCountByStore($storeNumber);

        $communicationCount = Communication::getActiveCommunicationCount($storeNumber);     

        $storeBanner = $storeInfo->banner_id;

        $banner = Banner::find($storeBanner);

        $isComboStore = $storeInfo->is_combo_store;

        $skin = Skin::getSkin($storeBanner);

        $id = $request->id;		

        $feature = Feature::where('id', $id)->first();

        $feature_documents = FeatureDocument::where('feature_id', $id)->get()->pluck('document_id');
        $selected_documents = array();
        foreach ($feature_documents as $doc_id) {
            
            $doc                = Document::find($doc_id);
            $doc->folder_path   = Document::getFolderPathForDocument($doc_id);
            $doc->link          = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, 0);
            $doc->link_with_icon= Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, 1);
            $doc->icon          = Utility::getIcon($doc->original_extension);

            $doc->prettyDate = Utility::prettifyDate($doc->updated_at);
            $doc->since = Utility::getTimePastSinceDate($doc->updated_at);
            array_push($selected_documents, $doc );
        }
        
        $feature_packages = FeaturePackage::where('feature_id', $id)->orderBy('order')->get()->pluck('package_id');
        $selected_packages = [];
        foreach ($feature_packages as $package_id) {
            $package = Package::find($package_id);
            $package_details = Package::getPackageDetails($package_id);
            $package['details'] = $package_details;
            array_push($selected_packages, $package);

        }
        
        $feature_communcation_type_id = FeatureCommunication::getCommunicationTypeId($id);
        $feature_communcations = CommunicationTarget::getTargetedCommunicationsByCategory($storeNumber, $feature_communcation_type_id);
        // if($feature_communcation_type_id != 0){
            
        // } else {
        //     $feature_communcations = 
        // }

		$notifications = Notification::getNotificationsByFeature($storeInfo->banner_id, $feature->update_type_id, $feature->update_frequency, $feature->id);
        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);
        return view('site.feature.index')
            ->with('skin', $skin)
            ->with('urgentNoticeCount', $urgentNoticeCount)
			->with('notifications', $notifications)
            ->with('communicationCount', $communicationCount)
            ->with('alertCount', $alertCount)            
            ->with('feature', $feature)
            ->with('feature_documents', $selected_documents)
            ->with('feature_packages', $selected_packages)
            ->with('feature_communcations', $feature_communcations)
            ->with('urgentNoticeCount', $urgentNoticeCount)
            ->with('banner', $banner)
            ->with('isComboStore', $isComboStore);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
