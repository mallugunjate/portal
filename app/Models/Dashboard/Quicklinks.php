<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Dashboard\QuicklinkTypes;
use App\Models\Document\Document;
use App\Models\Utility\Utility;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Validation\QuicklinkValidator;

class Quicklinks extends Model
{
    use SoftDeletes;
    protected $table = 'quicklinks';
    protected $fillable = ['banner_id', 'type', 'link_name', 'url'];
    protected $dates = ['deleted_at'];

 	
    public static function validateCreateQuicklink($request)
    {
    	$validateThis = [

    		'banner_id' => $request['banner_id'],
    		'link_name'	=> $request['name'],
    		'type'		=> $request['type']

    	];

    	switch($request['type']) {
    		case 1 : 
    			$validateThis['document_url'] = $request['url'];
    			break;
    		case 2 :
    			$validateThis['folder_url'] = $request['url'];
    			break;
    		case 3:
    			$validateThis['external_url'] = $request['url'];
    			break;
    		default:
    			break;
    	}

    	\Log::info($validateThis);
    	$v = new QuicklinkValidator();
    	$validationResult = $v->validate($validateThis);
    	return $validationResult;
    }

 	public static function getLinks($id, $storeNumber)
 	{
 		$links = Quicklinks::where("banner_id", $id)->orderBy('order')->get();
 		$linkarray = array();

 		foreach($links as $link){

 			switch($link->type){
 				case 1: //folder
 					array_push($linkarray, '<a href="/'.$storeNumber.'/document#!/'.$link->url.'"><i class="fa fa-folder"></i> '.$link->link_name.'</a>');
 					break;

 				case 2: //file
 					$doc = Document::getDocumentById($link->url);
 					$finallink = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1);
 					array_push($linkarray, $finallink);
 					break; 					

 				case 3: //url
 					array_push($linkarray, '<a class="trackclick" data-ext-url="'.$link->id.'" target="_blank" href="'.$link->url.'"><i class="fa fa-external-link"></i>&nbsp;'.$link->link_name.'</a>');
 					break;

 				default:
 					break;
 			}

 		}

 		return $linkarray;
 	}

 	public static function storeQuicklink($request)
 	{
 		$validate = Quicklinks::validateCreateQuicklink($request);
        
        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        } 

 		$ql = Quicklinks::create([
 			'banner_id' => $request->banner_id,
 			'link_name' => $request->name,
 			'type' 		=> intval($request->type),
 			'url'  		=> $request->url
 			]);
 		return $ql;
 	}
}
