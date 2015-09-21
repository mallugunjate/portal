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

    public static function getNavigationStructure()
    {
    	$rootFolders = Folder::where('is_child', 0)->orderBy('id', 'desc')->get();
        $nav = new \SplStack();
        foreach ($rootFolders   as $rootFolder) {
            $nav->push($rootFolder);
        }
        
        $navigation = [];
        $navCounter = 0;

        while (!$nav->isEmpty()) {
            
            $currentNode = $nav->pop();
             
            $navigation[$currentNode->id] =[];
            $navigation[$currentNode->id]["label"] = $currentNode->name;
            $navigation[$currentNode->id]["id"] = $currentNode->id;
            $navigation[$currentNode->id]["is_child"] = $currentNode->is_child;

            $childNodes = FolderStructure::where('parent', $currentNode->id)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
            
            
            if ( !$childNodes->isEmpty()) {
                        
                $counter = 0;
                foreach ($childNodes as $childNode) {

                   $child = Folder::where('id', $childNode->child)->first();
                   
                   $nav->push($child);
                   $navigation[$currentNode->id]["children"][$counter] = [];
                   $navigation[$currentNode->id]["children"][$counter]["child_id"] = $child->id;
                   $counter++;
                }
                
            }
            else{

                $navigation[$currentNode->id] = [];
                $navigation[$currentNode->id]["label"] = $currentNode->name;
                $navigation[$currentNode->id]["id"] = $currentNode->id ;
                $navigation[$currentNode->id]["is_child"] = $currentNode->is_child ;
                $navigation[$currentNode->id]["children"] = [];
            }
            
            $navCounter++;   
        }
        return $navigation;
    }
}
