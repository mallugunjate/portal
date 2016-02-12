<?php

namespace App\Models\Alert;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $table = 'alerts';

    protected $fillable = ['banner_id', 'document_id', 'alert_type_id'];

    public static function getAllAlerts($banner_id)
    {
    	$alerts = Alert::join('documents', 'alerts.document_id' , '=', 'documents.id')
    			->join('alert_types', 'alert_types.id', '=', 'alerts.alert_type_id')
    			->where('alerts.banner_id', $banner_id)
    			->select('alerts.*', 'alert_types.name as alert_type', 'documents.id as document_id', 'documents.original_filename as document_name')
    			->get();

    	foreach ($alerts as $alert) {
    		$target_stores = \DB::table('alerts_target')->where('alert_id', $alert->id)->lists('store_id');
    		$alert->count_target_stores = count($target_stores);
    		$alert->target_stores = implode( ", ", $target_stores );
    		unset($target_stores);
    	}

    	return $alerts;
    }


    public static function getTargetStoresForDocument($id)
    {
    	$document_id = $id;
    	$alert = Alert::where('document_id', $document_id)->first();

    	if ($alert) {
    		$alert_id = $alert->id;
    		return \DB::table('alerts_target')->where('alert_id', $alert_id)->lists('store_id', 'id');
    	}
    	
    	return [];
    }
}
