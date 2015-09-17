<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileFolder extends Model
{
    protected $table = 'file_folder';
    protected $fillable = array('document_id', 'folder_struct_id');
}
