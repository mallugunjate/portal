<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
// use Years; 

class FolderStructure extends Model
{
    protected $table = 'folder_struct';
    protected $fillable = array('parent', 'child');

    	
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

            if ($currentNode->has_weeks) {
                $windowSize = $currentNode->week_window_size;
                $weekWindow = FolderStructure::getWeekWindow($currentNode->id, $windowSize);
                $counter = 0;
                foreach ($weekWindow as $week) {
                   
                   $navigation[$currentNode->id]["weeks"][$counter] = [];
                   $navigation[$currentNode->id]["weeks"][$counter]["week_id"] = $week->id;
                   $navigation[$currentNode->id]["weeks"][$counter]["week"]= $week->week_number;
                   $counter++;
                }
            }
            
            $navCounter++;   
        }
        return ( $navigation);
    }

    

    public static function getWeekWindow($parent_id, $windowSize)   
    {
        Week::generateWeekFolders($parent_id);
        $currentWeek = Week::getCurrentWeek($parent_id);

        $weekWindow = Week::getWeekWindow($currentWeek, $windowSize);
        return ($weekWindow);
        
    }
}
