<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\FolderStructure;

class FileFolder extends Model
{
    protected $table = 'file_folder';
    protected $fillable = array('document_id', 'folder_id');

    public static function getFileFolderStructure($banner_id)
    {	
    	$folderStructure = FolderStructure::getNavigationStructure($banner_id);
        $documents = Document::where('banner_id', $banner_id)->get();
        foreach ($documents as $document) {
            
            $parent_folder_id = FileFolder::where('document_id', $document->id)->first()->folder_id;
            if (isset($folderStructure[$parent_folder_id]["documents"])) {
                array_push($folderStructure[$parent_folder_id]["documents"], $document);
            }    
            else {
                $folderStructure[$parent_folder_id]["documents"] = array();
                $folderStructure[$parent_folder_id]["documents"][0] = $document;
            }
        }
       return ($folderStructure);
    }
}
