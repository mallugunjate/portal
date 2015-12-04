<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;

class CommunicationDocument extends Model
{
    protected $table = 'communication_document';
    protected $fillable = ['communication_id', 'document_id'];
}
