<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBanner extends Model
{
    protected $table = 'banner_user';

    protected $fillable = ['banner_id', 'user_id'];
}
