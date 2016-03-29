<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentTarget extends Model
{
    use SoftDeletes;
    protected $table = 'document_target';
    protected $fillable = ['document_id', 'store_id'];
    protected $dates = 'deleted_at';
}
