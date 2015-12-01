<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = ["id", 'package_screen_name', 'package_name', 'is_hidden'];

    public static function storePackage( Request $request)
    {
    	return($request->all());
    	$documents = $request["documents"];
    	$package_name = $request["package_name"];
    }
}
