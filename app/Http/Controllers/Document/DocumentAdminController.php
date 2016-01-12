<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\Document;
use App\Models\Document\Folder;
use App\Models\Document\FileFolder;
use App\Models\Document\FolderStructure;
use App\Models\Banner;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\UserSelectedBanner;

class DocumentAdminController extends Controller
{
    /**
     * Instantiate a new DocumentAdminController instance.
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
        $folder_id = $request->get('folder');
        $documents = Document::getDocuments($folder_id);
        $folder = Folder::getFolderDescription($folder_id);
        $response = [];
        $response["files"] = $documents;
        $response["folder"] = $folder;
        return $response;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();     

        $packageHash = sha1(time() . time());
        $folders = Folder::all();
        return view('admin.document.document-upload')
            ->with('folders', $folders)
            ->with('packageHash', $packageHash)
            ->with('banner', $banner)
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

        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();

        $parent = $request->get('parent');
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        $documents = Document::where('upload_package_id', $package)->get();

        return view('admin.document.document-add-meta-data')
                ->with('documents', $documents)
                ->with('banner', $banner)
                ->with('banners', $banners)
                ->with('folder_id', $parent)
                ->with('tags', $tags);
            
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
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        $tag_ids = ContentTag::where('content_id', $id)->where('content_type', 'document')->get()->pluck('tag_id');
        $selected_tags = Tag::findMany($tag_ids)->pluck('id')->toArray();
        return view('admin.document.document-edit-meta-data')->with('document', $document)
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
        
        Document::updateMetaData($request, $id);
        $parent = FileFolder::where('document_id', $id)->first()->folder_id;
        $banner_id = $request->get('banner_id');
        return redirect()->action('AdminController@index', ['parent'=>$parent]);
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
