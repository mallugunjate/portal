<?php

namespace App\Models\Search;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use App\Models\Document\Folder;
use App\Models\Communication\Communication;
use App\Models\Utility\Utility;
use Carbon\Carbon;
use Log;
use Illuminate\Database\Eloquent\Collection as Collection;
class Search extends Model
{
    public static function searchDocuments($query, $store)
    {
    	$docs = collect();
    	
    	$query_terms = explode( ' ', $query);
    	
    	// $today = Carbon::now()->toDateString();
        $today = Carbon::now();

    	foreach ($query_terms as $term) {
    		$docs = $docs->merge(
                        Document::join('document_target', 'document_target.document_id' , '=', 'documents.id' )
                                ->where('title', 'LIKE', '%'.$term.'%')                        
    							->where('start', '<=', $today )
    							->where(function($q) use($today) {
    								$q->where('end', '>=', $today)
    								->orWhere('end', '=', '0000-00-00 00:00:00');
    							})
                                ->where('document_target.store_id', $store)
                                ->select('documents.*')
    							->get()
    				);		

    	}
    	

        foreach($docs as $doc){
            $doc->modalLink = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, 1, 0);
            $doc->since = Utility::getTimePastSinceDate($doc->updated_at);

            $folder_info = Document::getFolderInfoByDocumentId($doc->id);

            $doc->folder_name = $folder_info->name;
            $doc->global_folder_id = $folder_info->global_folder_id;
            $doc->rank = 1;
            // $doc->folderPath = Document::getFolderPathForDocument($doc->id);
        }   

        $ranked_results = Search::rankSearchResults($docs);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
    	return $ranked_results;
    }

    public static function searchArchivedDocuments($query, $store)
    {
        $docs = collect();
        
        $query_terms = explode( ' ', $query);
        
        $today = Carbon::now();
        foreach ($query_terms as $term) {
            $docs = $docs->merge(
                        Document::join('document_target', 'document_target.document_id', '=', 'documents.id' )
                                ->where('original_filename', 'LIKE', '%'.$term.'%')
                                ->where('end', '<=', $today )
                                ->where('end', '!=', '0000-00-00 00:00:00')
                                ->where('document_target.store_id', $store)
                                ->select('documents.*')
                                ->get()
                    );      

        }

        // $docs = $docs->sortBy(function($sort){
        //     return $sort->updated_at;
        // })->reverse();

        foreach($docs as $doc){
            $doc->archived = true;
            $doc->modalLink = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, 1, 0);
            $doc->since = Utility::getTimePastSinceDate($doc->updated_at);

            $folder_info = Document::getFolderInfoByDocumentId($doc->id);

            $doc->folder_name = $folder_info->name;
            $doc->global_folder_id = $folder_info->global_folder_id;
            $doc->rank = 1;
        }

        $ranked_results = Search::rankSearchResults($docs);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;

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

        foreach($folders as $folder){
            
            $folder->globalId = Folder::getGlobalFolderId($folder->id);
            $folder->lastActivity = Utility::getTimePastSinceDate($folder->last_activity_at);

            $path = Folder::getFolderPath($folder->globalId);
            $pathString = "";

           // dd($path);
            $i = 1;
            foreach($path as $p){
                if( $i < count($path) ){
                    $pathString .= " ". $p['name'] . " <i class='fa fa-caret-right'></i> "; 
                    
                } else {
                    $pathString .= " ". $p['name'];   
                }
                
                $i++;
            }

            $folder->path = $pathString;
            $folder->rank = 1;
        }

    	
        $ranked_results = Search::rankSearchResults($folders);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function searchCommunications($query, $store)
    {
    	$communications = collect();
    	
    	$query_terms = explode( ' ', $query);
    	
        $today = Carbon::now();

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
    	

        foreach($communications as $comm){
            $comm->since = Utility::getTimePastSinceDate($comm->updated_at);
            $preview_string = strip_tags($comm->body);         
            $comm->trunc = Communication::truncateHtml($preview_string, 150);
            $comm->rank = 1;
        }

        $ranked_results = Search::rankSearchResults($communications);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function searchArchivedCommunications($query, $store)
    {
        $communications = collect();
        
        $query_terms = explode( ' ', $query);
        
        //$today = Carbon::now()->toDateString();
        $today = Carbon::now();
        foreach ($query_terms as $term) {
            $communications = $communications->merge(
                                Communication::join('communications_target', 'communications_target.communication_id', '=', 'communications.id')
                                ->where('subject', 'LIKE', '%'.$term.'%')
                                ->where('store_id', '=', $store)
                                ->where('archive_at', '<=', $today)
                                ->get()
                    );
        }
        
        foreach($communications as $comm){
            $comm->archived = true;
            $comm->since = Utility::getTimePastSinceDate($comm->updated_at);
            $preview_string = strip_tags($comm->body);         
            $comm->trunc = Communication::truncateHtml($preview_string, 150);
            $comm->rank = 1;
        }

        $ranked_results = Search::rankSearchResults($communications);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function searchAlerts($query, $store)
    {
    	$alerts = collect();
    	
    	$query_terms = explode( ' ', $query);
    	
    	$today = Carbon::now();
    	foreach ($query_terms as $term) {
    		$alerts = $alerts->merge(
    							Document::join('alerts', 'documents.id', '=', 'alerts.document_id')
    							->join('alerts_target', 'alerts.id', '=', 'alerts_target.alert_id')
    							//->where('original_filename', 'LIKE', '%'.$term.'%')
                                ->where('title', 'LIKE', '%'.$term.'%')
    							->where('store_id', '=', $store)
    							->where('alerts.alert_start', '<=', $today )
    							->where(function($q) use($today) {
                                    $q->where('end', '>=', $today)
                                    ->orWhere('end', '=', '0000-00-00 00:00:00');
    							})

    							->get()
    				);
    	}
    	

        foreach ($alerts as $alert) {
            $alert->modalLink = Utility::getModalLink($alert->filename, $alert->title, $alert->original_extension, 1, 0);
            $alert->since = Utility::getTimePastSinceDate($alert->start);
            $alert->rank = 1;
        }

        $ranked_results = Search::rankSearchResults($alerts);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function searchArchivedAlerts($query, $store)
    {
        $alerts = collect();
        
        $query_terms = explode( ' ', $query);
        
        //$today = Carbon::now()->toDateString();
        $today = Carbon::now();
        foreach ($query_terms as $term) {

            $alerts = $alerts->merge(
                                Document::join('alerts', 'documents.id', '=', 'alerts.document_id')
                                ->join('alerts_target', 'alerts.id', '=', 'alerts_target.alert_id')
                                // ->where('original_filename', 'LIKE', '%'.$term.'%')
                                ->where('title', 'LIKE', '%'.$term.'%')      
                                ->where('store_id', '=', $store)
                                ->where('end', '<=', $today )
                                ->get()
                    );
            var_dump(count($alerts));
        }
        
        foreach ($alerts as $alert) {
            $alert->archived = true;
            $alert->modalLink = Utility::getModalLink($alert->filename, $alert->title, $alert->original_extension, 1, 0);
            $alert->since = Utility::getTimePastSinceDate($alert->start);
            $alert->rank = 1;
        }

        $ranked_results = Search::rankSearchResults($alerts);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function rankSearchResults($results)
    {
        
        $ranked_results = new Collection;
        $ranked_ids = [];
        foreach ($results as $result) {
            
            if ( in_array($result['id'], $ranked_ids)) {                 
                $index = (array_search($result['id'], $ranked_ids));
                $ranked_results[$index]['rank'] = $ranked_results[$index]['rank']+1;
            }
            else{
                array_push($ranked_ids, $result['id']);
                $ranked_results->add($result);
            }
        }
        return ( $ranked_results );
    }
}
