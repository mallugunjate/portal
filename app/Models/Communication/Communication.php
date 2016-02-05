<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationDocument;
use App\Models\Document\Document;
use App\Models\Document\Package;
use App\Models\Tag\ContentTag;
use App\Models\Communication\CommunicationTarget;
use DB;

class Communication extends Model
{
    protected $table = 'communications';
    protected $fillable = ['subject', 'body', 'sender', 'importance', 'send_at', 'archive_at', 'is_draft', 'banner_id'];

   	public static function getAllCommunication($banner_id)
      {
         return Communication::where('banner_id', $banner_id)->get();
      }

      public static function storeCommunication($request)
   	{
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

         Communication::updateTargetStores($communication->id, $request);
         Communication::updateCommunicationDocuments($communication->id, $request);
         Communication::updateCommunicationPackages($communication->id, $request);
         Communication::updateTags($communication->id, $request["tags"]);
   		return;
   	}

      public static function updateCommunication($id, $request)
      {
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

         Communication::updateTargetStores($id, $request);
         Communication::updateCommunicationDocuments($id, $request);
         Communication::updateCommunicationPackages($id, $request);
         Communication::updateTags($communication->id, $request["tags"]);

         return;


      }

      public static function updateTargetStores($id, $request)
      {
         CommunicationTarget::where('communication_id', $id)->delete();
         
         $stores = $request["stores"];
         if (count($stores>0)) {
            foreach ($stores as $store) {
               CommunicationTarget::create([
                  'communication_id'   => $id,
                  'store_id'           => $store
               ]);
            
            }
         }
         
         return;
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

      public static function updateTags($id, $tags)
      {
         if (isset($tags)) {
            ContentTag::where('content_type', 'communication')->where('content_id', $id)->delete();
            foreach ($tags as $tag) {
               ContentTag::create([
                  'content_type' => 'communication',
                  'content_id'      => $id,
                  'tag_id'          => $tag
               ]);
            }
         }
         
         return;
      }

      public static function deleteCommunication($id)
      {
         Communication::find($id)->delete();
         CommunicationPackage::where('communication_id', $id)->delete();
         CommunicationDocument::where('communication_id', $id)->delete();
         CommunicationTarget::where('communication_id', $id)->delete();
         ContentTag::where('content_id', $id)->where('content_type', 'communication')->delete();
         return;
      }

      public static function getCommunicationCount($storeNumber)
      {
         $communicationCount = DB::table('communications_target')
           ->where('store_id', $storeNumber)
           ->whereNull('is_read')
           ->count();

         return $communicationCount;
      }
}
