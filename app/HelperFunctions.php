<?php
namespace App;

use App\Lib\LibUtility;
use App\Models\Acknowledgement;
use App\Models\Attachment;
use App\Models\CarryOverLeave;
use App\Models\Client;
use App\Models\ClientUser;
use App\Models\ClientTeam;
use App\Models\CssClient;
use App\Models\Document;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\EmployeeSchedule;
use App\Models\EmployeeSettingItems;
use App\Models\IpWhitelist;
use App\Models\Module;
use App\Models\ModuleRights;
use App\Models\Option;
use App\Models\PayrunAbsentLate;
use App\Models\PayrunNightDifferential;
use App\Models\PayrunOvertime;
use App\Models\Policy;
use App\Models\RoomReservation;
use App\Models\SystemConfiguration;
use App\Models\TicketCategory;
use App\Models\TimeTracker;
use App\Models\TimeTrackerLine;
use App\Models\TicketTrackerLine;
use App\Models\TrainingClassMember;
use App\Models\UserGroupLine;
use App\Models\UserSetting;
use App\Models\UserActivityLog;
use App\Services\ClientUsers\ServicesClientUsersGeneral;
use App\Services\EmployeeService;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use DateTime;
use DB;
use Spatie\Activitylog\Traits\LogsActivity;
use NumberFormatter;


class HelperFunctions {

    /**
     * [General] Get real IP address
     * @return mixed
     */
	public static function getRealIpAddr()
	{
        $ipAddress = $_SERVER['REMOTE_ADDR'];
		 if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
             $ipAddress=$_SERVER['HTTP_X_FORWARDED_FOR'];
		 } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
             $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
		 }

		 return $ipAddress;
	}

    /**
     * [General] Convert DB raw expression
     * @param $sqlStatement
     * @return mixed
     */
    public static function convertDBRawExpression($sqlStatement)
    {
        $queryRaw = DB::raw($sqlStatement);
        return $queryRaw->getValue(DB::connection()->getQueryGrammar());
    }

}
