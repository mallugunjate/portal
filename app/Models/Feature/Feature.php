<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\UserSelectedBanner;
use App\Models\Feature\FeatureDocument;
use App\Models\Feature\FeaturePackage;

class Feature extends Model
{
	use SoftDeletes;
    protected $table = 'features';
    protected $dates = ['deleted_at'];
    protected $fillable = ['banner_id', 'title', 'tile_label', 'description', 'start', 'end', 'background_image', 'thumbnail', 'update_type_id', 'update_frequency'];

  	
  	public static function storeFeature(Request $request)
  	{
  		
      // \Log::info('request');
      \Log::info($request->all());
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

  		//save the thumbnails and background;
      Feature::updateFeatureBackground($background_image, $feature->id);
      Feature::updateFeatureThumbnail($thumbnail, $feature->id);
  		Feature::updateFiles($request, $feature->id);
  		Feature::updatePackages($request, $feature->id);

  		return;

  	}  

    public static function updateFeature(Request $request, $id)
    {
        \Log::info($request["title"]);

        $feature = Feature::find($id);
        // $feature['title'] = $request['title'];
        $feature->save();
    }

  	public static function updateFiles($request, $feature_id)
  	{
  		$feature_files = json_decode($request["feature_files"]);
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

  	public static function updatePackages($request, $feature_id)
  	{
  		$feature_packages = json_decode($request["feature_packages"]);
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
