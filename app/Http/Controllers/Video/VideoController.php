<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Skin;

use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Alert\Alert;
use App\Models\StoreInfo;

class VideoController extends Controller
{
    private $storeNumber;
    private $storeInfo;
    private $banner;
    private $isComboStore;
    private $skin;
    private $communicationCount;
    private $urgentNoticeCount;
    private $alertCount;

    public function __construct(){
        $this->storeNumber = RequestFacade::segment(1);
        $this->storeInfo = StoreInfo::getStoreInfoByStoreId($this->storeNumber);
        $this->storeBanner = $this->storeInfo->banner_id;
        $this->banner = Banner::find($this->storeBanner);
        $this->isComboStore = $this->storeInfo->is_combo_store;
        $this->skin = Skin::getSkin($this->storeBanner);
        $this->urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($this->storeNumber);
        $this->alertCount = Alert::getActiveAlertCountByStore($this->storeNumber);
        $this->communicationCount = DB::table('communications_target')
            ->where('store_id', $this->storeNumber)
            ->whereNull('is_read')
            ->count();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return view('site.video.index')
            ->with('skin', $this->skin)
            ->with('banner', $this->banner)
            ->with('communicationCount', $this->communicationCount)
            ->with('urgentNoticeCount', $this->urgentNoticeCount)
            ->with('isComboStore', $this->isComboStore);
    }

    public function show($id)
    {
        return view('site.video.singlevideo')
            ->with('skin', $this->skin)
            ->with('banner', $this->banner)
            ->with('communicationCount', $this->communicationCount)
            ->with('urgentNoticeCount', $this->urgentNoticeCount)
            ->with('isComboStore', $this->isComboStore);
    }

    public function showPlaylist($id)
    {
        return view('site.video.playlist')
            ->with('skin', $this->skin)
            ->with('banner', $this->banner)
            ->with('communicationCount', $this->communicationCount)
            ->with('urgentNoticeCount', $this->urgentNoticeCount)
            ->with('isComboStore', $this->isComboStore);
    }

    public function showTag($tag)
    {
        return view('site.video.tag')
            ->with('skin', $this->skin)
            ->with('banner', $this->banner)
            ->with('communicationCount', $this->communicationCount)
            ->with('urgentNoticeCount', $this->urgentNoticeCount)
            ->with('isComboStore', $this->isComboStore);
    }

}
