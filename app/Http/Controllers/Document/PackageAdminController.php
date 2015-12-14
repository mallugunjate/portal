<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\Document;
use App\Models\Document\FolderStructure;
use App\Models\Document\FileFolder;
use App\Models\Document\Package;
use App\Models\Banner;
use App\Models\Document\DocumentPackage;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
class PackageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banner_id = $request["banner_id"];
        $packages = Package::getPackagesStructure($banner_id);
        return $packages;
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
            $banner = Banner::where('id', $banner_id)->first();
        }
        else {
            $banner = Banner::where('id', 1)->first();
        }  

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        
        return view('admin.package.create')
                    ->with('banner', $banner)
                    ->with('navigation', $fileFolderStructure)
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
        Package::storePackage($request);
        return redirect()->action('AdminController@index', ['banner_id' => $request["banner_id"]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = [];
        $response["package"] = Package::find($id);
        $response["documentDetails"] = Package::getPackageDocumentDetails($id);

        return ($response);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $package = Package::find($id);
        $documentDetails = Package::getPackageDocumentDetails($id);
        $banner_id = $request['banner_id'];
        if (isset($banner_id)) {
            $banner = Banner::where('id', $banner_id)->first();
        }
        else {
            $banner = Banner::where('id', 1)->first();
        }  

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');

        $tag_ids = ContentTag::where('content_id', $id)->where('content_type', 'package')->get()->pluck('tag_id');
        $selected_tags = Tag::findMany($tag_ids)->pluck('id')->toArray();

        return view('admin.package.edit')->with('package', $package)
                                        ->with('documentDetails', $documentDetails)
                                        ->with('banner', $banner)
                                        ->with('navigation', $fileFolderStructure)
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
        Package::updatePackage($request, $id);
        return redirect()->action('AdminController@index', ['banner_id' => $request["banner_id"]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DocumentPackage::where('package_id', $id)->delete();
        Package::find($id)->delete();
        return;
    }
}