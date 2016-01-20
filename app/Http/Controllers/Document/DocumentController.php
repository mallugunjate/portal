<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\Folder;
use App\Models\Document\FolderStructure;
use App\Models\Document\Week;
use App\Models\Document\FileFolder;
use App\Models\Document\Document;
use App\Models\Banner;
use App\Models\Document\Package;

use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationTarget;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $storeNumber = RequestFacade::segment(1);

        $communicationCount = DB::table('communications_target')
            ->where('store_id', $storeNumber)
            ->whereNull('is_read')
            ->count();        

        $banner_id = $request->get('banner_id');

        if(isset($banner_id)) {
            
            $banner = Banner::where('id', $banner_id)->first();
        }
        else{
            $banner = Banner::where('id', 1)->first();
        }

        $navigation = FolderStructure::getNavigationStructure($banner->id);

        $packages = Package::getAllPackages($banner->id);

        $folders = Folder::all();

        $defaultFolder = $request->get('parent');

        if (!isset($defaultFolder)) {
            $defaultFolder = null;
        }

        return view('site.documents.index')
            ->with('navigation', $navigation)
            ->with('folders', $folders)
            ->with('banner', $banner)
            ->with('packages', $packages)
            ->with('communicationCount', $communicationCount)
            ->with('defaultFolder' , $defaultFolder);


        // $banner_id  = $request->get('banner_id');
        // if (isset($banner_id)) {
        //     $banner = Banner::where('id', $banner_id)->first();
        // }
        // else {
        //     $banner = Banner::where('id', 1)->first();
        // }  

        // $navigation = FolderStructure::getNavigationStructure($banner->id);
        // return view('site.documents.index')
        //     ->with('navigation', $navigation)
        //     ->with('banner', $banner);        

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
