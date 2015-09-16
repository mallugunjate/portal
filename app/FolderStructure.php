<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolderStructure extends Model
{
    protected $table = 'folder_struct';
    protected $fillable = array('parent', 'child');

    public static function getChildern($id)
    {
    	$childern = FolderStructure::where('parent', $id)->get();
    	return $childern;
    }	
}
