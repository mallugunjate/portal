<?php

namespace App;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\FolderStructure;


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

        \DB::table('folder_ids')->insert([
                'folder_id'    => $folder->id,
                'folder_type'  => 'folder' 
            ]);

        return $banner_id; 
    }

    public static function deleteFolder($id)
    {
        
        $banner_id = Folder::find($id)->banner_id;

        $files = FileFolder::where('folder_id', $id)->get();

        if (count($files)>0) {
            foreach ($files as $file) {
                Document::where('id', $file->document_id)->delete();
                unlink(public_path()."/files/".$file->filename);
            }  
            FileFolder::where('folder_id', $id)->delete();
        }

        $parentChildStructure = FolderStructure::where('child', $id)->first();
        
        if(isset($parentChildStructure)) {
            $parent = Folder::where('id', $parentChildStructure->parent)->first();
            $parent["has_child"] = 0;
            $parent->save();
            $parentChildStructure->delete();
    
        }
        
        $folder = Folder::find($id)->delete();  

        \DB::table('folder_ids')->where('folder_id', $id)->where('folder_type', 'folder')->delete();

        return $banner_id;
        
    }

    public static function getFolderDetails($id)
    {
        
        $folder = Folder::find($id);
        
        $params = [];
        if ($folder->has_child == 1) {

            
            if ($folder->has_weeks == 1) {
                $params = ["param_name" => "has_weeks", "param_value" => true];
            }
            else{
                $child_folders = [];
                $children = FolderStructure::where('parent', $folder->id)->get();
                foreach ($children as $child) {
                    $child_folders[$child->child] = Folder::find($child->child);   
                }
                $params = [ "param_name"=>"has_children", "param_value"=>$child_folders];
            }
            
        }
        else {
            $documents = FileFolder::where('folder_id', $folder->id)->get();
            if (count($documents) >0) {
                $params = ["param_name" =>"has_documents", "param_value" => true];
            } 
        }
        return ( $params );
        
    }


    public static function editFolderDetails($params)
    {
        
        $folder = Folder::find($params["id"]);

        $update = [];
        $update ["name"] = $params["name"] ;
        

        //add child
        if (isset($params["children"])) {
            $update["has_child"] = 1;
            Folder::createChildren($params["children"], $folder);
        }

        //add weeks
        elseif (isset($params["weekWindowSize"])) {
            $update = [
                'has_weeks' => 1,
                'week_window_size' => $params["weekWindowSize"],
                'has_child' => 1                
            ];
        }

        //remove weeks
        elseif (isset($params["removeWeeks"])) {
            Folder::removeWeeks($params["id"]);
            $update = [
                'has_weeks' => 0,
                'week_window_size' => 0,
                'has_child' => 0                
            ];      
        }


        $folder->update($update);   
        $banner_id = $folder->banner_id;

        return $banner_id;
    }



    public static function createChildren($children, $parent)
    {
        foreach ($children as $child) {
                $folder = Folder::create([
                        'name' => $child,
                        'is_child' => 1,
                        'banner_id'=>$parent->banner_id
                    ]);
                FolderStructure::create([
                        'parent' => $parent->id,
                        'child'  => $folder->id
                    ]);
                \DB::table('folder_ids')->insert([
                    'folder_id'    => $folder->id,
                    'folder_type'  => 'folder' 
                ]);
            }
    }

    public static function removeWeeks($id)
    {
        $weeks = Week::where('parent_id',$id)->get();
            foreach ($weeks as $week) {
                
                //delete documentsin folder
                $documentsInFolder = FileFolder::where('folder_id', $week->id)->get();
                if ($documentsInFolder) {
                    foreach ($documentsInFolder as $doc) {
                        Document::where('id', $doc->document_id)->delete();
                        FileFolder::where('folder_id', $doc->folder_id)->delete();
                    }
                }
                //delete week folders
                Week::where('id', $week->id)->delete();
                \DB::table('folder_ids')->where('folder_id', $week->id)->where('folder_type', 'week')->delete();
                unset($documentsInFolder);
            }
    }
}
