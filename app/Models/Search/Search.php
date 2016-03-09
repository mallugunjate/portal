<?php

namespace App\Models\Search;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use App\Models\Document\Folder;
use App\Models\Communication\Communication;
use Carbon\Carbon;
class Search extends Model
{
    public static function searchDocuments($query)
    {
    	$docs = collect();
    	
    	$query_terms = explode( ' ', $query);
    	
    	$today = Carbon::now()->toDateString();
    	foreach ($query_terms as $term) {
    		$docs = $docs->merge(
    					Document::where('original_filename', 'LIKE', '%'.$term.'%')
    							->where('start', '<=', $today )
    							->where(function($q) use($today) {
    								$q->where('end', '>=', $today)
    								->orWhere('end', '=', '0000-00-00 00:00:00');
    							})
    							->get()
    				);		

    	}
    	

    	$docs = $docs->sortBy(function($sort){
    		return $sort->updated_at;
		})->reverse();



    	return $docs;	
    }

    public static function searchFolders($query)
    {
    	$folders = collect();
    	
    	$query_terms = explode( ' ', $query);
    	
    	foreach ($query_terms as $term) {
    		$folders = $folders->merge(
    					Folder::where('name', 'LIKE', '%'.$term.'%')
    							->get()
    				);		

    	}
    	

    	$folders = $folders->sortBy(function($sort){
    		return $sort->updated_at;
		})->reverse();



    	return $folders;	
    }

    public static function searchCommunications($query, $store)
    {
    	$communications = collect();
    	
    	$query_terms = explode( ' ', $query);
    	
    	$today = Carbon::now()->toDateString();
    	foreach ($query_terms as $term) {
    		$communications = $communications->merge(
    							Communication::join('communications_target', 'communications_target.communication_id', '=', 'communications.id')
    							->where('subject', 'LIKE', '%'.$term.'%')
    							->where('store_id', '=', $store)
    							->where('send_at', '<=', $today )
    							->where(function($q) use($today) {
    								$q->where('archive_at', '>=', $today)
    								->orWhere('archive_at', '=', '0000-00-00 00:00:00');
    							})

    							->get()
    				);
    	}
    	

    	$communications = $communications->sortBy(function($sort){
    		return $sort->updated_at;
		})->reverse();

    	return $communications;
    }

    public static function searchAlerts($query, $store)
    {
    	$alerts = collect();
    	
    	$query_terms = explode( ' ', $query);
    	
    	$today = Carbon::now()->toDateString();
    	
    	foreach ($query_terms as $term) {
    		$alerts = $alerts->merge(
    							Document::join('alerts', 'documents.id', '=', 'alerts.document_id')
    							->join('alerts_target', 'alerts.id', '=', 'alerts_target.alert_id')
    							->where('original_filename', 'LIKE', '%'.$term.'%')
    							->where('store_id', '=', $store)
    							->where('alerts.alert_start', '<=', $today )
    							->where(function($q) use($today) {
    								$q->where('alerts.alert_end', '>=', $today)
    								->orWhere('alerts.alert_end', '=', '0000-00-00 00:00:00');
    							})

    							->get()
    				);
    	}
    	

    	$alerts = $alerts->sortBy(function($sort){
    		return $sort->updated_at;
		})->reverse();

    	return $alerts;
    }
}
