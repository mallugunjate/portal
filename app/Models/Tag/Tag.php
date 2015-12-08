<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name', 'banner_id'];

    public static function storeTag($request)
    {
    	Tag::create([
    		'name' => $request['tag_name'],
    		'banner_id' => $request['banner_id']
    	]);
    	return;
    }

    public static function updateTag($id, $request)
    {	
    	$tag = Tag::find($id);
    	$tag->name = $request["tag_name"];
    	$tag->save();
    	return;
    }	
}
