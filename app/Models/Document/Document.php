<?php

namespace App\Models\Document;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Week;
use App\Models\Document\Folder;
use App\Models\Document\FileFolder;
use Carbon\Carbon;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\UserSelectedBanner;
use DB;
use App\Models\Alert\Alert;
use App\Models\Utility\Utility;
class Document extends Model
{
    protected $table = 'documents';
    protected $fillable = array('upload_package_id', 'original_filename','original_extension', 'filename', 'title', 'description', 'start', 'end', 'banner_id');

    public static function getDocuments($global_folder_id, $forStore=null)
    {

        if (isset($global_folder_id)) {
                
            $global_folder_details = \DB::table('folder_ids')->where('id', $global_folder_id )->first();
            
            $folder_type = $global_folder_details->folder_type;
            $folder_id = $global_folder_details->folder_id;

            $now = Carbon::now()->toDatetimeString();
            
            if ($forStore) {
                $files = \DB::table('file_folder')
                            ->join('documents', 'file_folder.document_id', '=', 'documents.id')
                            ->where('file_folder.folder_id', '=', $global_folder_id)
                            ->where('documents.start', '<=', $now )
                            ->select('documents.*')
                            ->get();
                $counter = 0;
                foreach ($files as $file) {
                    
                    if (!( $file->end >= $now || $file->end == '0000-00-00 00:00:00' ) ) {

                        unset($files[$counter]);
                    }
                    $counter++;
                }  
                $files = array_values($files);
            }
            else{
                $files = \DB::table('file_folder')
                            ->join('documents', 'file_folder.document_id', '=', 'documents.id')
                            ->where('file_folder.folder_id', '=', $global_folder_id)
                            ->select('documents.*')
                            ->get();            
            }
            


            
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $file->link = Utility::getModalLink($file->filename, $file->title, $file->original_extension, 0);
                    $file->link_with_icon = Utility::getModalLink($file->filename, $file->title, $file->original_extension, 1);
                    $file->icon = Utility::getIcon($file->original_extension);
                    $file->prettyDateCreated = Utility::prettifyDate($file->created_at);
                    $file->prettyDateStart = Utility::prettifyDate($file->start);
                    $file->prettyDateEnd = Utility::prettifyDate($file->end);

                    $file->is_alert = '';
                    if (Alert::where('document_id', $file->id)->first()) {
                        $file->is_alert = Utility::getAlertIcon();
                    }

                }
                return $files;
            }
            else{
                return [];
            }

        }

        return [];

    } 

    public static function storeDocument($request)
    {
        
        $metadata = Document::getDocumentMetaData($request->file('document'));       

        $directory = public_path() . '/files';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $request->file('document')->move($directory, $filename); //move and rename file        
        
        $banner = UserSelectedBanner::getBanner();

        if ($upload_success) {
            $documentdetails = array(
                'original_filename' => $metadata["originalName"],
                'filename'          => $filename,
                'original_extension'=> $metadata["originalExtension"],
                'upload_package_id' => $request->get('upload_package_id'),
                'title'             => "no title",
                'description'       => "no description",
                'banner_id'         => $banner->id
            );

            $document = Document::create($documentdetails);
            $document->save();
            $lastInsertedId= $document->id;

            //update file-folder table
            $isWeekFolder = $request->get('isWeekFolder');
            $folder_type = "folder"; 
            if ($isWeekFolder == "true") {
                $folder_type = "week";
            }
            
            $global_folder_id = $request->get('folder_id');

            $documentfolderdetails = array(
                'document_id' => $lastInsertedId,
                'folder_id' => $global_folder_id
            );
            
            $documentfolder = FileFolder::create($documentfolderdetails);


            //update folder timestamp
            Folder::updateTimestamp($global_folder_id, $document->created_at);

            //create thumbnail
            if($metadata["originalExtension"] == "jpg" || $metadata["originalExtension"] == "png" || $metadata["originalExtension"] == "gif" || $metadata["originalExtension"] == "pdf"){
                Document::createDocumentThumbnail($filename);    
            }            


            $documentfolder->save();



        }
    }

    public static function getDocumentMetaData($file)
    {
        
        $extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $modifiedName = str_replace(" ", "_", $originalName);
        $modifiedName = str_replace(".", "_", $modifiedName);

        $response = [];
        $response["originalName"] = $originalName;
        $response["modifiedName"] = $modifiedName;
        $response["originalExtension"] = $extension;

        return $response;
    }

    public static function getDocumentById($id)
    {
        $document =  Document::where('id', $id)->first();
        if ($document) {
            return $document;
        }
        return [];
    }

    public static function deleteDocument($id)
    {
        
        FileFolder::where('document_id', $id)->delete();
        $document = Document::find($id);
        unlink(public_path('files/'.$document->filename));
        $document->delete();
        return;
    }

    public static function updateMetaData(Request $request, $id=null)
    {
        
        if (!isset($id)) {
            $id = $request->get('file_id');
        }
        
        $tags = $request->get('tags'); 
        if ($tags != null) {
            Document::updateTags($id, $tags);
        }

        $title          = $request->get('title');
        $description    = $request->get('description');
        $start          = $request->get('start');
        $end            = $request->get('end');
        
        $metadata = array(
            'title'       => $title,
            'description' => $description,
            'start'       => $start,
            'end'         => $end
        );

        $document = Document::find($id);
        $document->update($metadata);

        $global_parent_folder_id = FileFolder::where('document_id', $id)->first()->folder_id;
        Folder::updateTimestamp($global_parent_folder_id, $document->updated_at );
        
    }
    
    public static function updateDocument($request, $id) {

        $document       = Document::find($id);
        $title          = $request->get('title');
        $description    = $request->get('description');
        $doc_start      = $request->get('document_start');
        $doc_end        = $request->get('document_end');

        $document['title']  = $title;
        $document['description'] = $description;
        $document['start']  = $doc_start;
        $document['end']  = $doc_end; 

        $document->save();

        $is_alert = $request->get('is_alert');
        if( $is_alert == 1) {
            Alert::markDocumentAsAlert($request, $id);    
        }
        else if ($is_alert == 0) {
            Alert::deleteAlert($document->id); 
        }
        
        return $document;
        
    }

    public static function getRecentDocuments($banner_id, $days)
    {
        $fromDate =  Carbon::today()->subDays($days);
        $documents = Document::where('start', '>=', $fromDate)
                            ->where('banner_id', $banner_id)    
                            ->orderBy('start','desc')
                            ->get();

        foreach ($documents as $document) {
            
            $global_folder_id = FileFolder::where('document_id',$document->id)->first()->folder_id;

            $global_folder_details =  \DB::table('folder_ids')->where('id', $global_folder_id)->first();
            $folder_id = $global_folder_details->folder_id;
            $folder_type = $global_folder_details->folder_type;


            if ($folder_type == 'folder') {
                $folder_details = Folder::where('id', $folder_id)->get();
            }
            else{
                $folder_details  = Week::where('id', $folder_id)->get();
            }

            $document["folder_details"] = $folder_details;
            unset($folder_id);
            unset($folder_details);

        }
        return $documents;
    }

    public static function getArchivedDocuments($folder_id)
    {
        $folder = Folder::find($folder_id);
        $archivedDocuments = [];
        if($folder->has_weeks == 1) {
            $weeksInFolder = Week::where('parent_id', $folder_id)->get();
            $counter = 0;
            foreach ($weeksInFolder as $weekInFolder) {
                $weekFolderId = $weekInFolder->id;
                $global_folder_id = \DB::table('folder_ids')->where('folder_id', $weekFolderId)
                                                            ->where('folder_type', 'week')
                                                            ->first()->id;
                $docs = FileFolder::where('folder_id', $global_folder_id)->get();
                if(count($docs)>0) {
                    $archivedDocuments[$counter]["folder"] = $weekInFolder;
                    $archivedDocuments[$counter]["number_of_documents"] = count($docs);
                    // $archivedDocuments[$counter]["docs"] = $docs;
                    $archivedDocuments[$counter]["doc_ids"] = [];
                    foreach ($docs as $doc) {
                        // $doc_details = Document::where('id', $doc->document_id)->first();
                        array_push($archivedDocuments[$counter]["doc_ids"], $doc);
                        unset($doc_details);
                    }
                    
                    $counter++;    
                }
                
            }
            return $archivedDocuments;
        }     
        
        
        else{
            $global_folder_id = \DB::table('folder_ids')->where('folder_id', $folder_id)
                                                            ->where('folder_type', 'folder')
                                                            ->first()->id;
            $docs = FileFolder::where('folder_id', $global_folder_id)->get();
            $archivedDocuments[0]["folder"] = $folder;
            $archivedDocuments[0]["number_of_documents"] = count($docs);
            $archivedDocuments[0]["docs"] = $docs;
            return $archivedDocuments;

        }
    }

    public static function createDocumentThumbnail($filename)
    {

        $im = new \Imagick();
        $im->readimage(public_path().'/files/'. $filename.'[0]'); 
        // $imagick->resizeImage($width, $height, $filterType, $blur, $bestFit);
        $im->resizeImage(600,700, 0, 2, true);
        $im->setImageFormat('jpeg');    
        $im->writeImage(public_path().'/images/documents/thumb/'.$filename.'.jpg'); 
        $im->clear(); 
        $im->destroy();

    }

    public static function getFolderPathForDocument($id)
    {
        
        $parent_global_id = FileFolder::where('document_id', $id)->first()->folder_id;
        $parent = \DB::table('folder_ids')->where('id', $parent_global_id)->first();
        $path = [];
        array_push($path, $parent);
        $finalPath = "";
        while (!empty($path)) {
            $currentFolder = array_pop($path);
            
            if(isset($currentFolder->folder_type)) {
                if ($currentFolder->folder_type ==  'week') {
                $weekFolder = Week::where('id', $currentFolder->folder_id)->first(); 
                $parent_id = $weekFolder->parent_id;
                $parent = \DB::table('folder_ids')->where('id', $parent_id)->first();
                $finalPath = "week" . $weekFolder->week_number . "/" . $finalPath;
                array_push($path, $parent);

            }
            else if ($currentFolder->folder_type == 'folder') {
                $folder_struct = FolderStructure::where('child', $currentFolder->folder_id)->first();
                if( $folder_struct) {

                    $parent_id = $folder_struct->parent;
                    $parent = $parent = \DB::table('folder_ids')->where('folder_id', $parent_id)->where('folder_type', 'folder')->first(); 
                    //folder_id would be replace with id when folder_struct gets updated to store global_folder_id
                    $finalPath = Folder::where('id', $currentFolder->folder_id)->first()->name ."/". $finalPath;
                    array_push($path, $parent);
                    continue;
                }
                else{
                    $parent = Folder::where('id', $currentFolder->folder_id)->first();
                    $finalPath = $parent->name ."/".$finalPath;
                    break;

                }
            }     
            }
              
        }
        
        return ($finalPath);
    }

    public static function updateTags($id, $tags)
    {
        ContentTag::where('content_type', 'document')->where('content_id', $id)->delete();
        foreach ($tags as $tag) {
            ContentTag::create([
               'content_type'   => 'document',
               'content_id'     => $id,
               'tag_id'         => $tag
            ]);
        }
            
        return;
    }

    public static function getFolderInfoByDocumentId($id)
    {
        $folder = FileFolder::where('document_id', $id)->first();
        $globalFolderId = $folder->folder_id; 

        $folderInfo = DB::table('folder_ids')
                    ->join('folders', 'folder_ids.folder_id', '=', 'folders.id')
                    ->where('folder_ids.id', $globalFolderId)
                    ->first();

        $folderInfo->global_folder_id = $globalFolderId;
    
        return $folderInfo;

    }
}
