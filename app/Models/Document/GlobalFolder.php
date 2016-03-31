<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GlobalFolder extends Model
{
    use SoftDeletes;
    protected $table = 'folder_ids';
    protected $fillable = array('folder_id' , 'folder_type');
    protected $dates = ['deleted_at'];
}
