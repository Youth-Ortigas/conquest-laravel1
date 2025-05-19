<?php

namespace App\Http\Controllers;

use App\Traits\TraitsCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Google_Client;
use Google_Service_Drive;

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

    /**
     * [Google Drive] Save waiver form
     * @param Request $request
     * @return string
     * @throws \Google\Exception
     * @throws \Google\Service\Exception
     */
    public function saveWaiverForm(Request $request)
    {
        $authUserRegCode = Auth::user()->reg_code ?? "";
        $authUserLastName = trim(str_replace(" ", "_", Auth::user()->last_name)) ?? "";
        $fileName = "Conquest2025_WaiverForm-$authUserRegCode-$authUserLastName.pdf";
        $folderID = "1UsyPfwSoRS8upXr6dDq5cbKRFnj-u0A_"; //@marylyn: https://drive.google.com/drive/u/3/folders/1UsyPfwSoRS8upXr6dDq5cbKRFnj-u0A_ -> Public GDrive link

        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(Google_Service_Drive::DRIVE_FILE);
        $client->setAccessType('offline');

        $driveService = new Google_Service_Drive($client);
        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name'     => $fileName,
            'mimeType' => 'application/pdf'
        ]);

        $fileMetadata->setParents([$folderID]);
        $file = $request->file('file');
        $contents = file_get_contents($file->getRealPath());
        $file = $driveService->files->create($fileMetadata, [
            'data'       => $contents,
            'mimeType'   => 'application/pdf',
            'uploadType' => 'multipart',
            'fields'     => 'id, name, webViewLink'
        ]);

        return $file->id;
    }
}
