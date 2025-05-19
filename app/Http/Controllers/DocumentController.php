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
use Illuminate\Routing\Controller as BaseController;

/**
 * Class DocumentController
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @author Johnvic Dela Cruz <delacruzjohnvic21@gmail.com>
 * @since May 15, 2025
 */
class DocumentController extends BaseController
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
        $authUserID = $this->getAuthUserID();
        $filePath = "/documents/waiverform/Conquest2025_WaiverFormMinor1.pdf";
        $fileName = str_replace(".pdf", "", basename($filePath));
        $documentID = 1;
        $saveURL = '/document-sign/save';

        return view('auth.documents.waiver-form',
            compact('authUserID', 'fileName', 'filePath', 'documentID', 'saveURL')
        );
    }

    public function saveWaiverForm(Request $request)
    {

    }
}
