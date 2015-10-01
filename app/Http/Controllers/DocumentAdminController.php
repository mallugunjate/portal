<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Document;
use App\Folder;
use App\FileFolder;
use App\FolderStructure;

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

        $navigation = FolderStructure::getNavigationStructure($banner_id);

        $packageHash = sha1(time() . time());
        $folders = Folder::all();

        return view('admin.view-document-structure')
            ->with('navigation', $navigation)
            ->with('folders', $folders)
            ->with('packageHash', $packageHash);
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

        $documents = Document::where('upload_package_id', $package)->get();

       return view('admin.add-document-meta-data')
             ->with('documents', $documents);
            
    }    

    /**
     * Updata meta data for specific files.
     *
     * @param  Request $request
     * @return Response
     */
    public function updateMetaData(Request $request)
    {
        $file_id = $request->get('file_id');
        $title = $request->get('title');
        $description = $request->get('description');

        $metadata = array(
            'title' => $title,
            'description' => $description
        );

        $document = Document::find($file_id);
        $document->update($metadata);

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
