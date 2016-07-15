<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playlist extends Model
{
    use SoftDeletes;

    protected $table = 'playlists';
    protected $fillable = ['title', 'banner_id'];
    protected $dates = ['deleted_at'];

    public static function storePlaylist($request)
    {
    	 \Log::info($request->all());
         // $validate = Communication::validateCreateCommunication($request);
         // \Log::info($validate);
         // if($validate['validation_result'] == 'false') {
           // \Log::info($validate);
           // return json_encode($validate);
         // }  
         
   		
   		$playlist = Playlist::create([
   			'title' 	=> $request["title"],
   			'banner_id' => $request["banner_id"]
   		]);

   		Playlist::updatePlaylistVideos($playlist->id, $request);
   		return $playlist;

    }

    public static function updatePlaylist($id, $request)
    {
    	$playlist = Playlist::find($id);
    	$playlist['title'] = $request['title'];
    	$playlist->save();
    	Playlist::updatePlaylistVideos($id, $request);
    	return;
    }

    public static function updatePlaylistVideos($id, $request)
    {
    	$remove_videos = $request["remove_videos"];
         if (isset($remove_videos)) {
            foreach ($remove_videos as $video) {
               PlaylistVideo::where('playlist_id', $id)->where('video_id', intval($video))->delete();
            }
         }

         $add_videos = $request["playlist_videos"];
         if (isset($add_videos)) {
            foreach ($add_videos as $video) {
               PlaylistVideo::create([
                  'playlist_id'   => $id,
                  'video_id'      => $video
               ]);
            }
         }
         return;
    }

    public static function getPlaylistByBanner($banner_id)
    {
        $playlists = Playlist::join('playlist_videos', 'playlist_videos.playlist_id', '=', 'playlists.id')
                ->join('videos', 'videos.id', '=', 'playlist_videos.video_id')
                ->where('banner_id', $banner_id)
                ->where('playlist_videos.deleted_at', '=', null)
                ->where('videos.deleted_at', '=', null)
                ->where('playlists.deleted_at', '=', null)
                ->select ('playlists.title as playlist_title', 'playlists.banner_id', 'videos.*')
                ->get();
        
        return $playlists;
    }
}
