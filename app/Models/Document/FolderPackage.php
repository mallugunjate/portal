<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FolderPackage extends Model
{
    use SoftDeletes;
    protected $table = 'folder_package';
    protected $fillable = ['folder_id', 'package_id'];
    protected $dates = ['deleted_at'];
}
