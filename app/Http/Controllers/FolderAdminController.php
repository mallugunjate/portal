<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Folder;
use App\FolderStructure;
use App\Week;
use App\FileFolder;
use App\Document;

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
    public function create()
    {
        return view('admin.create-folder');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
            
        Folder::storeFolder($request);
        return "Folder '" . $request->get('foldername') . "' created";

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
    public function edit($id)
    {
        $folder = Folder::find($id);
        $params =  Folder::getFolderDetails($id);
        
        return view('admin.folder-edit')->with('folder', $folder)
                                        ->with('params', $params);
        
        
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
        

        $editFolder = Folder::editFolderDetails(compact('id', 'name', 'children', 'weekWindowSize', 'removeWeeks'));

        return redirect()->action('FolderStructureAdminController@index');
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
        $deleteFolder = Folder::deleteFolder($id);
        // return "hello";
        return $deleteFolder;
    }
}
