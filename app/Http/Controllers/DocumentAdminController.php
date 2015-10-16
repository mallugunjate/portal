<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Document;
use App\Folder;
use App\FileFolder;
use App\FolderStructure;
use App\Banner;

class DocumentAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
            ->with('defaultFolder' , $defaultFolder);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $packageHash = sha1(time() . time());
        $folders = Folder::all();
        return view('admin.document-upload')
            ->with('folders', $folders)
            ->with('packageHash', $packageHash);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        Document::storeDocument($request);    
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

        $banner_id = $request->get('banner_id');
        if (isset($banner_id)) {
            $banner = Banner::where('id', $banner_id)->first(); 
        }
        else{
            $banner = Banner::where('id', 1)->first();
        }

        $parent = $request->get('parent');

        $documents = Document::where('upload_package_id', $package)->get();

        return view('admin.add-document-meta-data')
             ->with('documents', $documents)
             ->with('banner', $banner)
             ->with('folder_id', $parent);
            
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
        return action('DocumentAdminController@index');

    }       

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Document::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $document = Document::find($id);
        $banner_id = $request->get('banner_id');
        if (isset($banner_id)) {
            $banner = Banner::find($banner_id);
        }
        else {
            $banner = Banner::find(1);
        }
        return view('admin.document-edit-meta-data')->with('document', $document)
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
        
        Document::updateMetaData($request, $id);
        $parent = FileFolder::where('document_id', $id)->first()->folder_id;
        $banner_id = $request->get('banner_id');
        return redirect()->action('DocumentAdminController@index', ['banner_id'=> $banner_id, 'parent'=>$parent]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $deleteDocument = Document::deleteDocument($id);
        return $deleteDocument ;
    }
}
