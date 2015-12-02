<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Document\Document;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = ['id', 'package_screen_name', 'package_name', 'banner_id'];

    public static function storePackage(Request $request)
    {
    	$documents = $request["documents"];
    	$package_screen_name = $request["package_name"];
    	
    	$package_name = preg_replace('/\s+/', '_' , $package_screen_name);
    	$timestamp = sha1(time()*time());
    	$package_name .= "_".$timestamp ;
    	
    	$banner_id = $request["banner_id"];
    	$package = Package::create([
    			'package_screen_name' 	=> $package_screen_name,
    			'package_name'			=> $package_name,
    			'banner_id'				=> $banner_id

    		]);

    	$package_id = $package->id;

    	foreach ($documents as $document) {
    		DocumentPackage::create([
    			'document_id'	=> intval($document),
    			'package_id'	=> $package_id	
    		]);
    	}

    	return;
    }

    public static function editPackage($id, Request $request)
    {

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
}
