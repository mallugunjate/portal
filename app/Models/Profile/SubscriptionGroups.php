<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class SubscriptionGroups extends Model
{
    protected $table  =  'subscription_groups';

    public static function getSubscriptionGroupList()
    {
    	return \DB::table('subscription_groups')->lists('name', 'id');
    }
}
