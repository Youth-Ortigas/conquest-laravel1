<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\HelperFunctions;
use App\Models\UserActivityLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
    	Auth::logout();
    	return redirect('/login');
    }

    public function login(Request $request)
    {
    	$email =  $request->input('email');
    	$password =  $request->input('password');
    	$assignUserID = -1;

    	if (Auth::attempt(['email' => $email, 'password' => $password, 'status_id' => 1])) {
    	    $assignUserID = Auth::user()->id;
    		if (Auth::user()->password_change == 2 || Carbon::now()->subMonths(3) > Auth::user()->password_changed_at) {
    		    $this->createUserActivityLogin($request, $assignUserID, 'passwor_expired');
    			$isExpired = true;
    			Auth::logout();
    			return view('auth.passwords.changepassword', compact('id','isExpired'));
    		}

            $this->createUserActivityLogin($request, $assignUserID, 'active');
            $assignRedirectURL = url('/dashboard');
            if (config('app.env') === 'production') {
                $assignRedirectURL = secure_url('/dashboard');
            }

            return redirect()->intended($assignRedirectURL);
    	}

        $status = 'The email and password you entered don\'t match.';
        if (Auth::attempt(['email' => $email, 'password' => $password, 'status_id' => 0])) {
            $assignUserID = Auth::user()->id;
            Auth::logout();
            $status = 'This account has been blocked.';
        }

        $this->createUserActivityLogin($request, $assignUserID, $status);
        return view('auth.login', compact('status'));
    }

    /**
     * [Activity Logs] Create <user_activity_logs>
     * @param mixed $request
     * @param mixed $assignUserID
     * @param mixed $status
     * @return void
     */
    protected function createUserActivityLogin($request, $assignUserID, $status)
    {
        $userActivityLog = new UserActivityLog();
        $userActivityLog->ual_email = $request->input('email');
        $userActivityLog->ual_user_id = $assignUserID;

        $footprintData = (object)[
            'url'                 => '/login',
            'status'              => $status,
            'ip'                  => HelperFunctions::getRealIpAddr(),
            'browser'             => $request->header('User-Agent') ?? ""
        ];

        $userActivityLog->ual_footprint = serialize($footprintData);
        $userActivityLog->save();
    }
}
