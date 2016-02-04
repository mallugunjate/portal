<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Dashboard\QuicklinkTypes;
use App\Models\Document\Document;

class Quicklinks extends Model
{

    protected $table = 'quicklinks';
    protected $fillable = ['banner_id', 'type', 'link_name', 'url'];

 	public static function getLinks($id, $storeNumber)
 	{
 		$links = Quicklinks::where("banner_id", $id)->orderBy('order')->get();
 		$linkarray = array();
 		foreach($links as $link){

 			switch($link->type){
 				case 1: //folder
 					array_push($linkarray, '<a href="/'.$storeNumber.'/document#!/'.$link->url.'" class="client-link"><i class="fa fa-folder-o"></i> '.$link->link_name.'</a>');
 					break;

 				case 2: //file
 					$doc = Document::getDocumentById($link->url);
 					array_push($linkarray, '<a class="launchPDFViewer client-link" data-toggle="modal" data-file="/viewer/?file=/files/" data-target="#fileviewmodal" ><i class="fa fa-file-o"></i> '. $link->link_name.'</a>');
 					break;

 				case 3: //url
 					array_push($linkarray, '<a target="_blank" href="'.$link->url.'" class="client-link"><i class="fa fa-external-link"></i> '.$link->link_name.'</a>');
 					break;

 				default:
 					break;
 			}

 		}

 		return $linkarray;
 	}

 	public static function storeQuicklink($request)
 	{
 		$ql = Quicklinks::create([
 			'link_name' => $request->name,
 			'type' => intval($request->type),
 			'url'  => $request->url
 			]);
 		return $ql;
 	}
}
