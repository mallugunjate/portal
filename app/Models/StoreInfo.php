<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Models\UserSelectedBanner;

class StoreInfo extends Model
{
    public static function getStoreListing($banner_id)
    {
    	
  		$storeAPI = env('STORE_API_DOMAIN', false);
        $storeInfoJson = file_get_contents( $storeAPI . "/banner/" . $banner_id);
        $storeInfo = json_decode($storeInfoJson);
        $storelist = StoreInfo::buildStoreList($storeInfo);
        return $storelist;
    }

    public static function buildStoreList($storeInfo)
    {
    	$storelist = [];
    	foreach ($storeInfo as $store) {
    			$storelist[$store->store_number] = $store->id . " " . $store->name;
    	}
    	return $storelist;	
    }

    public static function getStoreInfoByStoreId($store_id)
    {
        $storeAPI = env('STORE_API_DOMAIN', false);
        $storeInfoJson = file_get_contents( $storeAPI . "/banner/" . $banner_id);
        $storeInfo = json_decode($storeInfoJson);
        return $storeInfo;
    }
}
