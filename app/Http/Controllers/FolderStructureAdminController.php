<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Folder;
use App\FolderStructure;

class FolderStructureAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $folders = Folder::all();
       
        $folderStruct = FolderStructure::all();
        return view('admin.view-folder-structure')
            ->with('folders', $folders)
            ->with('folderStruct', $folderStruct);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $folders = Folder::getFolders();
        return view('admin.define-folder-relationship')
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
            $relationshipdetails = array(
                'parent' => $request->get('parent'),
                'child' => $request->get('child')
            );

            $folderstruct = FolderStructure::create($relationshipdetails);
            $folderstruct->save();

            return "Relationship established: '" . $request->get('child') . "' is child of '" . $request->get('parent') . "'.";
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
