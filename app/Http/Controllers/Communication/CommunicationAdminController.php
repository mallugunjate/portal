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
class CommunicationAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $banner_id = $request['banner_id'];
        if (isset($banner_id)) {
            $banner = Banner::find($banner_id);
        }
        else {
            $banner = Banner::find(1);
        }
    
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner_id);
        $packages = Package::getPackagesStructure($banner_id);
        $importance = \DB::table('communication_importance_levels')->lists('name', 'id');
        return view('admin.communication.create')->with('banner', $banner)
                                                ->with('importance', $importance)
                                                ->with('navigation', $fileFolderStructure)
                                                ->with('packages', $packages);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Communication::storeCommunication($request);
        action('AdminController@index', ['banner_id', $request["banner_id"]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $communication = Communication::find($id);
        $communication_documents  = CommunicationDocument::where('communication_id', $id)->get();
        $communication_packages  = CommunicationPackage::where('communication_id',$id)->get();

        $return ;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $banner_id = $request["banner_id"];
        if (isset($banner_id)) {
            $banner = Banner::find($banner_id);
        }
        else{
            $banner = Banner::find(1);
        }


        $communication = Communication::find($id);
        $communication_documents  = CommunicationDocument::where('communication_id', $id)->get();
        $communication_packages  = CommunicationPackage::where('communication_id',$id)->get();
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner_id);
        $packages = Package::getPackagesStructure($banner_id);
        $importance = \DB::table('communication_importance_levels')->lists('name', 'id');

        return view('admin.communication.edit')->with('communication', $communication)
                                            ->with('communication_packages', $communication_packages)
                                            ->with('communication_documents', $communication_documents)
                                            ->with('importance', $importance)
                                            ->with('banner', $banner)
                                            ->with('navigation', $fileFolderStructure)
                                            ->with('packages', $packages);
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
        dd($request->all());
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
