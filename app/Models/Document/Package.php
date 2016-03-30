<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Document\Document;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\UserSelectedBanner;
use App\Models\Utility\Utility;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;
 
    protected $table = 'packages';

    protected $fillable = ['id', 'package_screen_name', 'package_name', 'is_hidden', 'start', 'end', 'banner_id'];

    protected $dates = ['deleted_at'];
    
    public static function storePackage(Request $request)
    {   
        \Log::info( $request->all() );
        $documents = $request["package_files"];
    	$folders = $request["package_folders"];
        $package_screen_name = $request["title"];
    	// $package_name = preg_replace('/\s+/', '_' , $package_screen_name);
        $package_name = $request["name"];
    	// $timestamp = sha1(time()*time());
    	// $package_name .= "_".$timestamp ;
    	
        $banner = UserSelectedBanner::getBanner();

    	$package = Package::create([
    			'package_screen_name' 	=> $package_screen_name,
    			'package_name'			=> $package_name,
    			'banner_id'				=> $banner->id,
                // 'start'                 => $start,
                // 'end'                   => $end,
                // 'is_hidden'             => $is_hidden
    		]);

    	$package_id = $package->id;

        if(isset($documents)) {
            foreach ($documents as $document) {
                DocumentPackage::create([
                    'document_id'   => intval($document),
                    'package_id'    => $package_id  
                ]);
            
            }    
        }
        if (isset($folders)) {
            foreach ($folders as $folder) {
                FolderPackage::create([
                    'folder_id'   => intval($folder),
                    'package_id'    => $package_id  
                ]);        
            }
        }
        
    	
        // Package::updateTags($package_id, $request['tags']);
    	return;
    }

    public static function getAllPackages($banner_id)
    {
    	$packages = Package::where('banner_id', $banner_id)->get();
    	return $packages;
    }

    public static function getPackageDetails($id)
    {
        $package = Package::find($id);
        $package["package_documents"] = Package::getPackageDocumentDetails($id);
        $package["package_folders"] = Package::getPackageFolderDetails($id);
        // $package['package_folder_tree']= [];
        
        $tree = Array();

        foreach ($package['package_folders'] as $folderRoot) {
            $root_id = $folderRoot['global_folder_id'];
            $tree[$root_id] = Folder::getFolderChildrenTree($folderRoot['global_folder_id']);
            // array_merge_recursive( $package['package_folder_tree'], [$root_id => $tree]);

            
        }
        $package['package_folder_tree'] = $tree;
        return $package;
    }

    public static function getPackageDocumentDetails($id)
    {

    	$document_package_list = DocumentPackage::where('package_id', $id)->get();
    	$documents = [];
    	foreach ($document_package_list as $list_item) {
    		$document = Document::where('id', $list_item->document_id)->first();
    		$path = Document::getFolderPathForDocument($document->id); 
    		$document["folder_path"] = $path;
            $document->link = Utility::getModalLink($document->filename, $document->title, $document->original_extension, 0);
            $document->link_with_icon = Utility::getModalLink($document->filename, $document->title, $document->original_extension, 1);
            $document->icon = Utility::getIcon($document->original_extension);
            $document->prettyDate = Utility::prettifyDate($document->start);
            $document->since = Utility::getTimePastSinceDate($document->start);
    		array_push($documents, $document);
    	}
    	return ( $documents );
    }

    public static function updatepackage(Request $request, $id)
    {
        // dd($request->all());
        $package = Package::find($id);
        $package["package_screen_name"] = $request["title"];
        $package["package_name"] = $request["name"];
        
        $package->save();

        $remove_documents = $request["remove_document"];    
        if (isset($remove_documents)) {
            foreach ($remove_documents as $remove) {
               DocumentPackage::where('package_id',$id)->where('document_id', intval($remove))->delete();
            }
        }
        

        $add_documents = $request["package_files"];
        if (isset($add_documents)) {
            foreach ($add_documents as $add) {
                DocumentPackage::create([
                    'document_id'   => intval($add),
                    'package_id'    => $id    
                ]);
            }
        }

        $remove_folders = $request["remove_folder"];    
        if (isset($remove_folders)) {
            foreach ($remove_folders as $remove_folder) {
                \Log::info($remove_folder);
               FolderPackage::where('package_id', $id)->where('folder_id', intval($remove_folder))->delete();
            }
        }
        

        $add_folders = $request["package_folders"];
        if (isset($add_folders)) {
            foreach ($add_folders as $add) {
                FolderPackage::create([
                    'folder_id'   => intval($add),
                    'package_id'    => $id    
                ]);
            }
        }
        // Package::updateTags($id, $request['tags']);
        return;
    }


    public static function updateTags($id, $tags)
    {
        ContentTag::where('content_type', 'package')->where('content_id', $id)->delete();
         foreach ($tags as $tag) {
            ContentTag::create([
               'content_type' => 'package',
               'content_id'      => $id,
               'tag_id'          => $tag
            ]);
         }
         return;
    }

    public static function getPackageFolderDetails($id)
    {
        $folder_package_list = FolderPackage::where('package_id', $id)->get()->pluck('folder_id');
        $folders = [];
        foreach ($folder_package_list as $list_item) {
            $folder_id = \DB::table('folder_ids')->where('id', $list_item)->first()->folder_id;

            $folder = Folder::where('id', $folder_id)->first();
            $path = Folder::getFolderPath($folder_id); 
            $folder["folder_path"] = $path;
            $folder["global_folder_id"] = $list_item;
            array_push($folders, $folder);
        }
        return ( $folders );
    }
}
