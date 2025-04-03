<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class PuzzlesController
 * @author Johnvic Dela Cruz <dealcruzjohnvic21@gmail.com>
 * @since Apr 03, 2025
 */
class UpdatesController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() {
        return view('welcome');
    }
}
