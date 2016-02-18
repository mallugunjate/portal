<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Feature\Feature;
use App\Models\Notification\Notification;
use App\Skin;
use App\Models\Feature\FeatureDocument;
use App\Models\Feature\FeaturePackage;
use App\Models\Document\Document;
use App\Models\Document\Package;
use App\Models\StoreInfo;
use App\Models\UrgentNotice\UrgentNotice;

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

        $storeBanner = $storeInfo->banner_id;

        $skin = Skin::getSkin($storeBanner);

        $id = $request->id;		

        $feature = Feature::where('id', $id)->first();

        $feature_documents = FeatureDocument::where('feature_id', $id)->get()->pluck('document_id');
        $selected_documents = array();
        foreach ($feature_documents as $doc_id) {
            
            $doc = Document::find($doc_id);
            $doc->folder_path = Document::getFolderPathForDocument($doc_id);
            array_push($selected_documents, $doc );
            
        }
        
        $feature_packages = FeaturePackage::where('feature_id', $id)->get()->pluck('package_id');
        $selected_packages = [];
        foreach ($feature_packages as $package_id) {
            $package = Package::find($package_id);
            $package_details = Package::getPackageDetails($package_id);
            $package['details'] = $package_details;
            array_push($selected_packages, $package);

        }

		$notifications = Notification::getNotificationsByFeature($storeInfo->banner_id, $feature->update_type_id, $feature->update_frequency, $feature->id);
        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);
        return view('site.feature.index')
            ->with('skin', $skin)
			->with('notifications', $notifications)
            ->with('feature', $feature)
            ->with('feature_documents', $selected_documents)
            ->with('feature_packages', $selected_packages)
            ->with('urgentNoticeCount', $urgentNoticeCount);
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
