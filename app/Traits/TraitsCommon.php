<?php

namespace App\Traits;
use App\HelperFunctions;
use App\Models\UserActivityLog;

/**
 * Class TraitsCommon
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since Apr 13, 2025
 */
trait TraitsCommon
{
    /**
     * [Activity Logs] Create <user_activity_logs>
     * @param mixed $request
     * @param mixed $assignUserID
     * @param mixed $status
     * @return void
     */
    protected function createUserActivityLogin($request, $assignUserID, $status = "")
    {
        $currentURL = url()->current();
        $userActivityLog = new UserActivityLog();
        $userActivityLog->ual_sacred_code = $request->input('sacred_code') ?? "";
        $userActivityLog->ual_user_id = $assignUserID;

        $footprintData = (object)[
            'url'                 => $currentURL,
            'status'              => $status,
            'ip'                  => HelperFunctions::getRealIpAddr(),
            'browser'             => $request->header('User-Agent') ?? ""
        ];

        $userActivityLog->ual_footprint = serialize($footprintData);
        $userActivityLog->save();
    }
}
