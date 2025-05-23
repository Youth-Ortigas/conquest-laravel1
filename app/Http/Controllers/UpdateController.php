<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class UpdateController
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since May 23, 2025
 */
class UpdateController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() {
        return view('updates');
    }
}
