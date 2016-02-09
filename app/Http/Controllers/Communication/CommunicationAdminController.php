<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Document\FileFolder;
use App\Models\Document\Package;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationType;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\UserSelectedBanner;
use App\Models\Communication\CommunicationTarget;

class CommunicationAdminController extends Controller
{
    
    /**
     * Instantiate a new CommunicationAdminController instance.
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
        $this->middleware('banner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $communications = Communication::getAllCommunication($banner->id);
        return view('admin.communication.index')->with('communications', $communications)
                                                ->with('banner', $banner)
                                                ->with('banners', $banners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $communicationTypes = CommunicationType::all();
        $packages = Package::where('banner_id',$banner->id)->get();
        $importance = \DB::table('communication_importance_levels')->lists('name', 'id');
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        return view('admin.communication.create')->with('banner', $banner)
                                                ->with('communicationTypes', $communicationTypes)
                                                ->with('banners', $banners)
                                                ->with('importance', $importance)
                                                ->with('navigation', $fileFolderStructure)
                                                ->with('packages', $packages)
                                                ->with('tags', $tags);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Communication::storeCommunication($request);
        return redirect()->action('AdminController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();

        $communication = Communication::find($id);
        $communication_documents  = Communication::getDocumentDetails($id);
        $communication_packages  = Communication::getPackageDetails($id);
        $importance = \DB::table('communication_importance_levels')->lists('name', 'id');
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        $tag_ids = ContentTag::where('content_id', $id)->where('content_type', 'communication')->get()->pluck('tag_id');
        $selected_tags = Tag::findMany($tag_ids)->pluck('id')->toArray();

        return view('admin.communication.view')->with('communication', $communication)
                                            ->with('communication_packages', $communication_packages)
                                            ->with('communication_documents', $communication_documents)
                                            ->with('importance', $importance)
                                            ->with('banner', $banner)
                                            ->with('banners', $banners)
                                            ->with('tags', $tags)
                                            ->with('selected_tags', $selected_tags);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();

        $communication = Communication::find($id);
        $communication_documents  = Communication::getDocumentDetails($id);
        $communication_packages  = Communication::getPackageDetails($id);
        $communication_target_stores = CommunicationTarget::where('communication_id', $id)->get()->pluck('store_id');

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $packages = Package::where('banner_id', $banner->id)->get();
        $importance = \DB::table('communication_importance_levels')->lists('name', 'id');
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        $tag_ids = ContentTag::where('content_id', $id)->where('content_type', 'communication')->get()->pluck('tag_id');
        $selected_tags = Tag::findMany($tag_ids)->pluck('id')->toArray();

        return view('admin.communication.edit')->with('communication', $communication)
                                            ->with('communication_packages', $communication_packages)
                                            ->with('communication_documents', $communication_documents)
                                            ->with('importance', $importance)
                                            ->with('banner', $banner)
                                            ->with('banners', $banners)
                                            ->with('navigation', $fileFolderStructure)
                                            ->with('packages', $packages)
                                            ->with('tags', $tags)
                                            ->with('selected_tags', $selected_tags)
                                            ->with('target_stores', $communication_target_stores);
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
        Communication::updateCommunication($id, $request);
        return redirect()->action('AdminController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Communication::deleteCommunication($id);
        return;

    }
}
