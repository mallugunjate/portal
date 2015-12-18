<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;

class CommunicationTarget extends Model
{
   protected $table = 'communications_target';
   protected $fillable = ['communication_id', 'store_id'];
}
