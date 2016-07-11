<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserSelectedBanner;
use App\Models\Banner;
use App\Models\StoreInfo;
use App\Models\Video\Tag;
use App\Models\Video\Video;

class VideoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        var_dump('show all videos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();     
        $packageHash = sha1(time() . time());
        
        return view('admin.video.video-manager.video-upload')
            ->with('packageHash', $packageHash)
            ->with('banner', $banner)
            ->with('banners', $banners); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Video::storeVideo($request);
    }
    /**
     * Show form to updata meta data for specific group of files.
     *
     * @param  Request $request
     * @return Response
     */
    public function showMetaDataForm(Request $request)
    {
        $package = $request->get('package');

        $banner = UserSelectedBanner::getBanner();
        
        $banners = Banner::all();
        
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        
        $videos = Video::where('upload_package_id', $package)->get();

        return view('admin.video.video-manager.video-add-meta-data')
                ->with('videos', $videos)
                ->with('banner', $banner)
                ->with('banners', $banners)
                ->with('tags', $tags);
            
    }    

    /**
     * Updata meta data for specific files.
     *
     * @param  Request $request
     * @return Response
     */
    public function updateMetaData(Request $request)
    {
        Document::updateMetaData($request);
    }       

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        var_dump('show video');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        var_dump('edit video');
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
