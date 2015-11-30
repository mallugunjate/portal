<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = ["id", 'package_screen_name', 'package_name', 'is_hidden'];

    public static function storePackage( Request $request)
    {

    }
}
