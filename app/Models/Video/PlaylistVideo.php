<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaylistVideo extends Model
{
    use SoftDeletes;

    protected $table = 'playlist_video';
    protected $fillable = ['playlist_id', 'video_id'];
    protected $dates = ['deleted_at'];
}
