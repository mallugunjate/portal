<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Document\FolderStructure;
use App\Models\Document\Folder;
use App\Models\Document\Package;
use App\Models\Communication\Communication;
use App\User;
use App\Models\UserBanner;

class AdminController extends Controller
{
    
    private $group_id;
    private $user_id;
     /**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
        $this->user_id = \Auth::user()->id;
        $this->group_id = \Auth::user()->group_id;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $banner_id = $request->get('banner_id');

        // if(isset($banner_id)) {
            
        //     $banner = Banner::where('id', $banner_id)->first();
        // }
        // else{
        //     $banner = Banner::where('id', 1)->first();
        // }

        $banner_id = $request->session()->get('banner_id');

        \Log::info('banner id Admin Controller : ' . $banner_id);

        $banner  = Banner::find($banner_id);

        $navigation = FolderStructure::getNavigationStructure($banner->id);

        $packages = Package::getAllPackages($banner->id);

        $packageHash = sha1(time() . time());

        $folders = Folder::all();

        $defaultFolder = $request->get('parent');

        if (!isset($defaultFolder)) {
            $defaultFolder = null;
        }


        if ($this->group_id == 1) {


            $banners = Banner::all();
            $admin_users = User::whereIn('group_id',[1,2])->get();
            $navigation = FolderStructure::getNavigationStructure($banner->id);
            return view('superadmin.home')->with('banners', $banners)
                                                ->with('admin_users', $admin_users)
                                                ->with('navigation', $navigation) 
                                                ->with('folders', $folders)
                                                ->with('packageHash', $packageHash)
                                                ->with('banner', $banner)
                                                ->with('packages', $packages)
                                                ->with('defaultFolder' , $defaultFolder);
        }
        else if ($this->group_id == 2) {

            $banner_ids = UserBanner::where('user_id', $this->user_id)->get()->pluck('banner_id');
            $banners = Banner::whereIn('id', $banner_ids)->get();
            
            return view('admin.document-view')
                ->with('navigation', $navigation)
                ->with('folders', $folders)
                ->with('packageHash', $packageHash)
                ->with('banner', $banner)
                ->with('banners', $banners)
                ->with('packages', $packages)
                ->with('defaultFolder' , $defaultFolder);
        }
        
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
    public function show($id)
    {
        //
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
