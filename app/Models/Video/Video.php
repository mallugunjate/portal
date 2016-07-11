<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $table = 'videos';
    protected $fillable = ['title', 'description', 'uploader_id', 'likes', 'dislikes', 'featured'];
    protected $dates = ['deleted_at'];

    public static function getAllVideos()
    {
    	return Video::all();
    }
}
