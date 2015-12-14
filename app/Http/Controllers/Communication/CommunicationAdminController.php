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
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;

class CommunicationAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banner_id = $request['banner_id'];
        if (isset($banner_id)) {
            $banner = Banner::where('id', $banner_id)->first();
        }
        else {
            $banner = Banner::find(1);
        }
        $communications = Communication::getAllCommunication($request["banner_id"]);
        return view('admin.communication.index')->with('communications', $communications)
                                                ->with('banner', $banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $banner_id = $request['banner_id'];
        if (isset($banner_id)) {
            $banner = Banner::find($banner_id);
        }
        else {
            $banner = Banner::find(1);
        }
    
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        
        $packages = Package::getPackagesStructure($banner->id);
        $importance = \DB::table('communication_importance_levels')->lists('name', 'id');
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        return view('admin.communication.create')->with('banner', $banner)
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
        return redirect()->action('AdminController@index', ['banner_id' => $request["banner_id"]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $banner_id = $request["banner_id"];
        if (isset($banner_id)) {
            $banner = Banner::find($banner_id);
        }
        else{
            $banner = Banner::find(1);
        }


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
        $banner_id = $request["banner_id"];
        if (isset($banner_id)) {
            $banner = Banner::find($banner_id);
        }
        else{
            $banner = Banner::find(1);
        }


        $communication = Communication::find($id);
        $communication_documents  = Communication::getDocumentDetails($id);
        $communication_packages  = Communication::getPackageDetails($id);
        
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner_id);
        $packages = Package::getPackagesStructure($banner_id);
        $importance = \DB::table('communication_importance_levels')->lists('name', 'id');
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        $tag_ids = ContentTag::where('content_id', $id)->where('content_type', 'communication')->get()->pluck('tag_id');
        $selected_tags = Tag::findMany($tag_ids)->pluck('id')->toArray();

        return view('admin.communication.edit')->with('communication', $communication)
                                            ->with('communication_packages', $communication_packages)
                                            ->with('communication_documents', $communication_documents)
                                            ->with('importance', $importance)
                                            ->with('banner', $banner)
                                            ->with('navigation', $fileFolderStructure)
                                            ->with('packages', $packages)
                                            ->with('tags', $tags)
                                            ->with('selected_tags', $selected_tags);
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
        return redirect()->action('AdminController@index', ['banner_id' => $request["banner_id"]]);
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
        // Communication::find($id)->delete();
        // CommunicationPackage::where('communication_id', $id)->delete();
        // CommunicationDocument::where('communication_id', $id)->delete();
        return;

    }
}
