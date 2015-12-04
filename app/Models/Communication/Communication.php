<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationDocument;

class Communication extends Model
{
    protected $table = 'communications';
    protected $fillable = ['subject', 'body', 'sender', 'importance', 'send_at', 'archive_at', 'is_draft', 'banner_id'];

   	public static function storeCommunication($request)
   	{
   		// dd($request);
   		$is_draft = 0;
   		if ($request["start"]>Carbon::now()) {
   			$is_draft = 1;
   		}
   		$communication = Communication::create([
   			'subject' 	=> $request["subject"],
   			'body'		=> $request["body"],
   			'sender'	=> $request["sender"],
   			'importance'=> $request["importance"],
   			'send_at'	=> $request["start"],
   			'archive_at'=> $request["end"],
   			'is_draft'	=> $is_draft,
   			'banner_id' => $request["banner_id"]

   		]);

   		$documents = $request["package_files"];
   		if (isset($documents)) {
   			foreach ($documents as $document) {
   				CommunicationDocument::create([
   					'communication_id' => $communication->id,
   					'document_id' => $document
   				]);
   			}
   		}

   		$packages = $request["packages"];
		if (isset($packages)) {
   			foreach ($packages as $package) {
   				CommunicationPackage::create([
   					'communication_id' 	=> $communication->id,
   					'package_id'		=> $package
   				]);
   			}
   		}   		
   		return;
   	}
}
