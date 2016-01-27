<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;

class FolderPackage extends Model
{
    protected $table = 'folder_package';
    protected $fillable = ['folder_id', 'package_id'];
}
