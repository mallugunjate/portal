<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;

class DocumentPackage extends Model
{
    protected $table = 'document_package';
    protected $fillable = ['document_id', 'package_id'];
}
