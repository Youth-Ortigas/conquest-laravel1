<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Traits\TraitsCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class DocumentPublicController
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since May 20, 2025
 */
class DocumentPublicController extends BaseController
{

    /**
     * [Traits] TraitsCommon class
     * @var object
     */
    use TraitsCommon;

    public function __construct()
    {
    }

    /**
     * [Dashboard > Waiver Form] Show waiver form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function showWaiverFormPublic(Request $request, $regCode)
    {
        $regCodeInput = $regCode ?? "";
        $authUser = User::where([
            ["reg_code", "=", $regCodeInput]
        ]);

        $authUserID = $authUser->first()->id;
        $filePath = "/documents/waiverform/Conquest2025_WaiverFormMinor1.pdf";
        $fileName = str_replace(".pdf", "", basename($filePath));
        $documentID = 1;
        $saveURL = '/document-sign/save';

        $modelDocuments = Documents::where([
            ["doc_user_id", "=", $authUserID]
        ]);

        return view('auth.documents.waiver-form',
            compact('authUserID', 'fileName', 'filePath', 'documentID', 'saveURL', 'modelDocuments')
        );
    }
}
