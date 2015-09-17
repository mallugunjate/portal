<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Document;
use App\Folder;
use App\FileFolder;

class DocumentAdminController extends Controller
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
        $folders = Folder::all();
        return view('admin.document-upload')
            ->with('folders', $folders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $extension = $request->file('document')->getClientOriginalExtension();
        $originalName = $request->file('document')->getClientOriginalName();
        $modifiedName = str_replace(" ", "_", $originalName);
        $modifiedName = str_replace(".", "_", $modifiedName);

        $directory = public_path() . '/files';
        $uniqueHash = sha1(time() . time());
        $filename  = $modifiedName . "_" . $uniqueHash . "." . $extension;

        $upload_success = $request->file('document')->move($directory, $filename); //move and rename file        

        if ($upload_success) {
            $documentdetails = array(
                'filename'          => $filename,
                // 'title'             => $request->get('title'),
                'title' => 'something',
                //'description'       => $request->get('description')
                'description'       => 'who cares'
            );

            $document = Document::create($documentdetails);
            $document->save();
            $lastInsertedId= $document->id;

            $documentfolderdetails = array(
                'document_id' => $lastInsertedId,
                'folder_struct_id' => $request->get('folderselected')
            );
           
            $documentfolder = FileFolder::create($documentfolderdetails);
            $documentfolder->save();
        }

            // $t = "Awesome!";
            // $r = "Your new document has been created! <a href='/admin/photos'>Back to Photos</a>";
            // return view('admin/confirmation')
            //     ->with('response_title', $t)
            //     ->with('response', $r);
            //return "file uploaded";
        // } else {
        //     // $t = "Um...";
        //     // $r = "Something bad happened. <a href='/admin/photos'>Back to Photos</a>";
        //     // return View::make('admin/confirmation')
        //     //     ->with('response_title', $t)
        //     //     ->with('response', $r);
        //     return "it didn't work";
        // }
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
