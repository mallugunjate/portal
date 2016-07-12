<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Document\Document;
use App\Models\UserSelectedBanner;
use Illuminate\Http\Request;
use App\Models\Video\VideoTag;
use App\Models\Utility\Utility;
use App\User;

class Video extends Model
{
    use SoftDeletes;

    protected $table = 'videos';
    protected $fillable = ['upload_package_id', 'original_filename', 'original_extension', 'filename', 'title', 'description', 'uploader', 'likes', 'dislikes', 'featured'];
    protected $dates = ['deleted_at'];

    public static function getAllVideos()
    {
    	$videos = Video::all()
                        ->each(function($file){
                            $file->uploaderFirstName = User::find($file->uploader)->firstname;
                            $file->uploaderLastName = User::find($file->uploader)->lastname;
                            $file->link = Utility::getModalLink($file->filename, $file->title, $file->original_extension, $file->id, 0);
                            $file->link_with_icon = Utility::getModalLink($file->filename, $file->title, $file->original_extension, $file->id, 1);
                            $file->icon = Utility::getIcon($file->original_extension);
                            $file->prettyDateCreated = Utility::prettifyDate($file->created_at);
                            $file->prettyDateUpdated = Utility::prettifyDate($file->updated_at);
                        });
        return $videos;
    }           
    
    public static function storeVideo($request)
    {
     	\Log::info($request->all());   
        // $validate = Document::validateCreateDocument($request);
        
        // if($validate['validation_result'] == 'false') {
        //     \Log::info($validate);
        //     return json_encode($validate);
        // } 

        $metadata = Document::getDocumentMetaData($request->file('document'));       

        $directory = public_path() . '/videos';
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
                'title'             => preg_replace('/\.'.preg_quote($metadata["originalExtension"]).'/', '', $metadata["originalName"]),
                'description'       => "no description",
                'uploader'			=> \Auth::user()->id,
                'likes'				=> 0,
                'dislikes'			=> 0,
                'featured'			=> 0,
            );

            $video = Video::create($documentdetails);
            $video->save();
            $lastInsertedId= $video->id;
            
        }

        return ;
    }

    public static function updateMetaData(Request $request, $id=null)
    {
        if (!isset($id)) {
            $id = $request->get('file_id');
        }
        
        $tags = $request->get('tags'); 
        if ($tags != null) {
            Video::updateTags($id, $tags);
        }

        $title          = $request->get('title');
        $description    = $request->get('description');
        
        $metadata = array(
            'title'       => $title,
            'description' => $description,
        );

        $document = Video::find($id);
        $document->update($metadata);

        return;
    }

    public static function updateTags($id, $tags)
    {
        VideoTag::where('video_id', $id)->delete();
        foreach ($tags as $tag) {
            VideoTag::create([
               'video_id'     => $id,
               'tag_id'         => $tag
            ]);
        }
            
        return;
    }
}
