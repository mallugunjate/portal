<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class FeatureCategory extends Model
{
    //
   public static function getFeatureCategories()
    {
    	$feature_cat = FeatureCategory::All();
    	return $feature_cat;
    }
}
