<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Log;


class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = ['name', 'background'];

    public static function updateBannerBackground($id, $request)
    {
        $banner = Banner::find($id);
        $file = $request->file('dashboardbackground');
        Log::info("In the model now...");
        Log::info(dd($request));
        $directory = public_path() . '/images/dashboard-banners';
		$extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $modifiedName = str_replace(" ", "_", $originalName);
        $modifiedName = str_replace(".", "_", $modifiedName);
		$uniqueHash = sha1(time() . time());
        $filename  = $modifiedName . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        Log::info('filename: ' . $filename);

        // $upload_success = $request->file('document')->move($directory, $filename); //move and rename file  

        // if ($upload_success) {
        //     $backgroundDetails = array(
        //         'filename'          => $filename,
        //         'banner_id'         => $banner->id
        //     );

        //     $document = Document::create($documentdetails);
        //     $document->save();
        //     $lastInsertedId= $document->id;

        //     //update file-folder table
        //     $isWeekFolder = $request->get('isWeekFolder');
        //     $folder_type = "folder"; 
        //     if ($isWeekFolder == "true") {
        //         $folder_type = "week";
        //     }
            
        //     $global_folder_id = $request->get('folder_id');

        //     $documentfolderdetails = array(
        //         'document_id' => $lastInsertedId,
        //         'folder_id' => $global_folder_id
        //     );
            
        //     $documentfolder = FileFolder::create($documentfolderdetails);


        //     //update folder timestamp
        //     Folder::updateTimestamp($global_folder_id, $document->created_at);

        //     //create thumbnail
        //     if($metadata["originalExtension"] == "jpg" || $metadata["originalExtension"] == "png" || $metadata["originalExtension"] == "gif" || $metadata["originalExtension"] == "pdf"){
        //         Document::createDocumentThumbnail($filename);    
        //     }            

        //     $documentfolder->save();
        // }

    }
}
