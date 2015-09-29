<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    protected $fillable = array('upload_package_id', 'original_filename', 'filename', 'title', 'description');
}
