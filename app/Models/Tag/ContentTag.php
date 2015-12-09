<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Model;

class ContentTag extends Model
{
    protected $table = 'content_tag';
    protected $fillable = ['content_type', 'tag_id', 'content_id']; 
}
