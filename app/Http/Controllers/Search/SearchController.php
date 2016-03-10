<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\StoreInfo;
use App\Skin;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Utility\Utility;
use App\Models\Search\Search;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = $request['q'];
        $store = RequestFacade::segment(1);
        
        $docs = [];
        $folders = [];
        $communications = [];
        $alerts = [];

        if ( isset($query) && ($query != '')){
            $docs = Search::searchDocuments($query);
            $folders = Search::searchFolders($query);
            $communications = Search::searchCommunications($query, $store);
            $alerts = Search::searchAlerts($query, $store);
        }

        $storeNumber = RequestFacade::segment(1);

        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);

        $storeBanner = $storeInfo->banner_id;

        $skin = Skin::getSkin($storeBanner);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);
        
        return view('site.search.index')
            ->with('skin', $skin)
            ->with('urgentNoticeCount', $urgentNoticeCount)
            ->with('docs', $docs)
            ->with('folders', $folders)
            ->with('communications', $communications)
            ->with('alerts', $alerts)
            ->with('query', $query);
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
