<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Document\Document;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\UserSelectedBanner;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = ['id', 'package_screen_name', 'package_name', 'is_hidden', 'start', 'end', 'banner_id'];

    public static function storePackage(Request $request)
    {
        $documents = $request["package_files"];
    	
        $package_screen_name = $request["package_name"];
    	$package_name = preg_replace('/\s+/', '_' , $package_screen_name);
    	$timestamp = sha1(time()*time());
    	$package_name .= "_".$timestamp ;
    	
    	$start = strtotime($request["start"]);
        $end = strtotime($request["end"]);

        $is_hidden = $request["is_hidden"];
        if (!isset($is_hidden)) {
            $is_hidden = 0;
        }
        $banner = UserSelectedBanner::getBanner();

    	$package = Package::create([
    			'package_screen_name' 	=> $package_screen_name,
    			'package_name'			=> $package_name,
    			'banner_id'				=> $banner->id,
                'start'                 => $start,
                'end'                   => $end,
                'is_hidden'             => $is_hidden
    		]);

    	$package_id = $package->id;

    	foreach ($documents as $document) {
    		DocumentPackage::create([
    			'document_id'	=> intval($document),
    			'package_id'	=> $package_id	
    		]);
    	}
        Package::updateTags($package_id, $request['tags']);
    	return;
    }

    public static function getAllPackages($banner_id)
    {
    	$packages = Package::where('banner_id', $banner_id)->get();
    	return $packages;
    }

    public static function getPackageDocumentDetails($id)
    {

    	$document_package_list = DocumentPackage::where('package_id', $id)->get();
    	$documents = [];
    	foreach ($document_package_list as $list_item) {
    		$document = Document::where('id', $list_item->document_id)->first();
    		$path = Document::getFolderPathForDocument($document->id); 
    		$document["folder_path"] = $path;
    		array_push($documents, $document);
    	}
    	return ( $documents );
    }

    public static function updatepackage(Request $request, $id)
    {
        // dd($request->all());
        $package = Package::find($id);
        $package["package_screen_name"] = $request["package_name"];

        $package["start"] = strtotime($request["start"]);
        $package["end"] = strtotime($request["end"]);
        
        $is_hidden = $request["is_hidden"];
        if (isset($is_hidden)) {
            $package["is_hidden"] = $is_hidden;
        }
        else{
            $package["is_hidden"] = 0;
        }
        $package->save();

        $remove_documents = $request["remove_document"];    
        if (isset($remove_documents)) {
            foreach ($remove_documents as $remove) {
               DocumentPackage::where('document_id', intval($remove))->delete();
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
        Package::updateTags($id, $request['tags']);
        return;
    }

    public static function getPackagesStructure($banner_id)
    {
        $packages = Package::where('banner_id', $banner_id)->get();
        
        foreach ($packages as $package) {
            $package_doc_ids = DocumentPackage::where('package_id', $package->id)->get();
            $package["documents"] = [];
            $doc_counter = 0;
            $doc_details = [];
            foreach ($package_doc_ids as $record) {
                $doc = Document::where('id', $record->document_id)->first();
                $doc_details[$doc_counter] = $doc;
                $doc_counter++;
                
            }
            $package["documents"] = $doc_details;
        }
        return($packages);

    }

    public static function updateTags($id, $tags){
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
}
