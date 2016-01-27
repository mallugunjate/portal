<?php

namespace App;

class Skin 
{
    public static function getSkin($id)
    {
    	$banner ="";
    	switch($id){
    		case 1: 
    			$banner = "sportchek";
    			break;

    		case 2: 
    			$banner = "atmosphere";
    			break;

    		default:
    		    $banner = "sportchek";
    			break;

    	}

    	return '<link rel="stylesheet" type="text/css" href="/css/skins/'.$banner.'/skin.css">';
    }
}
