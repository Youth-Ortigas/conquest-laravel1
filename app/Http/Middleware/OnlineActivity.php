<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\InternetConnection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\User;
use App\HelperFunctions;

class OnlineActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
    	$user = Auth::user();
    	if ($user){
    	    
    	    //check if disable internet monitoring is not set to ON
    	    if(!HelperFunctions::isEmployeeSettingsON($user->id, 'DTTA-INTERNET')){
    	        
        	    $onlineData = InternetConnection::where('icn_user_id', $user->id)->whereNull('icn_offline_timestamp')->orderby('icn_id','desc')->first();
        	    if($onlineData == null){
        	        $onlineData = new InternetConnection();
        	        $onlineData->created_by = $user->id;
        	        $onlineData->icn_user_id = $user->id;
        	        $onlineData->icn_initial_timestamp = Carbon::now()->timezone(config('constants.DEFAULT_TIMEZONE'));
        	    }else{
        	        $onlineData->modified_by = $user->id;
        	    }
        	    
        	    $onlineData->icn_last_timestamp = Carbon::now()->timezone(config('constants.DEFAULT_TIMEZONE'));
        	    $pos = strpos($request->path(), '/time-out/');
        	    if ($pos !== false) {
        	        $onlineData->icn_offline_timestamp = Carbon::now()->timezone(config('constants.DEFAULT_TIMEZONE'));
        	    }
        	    
        	    $onlineData->save();
    	    }
    	}
        		
       	return $next($request);
    }
}
