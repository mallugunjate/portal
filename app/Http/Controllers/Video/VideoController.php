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

        $this->communicationCount = DB::table('communications_target')
            ->where('store_id', $this->storeNumber)
            ->whereNull('is_read')
            ->count();

        $this->urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($this->storeNumber);

        $this->alertCount = Alert::getActiveAlertCountByStore($this->storeNumber);

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

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */



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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
