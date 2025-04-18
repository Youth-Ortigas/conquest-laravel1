<?php

namespace App\Traits;
use App\HelperFunctions;
use App\Models\UserActivityLog;
use Illuminate\Support\Facades\Auth;

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

    /**
     * [Users] Get <users.id>
     * @return mixed
     */
    protected function getAuthUserID()
    {
        return Auth::user()->id ?? -1;
    }
}
