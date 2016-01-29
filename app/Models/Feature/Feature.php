<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\UserSelectedBanner;

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
  		$thumbnail = $request["thumbnail"];
  		$background_image = $request["background"];
  		$banner = UserSelectedBanner::getBanner();

  		$feature = Feature::create([
  				'banner_id'		=> $banner->id,
  				'title' 		=> $title,
  				'tile_label'	=> $tile_label,
  				'start'			=> $start,
  				'end' 			=> $end,
  				'thumbnail'		=>$thumbnail,
  				'background_image' =>$background_image,
  				'update_type_id' => 1,
  				'update_frequency' => 20

 			]);

  		//save the thumbnails and background;

  		Feature::updateFiles($request, $feature->id);
  		Feature::updatePackages($request, $feature->id);

  		return;

  	}  

  	public static function updateFiles($request, $feature_id)
  	{
  		$feature_files = $request["feature_files"];
  		if (isset($feature_files)) {
  			foreach ($feature_files as $file) {
  				FeatureFile::create([
  					'feature_id' => $feature_id,
  					'file_id'	 => $files
  					]);
  			}
  		}
  	}

  	public static function updatePackages($request, $package_id)
  	{
  		$feature_packages = $request["feature_packages"];
  		if (isset($feature_packages)) {
  			foreach ($feature_packages as $package) {
  				FeaturePackage::create([
  					'feature_id' => $feature_id,
  					'package_id'	 => $package_id
  					]);
  			}
  		}
  	}
}
