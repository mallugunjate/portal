<?php

namespace App\Models\Document;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class FolderStructure extends Model
{
    use SoftDeletes;
    protected $table = 'folder_struct';
    protected $fillable = array('parent', 'child');
    protected $dates = ['dates'];
    	
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
             
            $globalFolderId = \DB::table('folder_ids')->where('folder_id', $currentNode->id )
                                                            ->where('folder_type', 'folder')
                                                            ->first()->id;
                                                             
            $navigation[$globalFolderId] =[];
            $navigation[$globalFolderId]["label"] = $currentNode->name;
            $navigation[$globalFolderId]["id"] = $globalFolderId;

            $navigation[$globalFolderId]["is_child"] = $currentNode->is_child;

            $parentNode = FolderStructure::where('child', $currentNode->id)->first();

            if (! $parentNode == null ) {
                $navigation[$globalFolderId]["parent_id"] = $parentNode->parent;
            }
            else {
                $navigation[$globalFolderId]["parent_id"] = null;
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
                   $navigation[$globalFolderId]["children"][$counter] = [];
                   $globalChildId = \DB::table('folder_ids')->where('folder_id', $child->id )
                                                            ->where('folder_type', 'folder')
                                                            ->first()->id;
                   $navigation[$globalFolderId]["children"][$counter]["child_id"] = $globalChildId;
                   $counter++;
               }
               unset($children);
                
            }
            else{
                
                $navigation[$globalFolderId]["children"] = [];
            }

            if ($currentNode->has_weeks) {
                $windowSize = $currentNode->week_window_size;
                $weekWindow = FolderStructure::getWeekWindow($globalFolderId, $windowSize);
                $counter = 0;
                foreach ($weekWindow as $week) {
                   
                   $navigation[$globalFolderId]["weeks"][$counter] = [];
                   $navigation[$globalFolderId]["weeks"][$counter]["week_id"] = $week->id;
                   $navigation[$globalFolderId]["weeks"][$counter]["week"]= $week->week_number;
                   $navigation[$globalFolderId]["weeks"][$counter]["global_id"] = \DB::table('folder_ids')->where('folder_id', $week->id )
                                                                                                        ->where('folder_type', 'week')
                                                                                                        ->first()->id;
                   $counter++;
                }
            }
            
            $navCounter++;   
        }
        return  ( $navigation );
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
