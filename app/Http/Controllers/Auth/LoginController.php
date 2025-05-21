<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Traits\TraitsCommon;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\HelperFunctions;
use App\Models\UserActivityLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends BaseController
{

    /**
     * [Traits] Common class
     * @var object
     */
    use TraitsCommon;
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
    protected $redirectTo = '/puzzles';

    /**
     * Create a new controller instance.
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
        return redirect()->intended('/');
    }

    public function login(Request $request)
    {
        $assignUserID = -1;
    	$registrationCode =  $request->input('sacred_code');
        $checkUser = User::where('reg_code', $registrationCode)->first();
    	if ($checkUser) {
            Auth::login($checkUser);
            $assignUserID = Auth::user()->id;
            $this->createUserActivityLogin($request, $assignUserID, 'active');
            $assignRedirectURL = url('/puzzles');
            if (config('app.env') === 'production') {
                $assignRedirectURL = secure_url('/puzzles');
            }

            return redirect()->intended($assignRedirectURL);
    	}

        $status = 'You are not registered yet on Conquest Youth Camp! Go to Victory Ortigas Admin Booth to register';
        $this->createUserActivityLogin($request, $assignUserID, $status);
        return view('auth.login', compact('status'));
    }
}
