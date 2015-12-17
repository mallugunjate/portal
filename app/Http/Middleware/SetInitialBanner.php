<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserBanner;
use App\Models\UserSelectedBanner;

class SetInitialBanner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_id = \Auth::user()->id;
        $banner_id = UserBanner::where('user_id', $user_id)->first()->pluck('banner_id');
        
        if ( $banner_id == null ) {
            return redirect('/admin/login')->withErrors();
        }

        // $request->session()->put('banner_id', $banner_id);

        $session = UserSelectedBanner::create(['user_id' => $user_id, 'selected_banner_id' => 'banner_id']);
        \Log::info('***********db session');
        \Log::info($session);

        return $next($request);
    }
}
