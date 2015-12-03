<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Document\FolderStructure;
use App\Models\Document\Folder;
use App\Models\Document\Package;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banner_id = $request->get('banner_id');

        if(isset($banner_id)) {
            
            $banner = Banner::where('id', $banner_id)->first();
        }
        else{
            $banner = Banner::where('id', 1)->first();
        }

        $navigation = FolderStructure::getNavigationStructure($banner->id);

        $packages = Package::getAllPackages($banner->id);

        $packageHash = sha1(time() . time());

        $folders = Folder::all();

        $defaultFolder = $request->get('parent');

        if (!isset($defaultFolder)) {
            $defaultFolder = null;
        }

        return view('admin.document-view')
            ->with('navigation', $navigation)
            ->with('folders', $folders)
            ->with('packageHash', $packageHash)
            ->with('banner', $banner)
            ->with('packages', $packages)
            ->with('defaultFolder' , $defaultFolder);
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
