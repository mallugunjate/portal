<?php

namespace App\Http\Controllers\Alert;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationTarget;
use App\Models\Notification\Notification;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Banner;
use App\Models\StoreInfo;
use App\Skin;
use App\Models\Alert\Alert;
use App\Models\Alert\AlertType;
use App\Models\Document\Document;
use App\Models\Utility\Utility;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $storeNumber = RequestFacade::segment(1);
        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);
        $storeBanner = $storeInfo->banner_id;
        $communicationCount = Communication::getActiveCommunicationCount($storeNumber);
        $storeBanner = $storeInfo->banner_id;

        $skin = Skin::getSkin($storeBanner);
        $banner = Banner::find($storeInfo->banner_id);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);

        $alertTypes = AlertType::all();
        $alertCount = Alert::getActiveAlertCountByStore($storeNumber);

        $alerts = Alert::getAlertsByStore($storeNumber);

        $title ="";
        if($request['type']){
            $i = 0;
            foreach($alerts as $a){
                if($a->alert_type_id != $request['type']){
                    unset($alerts[$i]);
                }
                $i++;
            }
            $title = AlertType::where('id','=',$request['type'])->pluck('name');
            $alerts= array_values($alerts);
        }
        
        
        foreach($alerts as $a){
            $doc = Document::getDocumentById($a->document_id);
            $alertType = AlertType::find($a->alert_type_id);

            $a->icon = Utility::getIcon($doc->original_extension);
            $a->link_with_icon = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, 1);
            $a->link = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, 0);
            $a->title = $doc->title;
            $a->filename = $doc->filename;
            $a->description = $doc->description;
            $a->original_extension = $doc->original_extension;
            $a->alertTypeName = $alertType->name;
            
        }        

        
        foreach($alertTypes as $at){
            $at->count = Alert::getActiveAlertCountByCategory($storeNumber, $at->id);
        }        

        return view('site.alerts.index')
            ->with('skin', $skin)
            ->with('communicationCount', $communicationCount)
            ->with('alerts', $alerts)
            ->with('alertTypes', $alertTypes)
            ->with('alertCount', $alertCount)
            ->with('title', $title)
            ->with('urgentNoticeCount', $urgentNoticeCount);
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
    public function show($id)
    {
        //
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
