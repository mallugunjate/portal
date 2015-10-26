<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FolderStructure extends Model
{
    protected $table = 'folder_struct';
    protected $fillable = array('parent', 'child');

    	
    public static function getNavigationStructure($banner_id = null)
    {
    	if (! $banner_id == null ) {
            $rootFolders = Folder::where('is_child', 0)
                                ->where('banner_id', $banner_id)
                                ->orderBy('name', 'desc')
                                ->get();
        }
        else{
            $rootFolders = Folder::where('is_child', 0)
                                ->orderBy('name', 'desc')
                                ->get();
        }

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

            $parentNode = FolderStructure::where('child', $currentNode->id)->first();

            if (! $parentNode == null ) {
                $navigation[$currentNode->id]["parent_id"] = $parentNode->parent;
            }
            else {
                $navigation[$currentNode->id]["parent_id"] = null;
            }

            $childNodes = FolderStructure::where('parent', $currentNode->id)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
            
            
            if ( !$childNodes->isEmpty()) {
                        
                $counter = 0;
                $children = [];
                foreach ($childNodes as $childNode) {
                   $child = Folder::where('id', $childNode->child)->first();
                   array_push($children, $child);
                }
               
               usort($children, function($a, $b)
                {
                    return strcmp($a->name, $b->name);
                });

               foreach ($children as $child) {
                   $nav->push($child);
                   $navigation[$currentNode->id]["children"][$counter] = [];
                   $navigation[$currentNode->id]["children"][$counter]["child_id"] = $child->id;
                   $counter++;
               }
               unset($children);
                
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
        return  ( $navigation);
    }

    

    public static function getWeekWindow($parent_id, $windowSize)   
    {
        Week::generateWeekFolders($parent_id);
        $currentWeek = Week::getCurrentWeek($parent_id);

        $weekWindow = Week::getWeekWindow($currentWeek, $windowSize);
        return ($weekWindow);
        
    }

    public static function createFolderStructure(Request $request)
    {   
        $relationshipdetails = array(
            'parent' => $request->get('parent'),
            'child' => $request->get('child')
        );

        $folderstruct = FolderStructure::create($relationshipdetails);
        $folderstruct->save();

        $parent = Folder::find($request->get('parent'));
        $parent["has_child"] = 1;
        $parent->save();

        return;
    }
    
}
