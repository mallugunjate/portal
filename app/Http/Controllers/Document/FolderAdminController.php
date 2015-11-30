<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Folder;
use App\FolderStructure;
use App\Week;
use App\FileFolder;
use App\Document;
use App\Banner;

class FolderAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $banner_id = $request->get('banner_id');

        if (isset($banner_id)) {
            $banner = Banner::where('id', $banner_id)->first();
        }
        else{
            $banner = Banner::where('id' , 1);
        }
        return view('admin.create-folder')->with('banner', $banner);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
            
        $banner_id = Folder::storeFolder($request);
        return redirect()->action('Document\FolderStructureAdminController@index', ['banner_id' => $banner_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $folder_id = \DB::table('folder_ids')->where('id', $id)->first()->folder_id;
        
        $folder = Folder::find($folder_id);

        $params =  Folder::getFolderDetails($id);
        
        $banner_id = $request->get('banner_id');
        if (isset($banner_id)) {
            $banner = Banner::find($banner_id);
        }
        else {
            $banner = Banner::find(1);
        }
        return view('admin.folder-edit')->with('folder', $folder)
                                        ->with('params', $params)
                                        ->with('banner', $banner);
        
        
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
        
        $name = $request->get('name');
        $children = $request->get('child');
        $weekWindowSize = $request->get('weekWindowSize');
        $removeWeeks = $request->get('removeWeeks');
        

        $banner_id = Folder::editFolderDetails(compact('id', 'name', 'children', 'weekWindowSize', 'removeWeeks'));

        return redirect()->action('Document\FolderStructureAdminController@index', ['banner_id'=> $banner_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $children = FolderStructure::where('parent', $id)->get();
        if (count($children)) {
            return "Delete inner Folders first";
        }
        $banner_id = Folder::deleteFolder($id);
        return $banner_id;
    }
}
