<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\UserSelectedBanner;
use App\Models\Feature\FeatureDocument;
use App\Models\Feature\FeaturePackage;
use App\Http\Requests;


class Feature extends Model
{
	use SoftDeletes;
    protected $table = 'features';
    protected $dates = ['deleted_at'];
    protected $fillable = ['banner_id', 'title', 'tile_label', 'description', 'start', 'end', 'background_image', 'thumbnail', 'update_type_id', 'update_frequency'];

  	
  	public static function storeFeature(Request $request)
  	{
  		
      $title = $request["name"];
  		$tile_label = $request["tileLabel"];
  		$start = $request["start"];
  		$end = $request["end"];
  		$thumbnail = $request->file("thumbnail");
  		$background_image = $request->file("background");
  		$banner = UserSelectedBanner::getBanner();

  		$feature = Feature::create([
  				'banner_id'     => $banner->id,
  				'title' 		    => $title,
  				'tile_label'	  => $tile_label,
  				'start'         => $start,
  				'end' 			    => $end,
  				'update_type_id'=> 1,
  				'update_frequency' => 20,
          'thumbnail'     => 'temp',
          'background_image' =>'temp'

 			]);

  		
      Feature::updateFeatureBackground($background_image, $feature->id);
      Feature::updateFeatureThumbnail($thumbnail, $feature->id);
  		Feature::addFiles(json_decode($request["feature_files"]), $feature->id);
  		Feature::addPackages(json_decode($request['feature_packages']), $feature->id);

  		return;

  	}  

    public static function updateFeature(Request $request, $id)
    {
        \Log::info($request->all());
        
        $feature = Feature::find($id);

        $feature['title'] = $request->title;
        $feature['tile_label'] = $request->tileLabel;
        $feature['start'] = $request->start;
        $feature['end'] = $request->end;

        $feature->save();

        Feature::addFiles($request->feature_files, $id);
        Feature::removeFiles($request->remove_document, $id);
        Feature::addPackages($request->feature_packages, $id);
        Feature::removePackages($request->remove_package, $id);
        // Feature::updateFeatureBackground($request["background"], $id);
        // Feature::updateFeatureThumbnail($request["thumbnail"], $id);
        return;

    }

  	public static function addFiles($feature_files, $feature_id)
  	{
  		
        if (isset($feature_files) && count($feature_files) >0 ) {
    			foreach ($feature_files as $file) {
    				FeatureDocument::create([
    					'feature_id' => $feature_id,
    					'document_id'	 => intval($file)
    					]);
            \Log::info('document_id :' . $file);
    			}
    		}
        return;
  	}

    public static function removeFiles($feature_files, $feature_id)
    {
        if (isset($feature_files) && count($feature_files) >0 ) {
          foreach ($feature_files as $file) {
            FeatureDocument::where('feature_id', $feature_id)->where('document_id', intval($file))->delete();  
          }
        }
        return;
    }

  	public static function addPackages($feature_packages, $feature_id)
  	{
  		
    		if (isset($feature_packages)) {
    			foreach ($feature_packages as $package) {
    				FeaturePackage::create([
    					'feature_id' => $feature_id,
    					'package_id'	 => intval($package)
    					]);
    			}
    		}
        return;
  	}

    public static function removePackages($feature_packages, $feature_id)
    {
        if (isset($feature_packages)) {
          foreach ($feature_packages as $package) {
            FeaturePackage::where('feature_id', $feature_id)->where('package_id', intval($package))->delete();  
          }
        }
        return; 
    }


    public static function updateFeatureBackground($file, $feature_id)
    {
        $metadata = Feature::getFileMetaData($file);

        $directory = public_path() . '/images/featured-backgrounds/';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $file->move($directory, $filename); //move and rename file  

        Feature::where('id', $feature_id)->update(['background_image' => $filename]);
        return;
    }

    public static function updateFeatureThumbnail($file, $feature_id)
    {
        $metadata = Feature::getFileMetaData($file);

        $directory = public_path() . '/images/featured-covers/';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $file->move($directory, $filename); //move and rename file  
        Feature::where('id', $feature_id)->update(['thumbnail' => $filename]);
        \Log::info($filename);
        return ;
    }

    public static function getFileMetaData($file)
    {
        
        $extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $modifiedName = str_replace(" ", "_", $originalName);
        $modifiedName = str_replace(".", "_", $modifiedName);

        $response = [];
        $response["originalName"] = $originalName;
        $response["modifiedName"] = $modifiedName;
        $response["originalExtension"] = $extension;

        return $response;
    }
}
