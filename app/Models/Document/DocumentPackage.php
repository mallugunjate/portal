<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentPackage extends Model
{
    use SoftDeletes;
    protected $table = 'document_package';
    protected $fillable = ['document_id', 'package_id'];
    protected $dates = ['deleted_at'];
}
