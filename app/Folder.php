<?php

namespace App;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folders';
    protected $fillable = array('name' , 'is_child', 'has_weeks', 'week_window_size', 'banner_id', 'has_child');

    public static function getFolders()
    {
    	$folders = Folder::all();
        return $folders;
    }

    public static function getFolderName($id)
    {
    	$folder = Folder::find($id);
    	return $folder->name;
    }

    public static function storeFolder(Request $request)
    {
        $is_child = 0; 
        $banner_id = 0; 
        if ( null !==  $request->get('subfolder')) {
            $is_child = $request->get('subfolder');
            $banner_id = $request->get("banner_id");
        }

        $has_weeks = 0;
        $week_window_size = 0;
        $has_child = 0;
        if ( null !==  $request->get('has_weeks')) {
            $has_weeks = $request->get('has_weeks');
            $week_window_size = $request->get('week_window_size');
            $has_child = 1;

        }

        $banner_id = 1;
        if ( null !==  $request->get('banner_id')) {
            $banner_id = $request->get('banner_id');
        }            

        $folderdetails = array(
            'name'      => $request->get('foldername'),
            'is_child'  => $is_child,
            'banner_id' => $banner_id,
            'has_weeks' => $has_weeks,
            'week_window_size' =>$week_window_size,
            'has_child'  => $has_child


        );

        // dd($folderdetails);
        $folder = Folder::create($folderdetails);
        $folder->save();

        return; 
    }
}
