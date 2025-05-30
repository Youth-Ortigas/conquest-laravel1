<?php

namespace App\Http\Controllers;

use App\Traits\TraitsCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Puzzle;
use App\Models\PuzzleAttempt;
use App\Models\PuzzleGameState;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ValidatePuzzleKeyRequest;
use App\Models\TeamsMembers;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class DashboardController
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @author Johnvic Dela Cruz <delacruzjohnvic21@gmail.com>
 * @since Mar 30, 2025
 */
class DashboardController extends BaseController
{

    /**
     * [Traits] TraitsCommon class
     * @var object
     */
    use TraitsCommon;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * [View] Index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function index()
    {
        return view('dashboard');
    }
}
