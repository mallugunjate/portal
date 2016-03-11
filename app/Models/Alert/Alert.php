<?php

namespace App\Models\Alert;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\Models\Utility\Utility;

class Alert extends Model
{
    protected $table = 'alerts';

    protected $fillable = ['banner_id', 'document_id', 'alert_type_id', 'alert_start', 'alert_end'];

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

    public static function getActiveAlertCountByStore($store_id)
    {
        $now = Carbon::now()->toDatetimeString();

        $alert_count = Alert::join('alerts_target', 'alerts.id' , '=', 'alerts_target.alert_id')
                            ->where('store_id', $store_id)
                            ->where('alerts.alert_start' , '<=', $now)
                            ->where('alerts.alert_end', '>=', $now)
                            ->count();

        return $alert_count;
    }

    public static function getActiveAlertCountByCategory($storeNumber, $alertId)
    {
         $now = Carbon::now()->toDatetimeString();

         $count = DB::table('alerts_target')
           ->where('store_id', $storeNumber)
           ->join('alerts', 'alerts.id', '=', 'alerts_target.alert_id')
           ->where('alerts.alert_type_id', $alertId)
           ->where('alerts.alert_start' , '<=', $now)
           ->where('alerts.alert_end', '>=', $now)
           ->count();
         return $count;
  
    }

    public static function getAlertsByStore($store_id)
    {
        $now = Carbon::now()->toDatetimeString();
        
        $alert_ids = \DB::table('alerts_target')->where('store_id', $store_id)
                                                ->get();
        
        $alerts = [];
        foreach ($alert_ids as $alert_id) {
            $alert = Alert::join('documents', 'alerts.document_id' , '=', 'documents.id')
                            ->where('alerts.id', $alert_id->alert_id)
                            ->where('alerts.alert_start' , '<=', $now)
                            ->where('alerts.alert_end', '>=', $now)
                            ->first();
            if($alert) {
                array_push($alerts, $alert);    
            }
            
        }
        if (count($alerts) >0) {
            foreach($alerts as $a){
                
                $a->prettyDate =  Utility::prettifyDate($a->updated_at);
                $a->since =  Utility::getTimePastSinceDate($a->updated_at);
                
            }
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

    public static function markDocumentAsAlert($request, $id)
    {
        if (Alert::where('document_id', $id)->first()) {
            
            $alert = Alert::where('document_id', $id)->first();

            $alert['alert_type_id'] = $request['alert_type_id'];
            $alert['alert_start']   = $request['start'];
            $alert['alert_end']     = $request['end'];

            $alert->save();

            
            if ($request['target_stores'] != '') {
                
                \DB::table('alerts_target')->where('alert_id', $alert->id)->delete();
                $target_stores = $request['target_stores'];
                
                foreach ($target_stores as $store) {
                    \DB::table('alerts_target')->insert([
                        'alert_id' => $alert->id,
                        'store_id' => $store
                        ]);    
                }
            }

        }
        else {
            $alert = Alert::create([

            'document_id'   => $id,
            'alert_type_id' => $request['alert_type_id'],
            'alert_start'   => $request['start'],
            'alert_end'     => $request['end'],
            'banner_id'     => $request['banner_id']
            ]);

            $target_stores = $request['target_stores'];

            foreach ($target_stores as $store) {
                \DB::table('alerts_target')->insert([
                    'alert_id' => $alert->id,
                    'store_id' => $store
                    ]);    
            }
        }
        
        
        return;
    }

    public static function deleteAlert($document_id)
    {
        $alert = Alert::where('document_id', $document_id)->first();
        if ($alert) {
            $alert->delete();
        }
        return;
    }

}
