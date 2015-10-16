<?php

namespace App;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Week;
use App\Folder;
use App\FileFolder;


class Document extends Model
{
    protected $table = 'documents';
    protected $fillable = array('upload_package_id', 'original_filename', 'filename', 'title', 'description');

    public static function getDocuments($folder_id, $isWeek)
    {
    	

        if (isset($folder_id)) {
            
            $response = [];
            if($isWeek == "true"){

                $response["type"] = "week"; 
                $folder = Week::where('id', $folder_id)->first();
                
                $response["folder"] = [];
                array_push($response["folder"], $folder);
            }
            else{

                $response["type"] = "folder";
                $folder = Folder::where('id', $folder_id)->first();    
                
                $response["folder"] = [];
                array_push($response["folder"], $folder);
            }

            $files = \DB::table('file_folder')
                            ->join('documents', 'file_folder.document_id', '=', 'documents.id')
                            ->where('file_folder.folder_id', '=', $folder_id)
                            ->select('documents.*')
                            ->get();        
                
            $response["files"] = [];
            if (count($files) > 0) {
                 array_push($response["files"], $files); 
            }
            else{
                array_push($response["files"], null);
            }
            return $response;
            
        }
        return [];
    } 

    public static function storeDocument($request)
    {
        
        $metadata = Document::getDocumentMetaData($request->file('document'));       

        $directory = public_path() . '/files';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["extension"];

        $upload_success = $request->file('document')->move($directory, $filename); //move and rename file        

        if ($upload_success) {
            $documentdetails = array(
                'original_filename' => $metadata["originalName"],
                'filename'          => $filename,
                'upload_package_id' => $request->get('upload_package_id'),
                'title'             => "no title",
                'description'       => "no description"
            );

            $document = Document::create($documentdetails);
            $document->save();
            $lastInsertedId= $document->id;

            $documentfolderdetails = array(
                'document_id' => $lastInsertedId,
                'folder_id' => $request->get('folder_id')
            );
           
            $documentfolder = FileFolder::create($documentfolderdetails);
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
        $response["extension"]    = $extension;

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
        Document::find($id)->delete();
        return;
    }

    public static function updateMetaData(Request $request, $id=null)
    {
        if (!isset($id)) {
            $id = $request->get('file_id');
        }
        
        $title = $request->get('title');
        $description = $request->get('description');

        $metadata = array(
            'title' => $title,
            'description' => $description
        );

        $document = Document::find($id);
        $document->update($metadata);
    }
}
