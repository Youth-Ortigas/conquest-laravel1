<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class UpdateController
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since May 23, 2025
 */
class MaterialsController extends Controller
{
    /**
     * Materials Page
     *
     * @return void
     */
    public function index()
    {
        return view('materials');
    }
}
