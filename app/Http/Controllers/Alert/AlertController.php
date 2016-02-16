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

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeNumber = RequestFacade::segment(1);
        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);
        $storeBanner = $storeInfo->banner_id;
        $communicationCount = Communication::getCommunicationCount($storeNumber);
        $storeBanner = $storeInfo->banner_id;

        $skin = Skin::getSkin($storeBanner);
        $banner = Banner::find($storeInfo->banner_id);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);

        $alertTypes = AlertType::all();
        $alerts = Alert::getAlertsByStore($storeNumber);
        $alertCount = Alert::getAlertCountByStore($storeNumber);

        $i = 0;
        foreach($alerts as $a){
            $doc = Document::getDocumentById($a->document_id);
            $alertType = AlertType::find($a->alert_type_id);

            switch($doc->original_extension){

                case "pdf":
                    $alerts[$i]->icon = "<i class='fa fa-file-pdf-o'></i>";
                    break;

                case "xls":
                case "xlsx":
                    $alerts[$i]->icon = "<i class='fa fa-file-excel-o'></i>";
                    break;

                case "doc":
                    $alerts[$i]->icon = "<i class='fa fa-file-word-o'></i>";
                    break;

                case "mp4":
                case "mov":
                case "avi":
                    $alerts[$i]->icon = "<i class='fa fa-film'></i>";
                    break;

                default:
                    $alerts[$i]->icon = "<i class='fa fa-file-o'></i>";
                    break;

            }

            $alerts[$i]->title = $doc->title;
            $alerts[$i]->filename = $doc->filename;
            $alerts[$i]->description = $doc->description;
            $alerts[$i]->original_extension = $doc->original_extension;
            $alerts[$i]->alertTypeName = $alertType->name;
            $i++;
        }        

        $i = 0;
        foreach($alertTypes as $at){
            $alertTypes[$i]->count = Alert::getAlertCountByCategory($storeNumber, $at->id);
            $i++;
        }        
    
        return view('site.alerts.index')
            ->with('skin', $skin)
            ->with('communicationCount', $communicationCount)
            ->with('alerts', $alerts)
            ->with('alertTypes', $alertTypes)
            ->with('alertCount', $alertCount)
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
