<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folders';
    protected $fillable = array('name');

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
