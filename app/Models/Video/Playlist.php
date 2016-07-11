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
}
