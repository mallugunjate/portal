<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Document\FileFolder;
use App\Models\Document\Package;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;

class CommunicationController extends Controller
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

        // $id = $request->get('id');
        // $storeno = $request->get('storeNumber');
        // $banner = $request->get('storeBanner');


        $communications = Communication::where('banner_id', $banner->id)->get();
        return view('site.communications.index')
            ->with('communications', $communications);
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
    public function show($sn, $id)
    {
        $communication = Communication::find($id);
        $tag_ids = ContentTag::where('content_id', $id)->where("content_type", "communication")->get()->pluck("tag_id");
        $tags = Tag::findmany($tag_ids);
        return view('site.communications.message')
            ->with('communication', $communication)
            ->with('tag_ids', $tag_ids)
            ->with('tags', $tags);
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
