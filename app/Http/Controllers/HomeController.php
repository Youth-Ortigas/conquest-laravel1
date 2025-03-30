<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class HomeController
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since Mar 30, 2025
 */
class HomeController extends Controller
{
    /**
     * [View] Index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function index()
    {
        return view('welcome');
    }
}
