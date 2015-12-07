<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;

class CommunicationPackage extends Model
{
   protected $table = 'communication_package';
   protected $fillable = ['communication_id', 'package_id'];

}
