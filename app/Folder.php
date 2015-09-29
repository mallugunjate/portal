<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folders';
    protected $fillable = array('name' , 'is_child', 'has_weeks', 'week_window_size');

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
}
