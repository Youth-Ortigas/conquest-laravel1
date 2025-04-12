<?php

namespace App\Services;
use Carbon\Carbon;
use App\Lib\LibUtility;
use DB;

/**
 * Class ServicesAutoOneDB
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since Apr 12, 2025
 */
class ServicesAutoOneDB
{

    /**
     * [General] Console fetch save data
     * @return void
     */
    public function consoleFetchSaveData()
    {
        $sslContext = stream_context_create([
            'ssl' => [
                'verify_peer'      => false,
                'verify_peer_name' => false,
            ]
        ]);

        $fetchURLAPI = "https://onedb.everynation.org.ph/db/module/events2/registration/read?event_id=1918&congregation_id=10012";
        $checkData = file_get_contents($fetchURLAPI, false, $sslContext);
        if (strtolower(env("APP_ENV")) === "production") {
            $checkData = file_get_contents($fetchURLAPI);
        }

        $dataJSON = json_decode($checkData, true);
        if (LibUtility::isArray($dataJSON)) {
            dd($dataJSON);
        }

    }
}
