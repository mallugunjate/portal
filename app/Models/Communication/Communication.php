<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationDocument;
use App\Models\Document\Document;
use App\Models\Document\Package;

class Communication extends Model
{
    protected $table = 'communications';
    protected $fillable = ['subject', 'body', 'sender', 'importance', 'send_at', 'archive_at', 'is_draft', 'banner_id'];

   	public static function storeCommunication($request)
   	{
   		// dd($request);
   		$is_draft = 0;
   		if ($request["send_at"]>Carbon::now()) {
   			$is_draft = 1;
   		}
   		$communication = Communication::create([
   			'subject' 	=> $request["subject"],
   			'body'		=> $request["body"],
   			'sender'	=> $request["sender"],
   			'importance'=> $request["importance"],
   			'send_at'	=> $request["send_at"],
   			'archive_at'=> $request["archive_at"],
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

      public static function updateCommunication($id, $request)
      {
         // dd($request->all());

         $communication = Communication::find($id);

         $communication["subject"] = $request["subject"];
         $communication["body"] = $request["body"];
         $communication["sender"] = $request["sender"];
         $communication["importance"] = $request["importance"];
         $communication["send_at"] = $request["send_at"];
         $communication["archive_at"] = $request["archive_at"];
         if ($request["send_at"] > Carbon::now()) {
            $communication["is_draft"] = 1;
         }
         else {
            $communication["is_draft"] = 0;
         }
         $communication->save();

         Communication::updateCommunicationDocuments($id, $request);
         Communication::updateCommunicationPackages($id, $request);


      }

      public static function updateCommunicationDocuments($id, $request)
      {
         $remove_docs = $request["remove_document"];
         if (isset($remove_docs)) {
            foreach ($remove_docs as $doc) {
               CommunicationDocument::where('communication_id', $id)->where('document_id', intval($doc))->delete();
            }
         }

         $add_docs = $request["package_files"];
         if (isset($add_docs)) {
            foreach ($add_docs as $doc) {
               CommunicationDocument::create([
                  'communication_id'   => $id,
                  'document_id'      => $doc
               ]);
            }
         }
      }

      public static function updateCommunicationPackages($id, $request)
      {
         $remove_packages = $request["remove_package"];
         if (isset($remove_packages)) {
            foreach ($remove_packages as $package) {
               CommunicationPackage::where('communication_id', $id)->where('package_id', intval($package))->delete();
            }
         }

         $add_packages = $request["packages"];
         if (isset($add_packages)) {
            foreach ($add_packages as $package) {
               CommunicationPackage::create([
                  'communication_id'   => $id,
                  'package_id'      => $package
               ]);
            }
         }
      }

      public static function getDocumentDetails($id)
      {
         $communication_document_list = CommunicationDocument::where('communication_id', $id)->get();
         $documents = [];
         foreach ($communication_document_list as $list_item) {
            $doc = Document::find($list_item->document_id);
            $doc["folder_path"] = Document::getFolderPathForDocument($list_item->document_id);
            array_push($documents, $doc);
         }
         return $documents;
      }

      public static function getPackageDetails($id)
      {
         $communication_package_list = CommunicationPackage::where('communication_id', $id)->get();
         
         $packages = [];
         foreach ($communication_package_list as $list_item) {
            $package = Package::find($list_item->package_id);
            $package["documents"] = [];
            $package_docs = Package::getPackageDocumentDetails($list_item->package_id);
            $package["documents"] = $package_docs;
            array_push($packages, $package);
         }
         return $packages;
      }
}
