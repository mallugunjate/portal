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
 					array_push($linkarray, '<a href="/'.$storeNumber.'/document#!/'.$link->url.'" class="client-link"><i class="fa fa-folder-open"></i> '.$link->link_name.'</a>');
 					break;

 				case 2: //file
 					$doc = Document::getDocumentById($link->url);
 					$icon = "";
 					$linkUrl = "";
 					switch($doc->original_extension){
	                    case "png":
	                    case "jpg":
	                    case "gif":
	                    case "bmp":
	                        $icon = "fa-file-image-o";              
	                        $linkUrl = '<a href="#">';
	                        break;

	                    case "pdf":
	                        $icon = "fa-file-pdf-o";
	                        $linkUrl = '<a href="#" class="launchPDFViewer" data-toggle="modal" data-file="/viewer/?file=/files/'.$doc->filename.'" data-target="#fileviewmodal" class="client-link"> ';
	                        break;

	                    case "xls":
	                    case "xlsx":
	                        $icon = "fa-file-excel-o";
	                        $linkUrl = '<a href="#">';
	                        break;

	                    case "mp4":
	                    case "avi":
	                    case "mov":
	                        $icon = "fa-film";
	                        $linkUrl = '<a href="#" class="launchVideoViewer" data-file="'.$doc->filename.'" data-target="#videomodal"> ';
	                        break;

	                    case "doc":
	                    case "docx":
	                        $icon = "fa-file-word-o";
	                        $linkUrl = '<a href="#">';
	                        break;

	                    case "mp3":
	                    case "wav":
	                        $icon = "fa-file-audio-o";
	                        $linkUrl = '<a href="#">';
	                        break;

	                    case "ppt":
	                    case "pptx":
	                        $icon = "fa-file-powerpoint-o";
	                        $linkUrl = '<a href="#">';
	                        break;

	                    case "zip":
	                        $icon = "fa-file-archive-o";
	                        $linkUrl = '<a href="#">';
	                        break;

	                    case "html":
	                    case "css":
	                    case "js":
	                        $icon = "fa-file-code-o";
	                        $linkUrl = '<a href="#">';
	                        break;
	                        
	                    default: 
	                        $icon = "fa-file-o";
	                        $linkUrl = '<a href="#">';
	                        break;  
 					}

 					$finallink = $linkUrl .' <i class="fa '.$icon.'"></i>&nbsp;'. $link->link_name.'</a>';
 					array_push($linkarray, $finallink);
 					break; 					

 				case 3: //url
 					array_push($linkarray, '<a target="_blank" href="'.$link->url.'"><i class="fa fa-external-link"></i>&nbsp;'.$link->link_name.'</a>');
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
 			'banner_id' => $request->banner_id,
 			'link_name' => $request->name,
 			'type' 		=> intval($request->type),
 			'url'  		=> $request->url
 			]);
 		return $ql;
 	}
}
