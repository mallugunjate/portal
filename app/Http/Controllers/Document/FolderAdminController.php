<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\Folder;
use App\Models\Document\FolderStructure;
use App\Models\Document\Week;
use App\Models\Document\FileFolder;
use App\Models\Document\Document;
use App\Models\Banner;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\UserSelectedBanner;

class FolderAdminController extends Controller
{
    
    /**
     * Instantiate a new FolderAdminController instance.
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
        $this->middleware('banner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();  

        $navigation = FolderStructure::getNavigationStructure($banner->id);
        return view('admin.folderstructure.index')->with('navigation', $navigation)
                                                     ->with('banner', $banner)
                                                     ->with('banners', $banners);     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();          
        return view('admin.folder.create-folder')->with('banner', $banner)
                                         ->with('banners', $banners);
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

        return redirect()->action('Document\FolderAdminController@index');

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
        
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();

        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        $tag_ids = ContentTag::where('content_id', $id)->where('content_type', 'folder')->get()->pluck('tag_id');
        $selected_tags = Tag::findMany($tag_ids)->pluck('id')->toArray();

        return view('admin.folder.folder-edit')->with('folder', $folder)
                                        ->with('params', $params)
                                        ->with('banner', $banner)
                                        ->with('banners', $banners)
                                        ->with('tags', $tags)
                                        ->with('selected_tags', $selected_tags);
        
        
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
        
        $global_folder_id = \DB::table('folder_ids')->where('folder_id', $id)->where('folder_type', 'folder')->first()->id;
        Folder::updateTags($global_folder_id, $request["tags"]);
        $banner_id = Folder::editFolderDetails(compact('id', 'name', 'children', 'weekWindowSize', 'removeWeeks'));

        return redirect()->action('Document\FolderAdminController@index');
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
        if (count($children)>0) {
            return "Delete inner Folders first";
        }
        Folder::deleteFolder($id);
        return;
    }
}
