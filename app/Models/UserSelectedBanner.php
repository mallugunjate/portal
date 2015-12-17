<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSelectedBanner extends Model
{
    protected $table = 'user_selected_banner';
    protected $fillable = ['user_id', 'selected_banner_id'];
}
