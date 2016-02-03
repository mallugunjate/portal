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
}
