<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Log;


class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = ['name', 'background'];

    public static function updateBannerBackground($id, $request)
    {
        $file = $request->file('background');
        $directory = public_path() . '/images/dashboard-banners';
		$extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $modifiedName = str_replace(" ", "_", $originalName);
        $modifiedName = str_replace(".", "_", $modifiedName);
		$uniqueHash = sha1(time() . time());
        $filename  = $modifiedName . "_" . $uniqueHash . "." . $extension;
		$upload_success = $file->move($directory, $filename); //move and rename file

    	 $banner = Banner::find($id);
    	 $banner->background =$filename;
    	 $banner->save();
    }


    public static function getBannerBackground($id)
    {
    	$banner = Banner::find($id);
    	return $banner->background;
    }

    public static function updateBannerInfo($id,Request $request)
    {
        \Log::info($request->all());
        $requestType = $request->request_type;
        if ($requestType == 'updateNotificationPreference') {
            return Banner::updateNotificationPreference($id, $request);
        }
        else if($requestType == 'updateTitle') {
            return Banner::updateTitle($id, $request);
        }
    }

    public static function updateNotificationPreference($id, Request $request)
    {
        $update_type_id = $request->update_type;
        $update_window_size = $request->update_frequency;

        $banner = Banner::find($id);
        $banner['update_type_id'] = $update_type_id;
        $banner['update_window_size'] = $update_window_size;
        $banner->save();

        return $banner;

    }

    public static function updateTitle($id,Request $request)
    {
        $title = $request->title;
        $subtitle = $request->subtitle;

        $banner = Banner::find($id);
        $banner['title'] = $title;
        $banner['subtitle'] = $subtitle;
        $banner->save();

        return $banner;

    }
}
