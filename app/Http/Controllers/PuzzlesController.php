<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class PuzzlesController
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since Mar 30, 2025
 */
class PuzzlesController extends Controller
{
    /**
     * [View] Index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function index()
    {
        return view('puzzles');
    }

    /**
     * [View] Details page
     * @param Request $request
     * @param $reference
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object|void
     */
    public function getDetails(Request $request, $reference)
    {
        if(view()->exists("puzzles/puzzles-$reference")) {
            return view("puzzles/puzzles-$reference");
        }

        abort(404);
    }
}
