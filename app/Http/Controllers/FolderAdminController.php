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
        $child_folders = [];
        if ($folder->has_child == 1) {
            $children = FolderStructure::where('parent', $folder->id)->get();
            foreach ($children as $child) {
                $child_folders[$child->child] = Folder::find($child->child);
            }
            
            if ($folder->has_weeks == 1) {
                return view('admin.folder-edit')->with('folder', $folder)
                                                ->with('children', $children)
                                                ->with('child_folders', $child_folders)
                                                ->with('has_weeks', true);
            }
            return view('admin.folder-edit')->with('folder', $folder)
                                            ->with('children', $children)
                                            ->with('child_folders', $child_folders);
        }
        
        
        return view('admin.folder-edit')->with('folder', $folder);
        
        
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
        // dd($request->all());
        $name = $request->get('name');
        
        $update = [
            'name' => $name
        ];
        $folder = Folder::find($id);
        $folder->update($update);

        //add child
        $children = $request->get('child');
        if (isset($children)) {
            foreach ($children as $child) {
                $folder = Folder::create([
                        'name' => $child,
                        'is_child' => 1,
                        'banner_id'=>$folder->banner_id
                    ]);
                FolderStructure::create([
                        'parent' => $id,
                        'child'  => $folder->id
                    ]);
            }
        }
        //add weeks
        $week_window_size = $request->get("week_window_size");
        if (isset($week_window_size)) {
            $update = [
                'has_weeks' => 1,
                'week_window_size' => $week_window_size,
                'has_child' => 1                

            ];
            $folder->update($update);
        }

        //remove weeks
        $removeWeeks = $request->get('removeWeeks');
        if (isset($removeWeeks)) {
            //delete week folder
            $weeks = Week::where('parent_id',$id)->get();
            foreach ($weeks as $week) {
                $documentsInFolder = FileFolder::where('folder_id', $week->id)->get();
                if ($documentsInFolder) {
                    foreach ($documentsInFolder as $doc) {
                        Document::where('id', $doc->document_id)->delete();
                        FileFolder::where('folder_id', $doc->folder_id)->delete();
                    }
                }
                Week::where('id', $week->id)->delete();
                unset($documentsInFolder);
            }
            //update folders table
            $update = [
                'has_weeks' => 0,
                'week_window_size' => 0,
                'has_child' => 0                

            ];
            $folder->update($update);
        }

        

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
