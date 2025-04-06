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
	 * Method that return all the names of a calendar Days
	 * @return Array[]
	 */
	public static function weekDays(){
		return [0=>'Sunday',1=>'Monday',2=>'Tuesday',3=>'Wednesday',4=>'Thursday',5=>'Friday',6=>'Saturday'];
	}
	
	/**
	 * Method that return all the names of a calendar months
	 * @return Array[]
	 */
	public static function calendarMonths(){
		$months = [];
		for ($m=1; $m<=12; $m++) {
			$months[$m -1] = date('F', mktime(0,0,0,$m,1));
		}
		
		return $months;
	}
	
	/**
	 * Method that return a list of years based on provided range
	 * @return Array[]
	 */
	public static function calendarYears($from, $to='current',$order='ASC'){
	    $from = intval($from);
	    if($to == 'current'){
	        $to = Carbon::now()->year;
	    }else{
	        $to = intval($to);
	    }
	    
	    $years = [];
	    if($order == 'DESC'){
	        for ($y=$to; $y>=$from; $y--) {
	            $years[$y] = $y;
	        }
	    }else{
	        for ($y=$from; $y<=$to; $y++) {
	            $years[$y] = $y;
	        }
	    }
	    
	    return $years;
	}
	
	/**
	 * 
	 * @param string $message
	 * @return StdClass
	 */
	public static function createErrorObject($message){
		
		$error = (object) [
			'message' => $message,
			'status' => 'error',
		];
		
		return $error;
		
	}
	
	/**
	 *
	 * @param string $message
	 * @return StdClass
	 */
	public static function createInfoObject($message){
		
		$info = (object) [
				'message' => $message,
				'status' => 'info',
		];
		
		return $info;
		
	}
	
	/**
	 * Method that manage HTML filter formatting on the string value provided.
	 * @param string $strValue
	 * @return string
	 */
	public static function definition_filter($strValue){
	
		$returnHTML = '';
		if($strValue != null && $strValue != ''){
			$arr = explode("\n", $strValue);
			foreach($arr as $str){
				if($str == ''){
					$returnHTML .= '<br/>';
				}else{
					$returnHTML .= '<p>'.$str.'</p>';
				}
			}
		}
	
		return $returnHTML;
	}
	
	/**
	 * Method that return the current Date in a date string format specified. 
	 * @param string $format
	 */
	public static function currentDateTimeFormatted($format=null){
		
		if($format == null || $format == ''){
			$format = 'F d Y H:i:s';
		}
		
		if(Auth::user()){
		    return Carbon::now(Auth::user()->timezone)->format($format);
		}else{
		    return Carbon::now()->format($format);
		    
		}
	}
	
	public static function currentDateFormatted($format=null){
	    
	    if($format == null || $format == ''){
	        $format = config('constants.DEFAULT_DATE_FORMAT');
	    }
	    
	    if(Auth::user()){
	        return Carbon::now(Auth::user()->timezone)->format($format);
	    }else{
	        return Carbon::now()->format($format);
	        
	    }
	}
	
	public static function getCurrentDateTime(){
	    if(Auth::user()){
		  return Carbon::now(Auth::user()->timezone);
	    }else{
	        return Carbon::now();
	    }
	}
	
	/**
	 * Convert a Date into a String using the default date string format.
	 * @param Date $date
	 * @return string
	 */
	public static function dateFieldValueFormatted($date){
		
		if($date){
			return $date->format(config('constants.DEFAULT_DATE_FORMAT'));
		}else{
			return '';
		}
	}
	
	/**
     * Check if supplied datetime string is a valid date
     */
    public static function formatDBDate(string $dateString)
    {		
		return \Carbon\Carbon::parse($dateString)->format(config('constants.DB_DATE_FORMAT'));
    }

	/**
	 * Method that convert a Date into a String with desired date string format.
	 * @param Date $date
	 * @param string $format
	 * @return string
	 */
	public static function dateTimeFormatted($date, $format){
		
		if($date){
			if($format == null || $format == ''){
				$format = 'F d Y H:i:s';
			}
			
			if(Auth::user()){
			    $date = Carbon::parse($date)->setTimezone(Auth::user()->timezone);
			}
		
			return $date->format($format);
			
		}else{
			return '';
		}
	}
	
	/**
	 * Method that retrieve the value of a time string section
	 * @param string $value
	 * @param string $part
	 * @return string
	 */
	public static function getTimeFieldValue($value, $part, $isdatetime){
		if($value){
			
		    $value = preg_replace('/[^A-Za-z0-9.: -]/', '', $value);
		    
			if($isdatetime){
				$timeVal = Carbon::parse($value);
			}else{
				$timeVal = Carbon::parse('2016-01-01 '.$value);
			}
			
			if($part == 'hours'){
				return intval($timeVal->format('g'));
			}else if($part == 'minutes'){
				return $timeVal->format('i');
			}else if($part == 'ampm'){
				return $timeVal->format('a');
			}
		}
		
		return '';
	}
	
	public static function getTimeFormattedValue($value, $format=null, $isstring=true){
		if($value){
				
			if($isstring){
				$timeVal = Carbon::parse($value);
			}
			
			if($format == null){
				$format = config('constants.DEFAULT_TIME_FORMAT');
			}
			
			return $timeVal->format($format);
		}
	
		return '';
	}
	
	/**
	 * Method that dynamically create menu base on the currently logged-in user defined rights.
	 */
	public static function generateMainMenu(){
		
		$userprofile = Auth::user();
		$menulist = Module::getUserMenus($userprofile);
		$currentPath= Route::getFacadeRoot()->current()->uri();
		$returnMenu = '';
		foreach($menulist as $menuitem){
			if($menuitem['mod_parent'] == 1){
				$submenulist = HelperFunctions::getSubMenus($menulist, $menuitem['id']);
				if($submenulist != null && count($submenulist) > 0){
					$subMenu = '';
					$submenuActive = false;
					foreach($submenulist as $submenuitem){
						if($currentPath != '/' && strrpos($submenuitem['mod_url'], substr($currentPath, 0, strlen($submenuitem['mod_url']) - 2)) > 0){
							$subMenu .= '<li class="active"><a title="" href="'.$submenuitem['mod_url'].'">'.$submenuitem['mod_name'].'</a></li>';
							$submenuActive = true;
						}else{
							$subMenu .= '<li><a title="" href="'.$submenuitem['mod_url'].'">'.$submenuitem['mod_name'].'</a></li>';
						}
					}
					if($currentPath != '/' && $submenuActive){
						echo '<li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$menuitem['mod_name'].' <b class="caret"></b></a>';
					}else{
						echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$menuitem['mod_name'].' <b class="caret"></b></a>';
					}
					
					echo '<ul class="dropdown-menu">';
					echo $subMenu;
					echo '</ul>';
					echo '</li>';
				}else{
					if( ( ($currentPath == '/' || $currentPath == 'home') && $menuitem['mod_url'] == '/dashboard') || ($currentPath != '/' && strrpos($menuitem['mod_url'], substr($currentPath, 0, strlen($menuitem['mod_url']) - 2)) > 0)) {
						echo '<li class="active"><a href="'.$menuitem['mod_url'].'">'.$menuitem['mod_name'].'</a></li>';
					}else{
						echo '<li><a href="'.$menuitem['mod_url'].'">'.$menuitem['mod_name'].'</a></li>';
					}
				}
			}
		}
		
		//return $returnMenu;
	}
	
	/**
	 * Method that manage in retrieving the submenu items of the specified parent menu
	 * @param Array $menulist
	 * @param int $parentId
	 */
	public static function getSubMenus($menulist, $parentId){
		
		$submenulist = [];
		//var_dump($menulist);
		foreach($menulist as $menuitem){
			//var_dump($menuitem['name'].'>>>'.$menuitem['menu_parent'].'>>>'.$parentId);
			if($menuitem['mod_parent'] == $parentId){
				array_push($submenulist, $menuitem);
			} 
		}
		
		return $submenulist;
	}
	
	/**
	 * 
	 * @param User $userprofile
	 * @param Request $filter
	 */
	public static function getTimeTrackerGridList($userprofile, $filter){
		
		$timeTrackerList = [];
		if($userprofile->type_id == config('constants.SUPER_ADMIN')){
			$timeTrackerList = TimeTracker::getAllUserTracker(true);
		}else{
			$timeTrackerList = TimeTracker::getTrackerByUserID($userprofile->id, $filter);
		}
		
		return $timeTrackerList;
	}
	
	/**
	 * Method that create calendar event object on the dashbord calendar display 
	 * @param Collection $calendarevents
	 * @return string
	 */
	public static function generateCalendarEventDisplay($calendarevents, $trainingSchedules){
		
		$eventStr = '';
		foreach($calendarevents as $item){
			if($eventStr != ''){
				$eventStr .= ",";
			}
			
			$eventStr .= '"'.$item->cal_start_date->format('m-d-Y').'" : "<div class=\"fc-event-item\">'.$item->cal_name.'</div>"';
			
			if($item->cal_end_date != null && $item->cal_start_date != $item->cal_end_date){
				
				$numdays = $item->cal_end_date->diffInDays($item->cal_start_date);
				for($i = 1; $i <= $numdays; $i++){
					$newScheduleDate = $item->replicate();
					$newScheduleDate->cal_start_date = $item->cal_start_date->addDays($i);
					$eventStr .= ',"'.$newScheduleDate->cal_start_date->format('m-d-Y').'" : "<div class=\"fc-event-item\">'.$item->cal_name.'</div>"';
				}
			}
		}
		
		foreach ($trainingSchedules as $item){
			if($eventStr != ''){
				$eventStr .= ",";
			}
				
			$eventStr .= '"'.$item->dateFromFormatted.'" : "<div class=\"fc-event-item\">'.$item->trc_title.'</div>"';
			if($item->tcs_date_to != null && $item->tcs_date_from != $item->tcs_date_to){
				$numdays = $item->tcs_date_to->diffInDays($item->tcs_date_from);
				for($i = 1; $i <= $numdays; $i++){
					$newScheduleDate = $item->replicate();
					$newScheduleDate->tcs_date_from = $item->tcs_date_from->addDays($i);
					$eventStr .= ',"'.$newScheduleDate->tcs_date_from->format('m-d-Y').'" : "<div class=\"fc-event-item\">'.$item->trc_title.'</div>"';
				}
			}
		}
		
		return $eventStr;
	}
	
	public static function generatePilotProgramDisplay($pilotPrograms)
	{
		$eventStr = '';

		foreach ($pilotPrograms as $item) {
			if ($eventStr != '') {
				$eventStr .= ",";
			}

			$startDate = $item->pip_start_date ? $item->pip_start_date->format('Y-m-d') : null;
			$eventStr .= '{ "title": "' . $item->pip_title . '", "start": "' . $startDate . '"';

			if (is_null($item->pip_end_date)) {
				$eventStr .= ', "allDay": true';
			} else {
				$endDate = $item->pip_end_date ? $item->pip_end_date->format('Y-m-d') : null;
				$eventStr .= ', "end": "' . $endDate . '"';
			}

			$eventStr .= ', "content": "' . $item->pip_title . '"';
			$eventStr .= ', "color": "#26cbd3"';

			$eventStr .= '}';
		}

		return $eventStr;
	}
	
	public static function generateCalendarEventDisplay2($calendarevents,$trainingSchedules, $holidays, $empLeaves=[], $myRepTrainingSchedules=[]){
		$eventStr = '';
		foreach($calendarevents as $item){
			if($eventStr != ''){
				$eventStr .= ",";
			}
			
			$eventStart = $item->cal_start_date->format('Y-m-d');
			if($item->cal_start_time != null){
				$eventStart .= ' '.$item->cal_start_time;
			}
			
			$eventStr .= '{ "title": "'.$item->cal_name.'", "start": "'.$eventStart.'"';
			if($item->cal_end_date != null && $item->cal_start_date != $item->cal_end_date){
				$eventEnd = $item->cal_end_date->format('Y-m-d');
				if($item->cal_end_time != null){
					$eventEnd .= ' '.$item->cal_end_time;
				}else{
					$eventEnd = $item->cal_end_date->addDay()->format('Y-m-d');
				}
				$eventStr .= ', "end": "'.$eventEnd.'"';
			}else if($item->cal_end_time != null){
				$eventEnd = $item->cal_start_date->format('Y-m-d').' '.$item->cal_end_time;
				$eventStr .= ', "end": "'.$eventEnd.'"';
			}
			
			if($item->cal_start_time == null || $item->cal_end_time == null){
				$eventStr .= ', "allDay" : true';
			}

			$eventStr .= ', "content" : "'.$item->cal_name.'"';
			$eventStr .= ', "color" : "#26cbd3"';
			$eventStr .= '}';
		}
		
		foreach($holidays as $item){
			if($eventStr != ''){
				$eventStr .= ",";
			}

			$eventStr .= '{ "title": "'.$item->holidayName.'", "start": "'.$item->hde_date->format('Y-m-d').' 00:00:00"';
			if ($item->hde_city_id > 1) $eventStr .= ', "content" : "'.$item->holidayName.' ('.$item->city->cit_name.')"';
			else $eventStr .= ', "content" : "'.$item->holidayName.'"';
			if ($item->hde_country_id > 1) $eventStr .= ', "imageurl" : "'.asset('images/flags/4x3/'.strtolower($item->country->cou_code).'.svg').'"';
			$eventStr .= ', "allDay" : true';
			$eventStr .= '}';
		}
	
		foreach ($trainingSchedules as $item){
			if(Auth::user()->SherpaSupervisor) break; //disable this if user is sherpa client

			if (isset($item->hasParticipants) && !$item->hasParticipants) continue;
			
			if($eventStr != ''){
				$eventStr .= ",";
			}

			$eventStr .= '{ "title": "'.$item->trc_title.'", "start": "'.$item->tcs_date_from->format('Y-m-d').' '.$item->tcs_time_start.'"';
			if (is_null($item->tcs_date_to)) {
				$eventStr .= ', "allDay" : true';
			}
			else {
				$eventStr .= ', "end": "'.$item->tcs_date_to->format('Y-m-d').' '.$item->tcs_time_end.'"';
			}
			$eventStr .= ', "content" : "'.$item->trc_title.'"';
			$eventStr .= ', "color" : "#337ab7"';
			$eventStr .= '}';	
		}

		foreach ($empLeaves as $item) {	
			if($eventStr != ''){
				$eventStr .= ",";
			}

			$eventStr .= '{ "title": "'.$item->type_code.' ('.$item->stat_name.')'.' - '.$item->fullName.'", "start": "'.$item->eml_date_from->format('Y-m-d').'"';
			if (!is_null($item->eml_date_to)) $eventStr .= ', "end": "'.$item->eml_date_to->addDay()->format('Y-m-d').'"';
			$eventStr .= ', "content" : "'.$item->type_code.' ('.$item->stat_name.')'.' - '.$item->fullName.'"';
			$eventStr .= ', "allDay" : true';
			
			if(Auth::user()->SherpaSupervisor){
				$eventStr .= ($item->type_code == 'HOL') ? ', "color" : "#59b0f8"' : ', "color" : "#f8e164"';
				$eventStr .= ($item->type_code == 'VL') ? ', "color" : "#e59c9c"' : '';
				$eventStr .= ($item->type_code == 'SL') ? ', "color" : "#08c898"' : '';
			}else{
				$eventStr .= ', "color" : "#01b287"';
			}

			$eventStr .= '}';	
		}

		foreach ($myRepTrainingSchedules as $item){
			if($eventStr != ''){
				$eventStr .= ",";
			}

			$eventStr .= '{ "title": "'.$item->mtb_name.'", "start": "'.$item->mts_date_from->format('Y-m-d').' '.$item->mts_time_start.'"';
			if (is_null($item->mts_date_to)) {
				$eventStr .= ', "allDay" : true';
			}
			else {
				$eventStr .= ', "end": "'.$item->mts_date_to->format('Y-m-d').' '.$item->mts_time_end.'"';
			}
			$eventStr .= ', "content" : "'.$item->mtb_name.'"';
			$eventStr .= ', "color" : "#337ab7"';
			$eventStr .= '}';	
		}
	
		return $eventStr;

	}
	
	/**
	 * 
	 * @param string $day
	 * @param Collection $source
	 * @return StdClass
	 */
	public static function getDayScheduleData($day, $source){
		if($source){
			foreach ($source as $item){
				if($item['day'] == $day){
					return $item;
				}
			}
		}
		return null;
	}
	
	public static function getDayScheduleTime($schedule){
		
		$currDay = Carbon::now(Auth::user()->timezone)->format('l');
		
		$dayData = HelperFunctions::getDayScheduleData($currDay, unserialize($schedule));
		$startTime = strtoupper($dayData['start_time']);
		$endTime = strtoupper($dayData['end_time']);
		
		return $startTime.' - '.$endTime;
	}
	
	/**
	 * Method that check if the Day value is the same from one of the schedule dates collection.
	 * @param string $field
	 * @param string $value
	 * @param string $day
	 * @param Collection $source
	 * @return boolean
	 */
	public static function isEqualDaySchedule($field, $value, $day, $source) {
		if ($source != null) {
			foreach ($source as $item){
				if($item['day'] == $day){
					if(array_key_exists($field, $item) && $item[$field] != '' && $item[$field] == $value){
						return true;
					}else{
						return false;
					}
				}
			}
		}
		
		return false;
	}
	
	/**
	 * Method that check if current logged in user has access to view the module specified.
	 * @param string $moduleCode
	 * @return boolean
	 */
	public static function canViewRecord($moduleCode){
		 
		if(Auth::user()->isSuperAdmin){
			return true;
		}else{
			return HelperFunctions::checkUserPermissionRightsByCode('view', Auth::user(), $moduleCode);
		}
	}
	
	/**
	 * Method that check if current logged in user can add new record on the module specified.
	 * @param string $moduleCode
	 * @return boolean
	 */
	public static function canAddRecord($moduleCode){
	
		if(Auth::user()->isSuperAdmin){
			return true;
		}else{
			return HelperFunctions::checkUserPermissionRightsByCode('add', Auth::user(), $moduleCode);
		}
	}
	
	/**
	 * Method that check if current logged in user can edit records on the module specified.
	 * @param string $moduleCode
	 * @return boolean
	 */
	public static function canEditRecord($moduleCode){
	
		if(Auth::user()->isSuperAdmin){
			return true;
		}else{
			return HelperFunctions::checkUserPermissionRightsByCode('edit', Auth::user(), $moduleCode);
		}
	}
	
	/**
	 * Method that check if current logged in user can delete records on the module specified.
	 * @param string $moduleCode
	 * @return boolean
	 */
	public static function canDeleteRecord($moduleCode){
	
		if(Auth::user()->isSuperAdmin){
			return true;
		}else{
			return HelperFunctions::checkUserPermissionRightsByCode('delete', Auth::user(), $moduleCode);
		}
	}
	
	/**
	 * Method that check if current logged in user can delete records on the module specified.
	 * @param string $moduleCode
	 * @return boolean
	 */
	public static function canAddEditOrDeleteRecord($moduleCode){
	
		if(Auth::user()->isSuperAdmin 
			|| HelperFunctions::checkUserPermissionRightsByCode('add', Auth::user(), $moduleCode) 
			|| HelperFunctions::checkUserPermissionRightsByCode('edit', Auth::user(), $moduleCode)
			|| HelperFunctions::checkUserPermissionRightsByCode('delete', Auth::user(), $moduleCode)){
			
			return true;
		}
		
		return false;
	}
	
	/**
	 * Method that check for user permission rights.
	 * @param string $type
	 * @param User $userprofile
	 * @param string $moduleCode
	 * @return boolean
	 */
	public static function checkUserPermissionRightsByCode($type, $userprofile, $moduleCode){
		
		$userModules = HelperFunctions::getModuleUserRightsByCode($userprofile, $moduleCode);
		foreach($userModules as $item){
			switch ($type){
				case 'view':
					if($item->mdr_view_perm == 1){
						return true;
					}
					break;
				case 'add':
					if($item->mdr_add_perm == 1){
						return true;
					}		
					break;
				case 'edit':
					if($item->mdr_edit_perm == 1){
						return true;
					}
					break;
				case 'delete':
					if($item->mdr_delete_perm == 1){
						return true;
					}
					break;
				default:
					break;
			}
		}
		
		return false;
	}
	
	public static function checkUserPermissionRights($type, $reqPath, $refresh=false, $sessionSave=false, $userId=0){
	
		if($userId > 0){
			$userProfile = User::find($userId);
			//check if user is an active employee
			if($userProfile && $userProfile->type_id == config('constants.USER_EMPLOYEE')){
				$employeeData = Employee::where('emp_isactive', '>', 0)
					// ->where('emp_rehire', '=', 0)
					->where('emp_employment_status', '=', config('constants.OPT_EMP_STAT_ACTIVE'))->first();
				
				if($employeeData == null || $employeeData->user->status_id < 1){
					return false;
				}
			}
		}else{
			$userProfile = Auth::user();
		}
		
		if(!$userProfile){
		    return false;
		}

		if($userProfile->type_id != config('constants.SUPER_ADMIN') ){

			$origReqPath = $reqPath;
			$mode = 'view';
			$isCRUD = false;

            if (strpos($reqPath, '/list') > 0) {
                $reqPath = substr($reqPath, 0, strpos($reqPath, '/view'));
                $isCRUD = true;
                $mode = 'view';
            }
            if (strpos($reqPath, '/save') > 0) {
                $reqPath = substr($reqPath, 0, strpos($reqPath, '/view'));
                $isCRUD = true;
                $mode = 'view';
            }
			if (strpos($reqPath, '/view') > 0) {
        		$reqPath = substr($reqPath, 0, strpos($reqPath, '/view'));
        		$isCRUD = true;
        		$mode = 'view';
        	}else if (strpos($reqPath, '/edit') > 0) {
       			$reqPath = substr($reqPath, 0, strpos($reqPath, '/edit'));
       			$isCRUD = true;
       			$mode = 'edit';
       		}else if (strpos($reqPath, '/add') > 0) {
       			$reqPath = substr($reqPath, 0, strpos($reqPath, '/add'));
       			$isCRUD = true;
       			$mode = 'add';
       		}else if (strpos($reqPath, '/create') > 0) {
       			$reqPath = substr($reqPath, 0, strpos($reqPath, '/create'));
       			$isCRUD = true;
       			$mode = 'add';
       		}else if (strpos($reqPath, '/update') > 0) {
       			$reqPath = substr($reqPath, 0, strpos($reqPath, '/update'));
       			$isCRUD = true;
       			$mode = 'edit';
       		}else if (strpos($reqPath, '/delete') > 0) {
       			$reqPath = substr($reqPath, 0, strpos($reqPath, '/delete'));
       			$isCRUD = true;
       			$mode = 'delete';
       		}else if (strpos($reqPath, '/online') > 0) {
       			$mode = 'strict';
       			$type = 'view';
       		}else if (strpos($reqPath, 'mployee/payroll/payslip') > 0) {
                $sOriginalPath = "account/payslip/view";
                $reqPath = substr($sOriginalPath, 0, strpos($sOriginalPath, '/view'));
                $isCRUD = true;
                $mode = 'view';
            } else if (strpos($reqPath, 'filter') > 0) {
                $sOriginalPath = "hmo-account";
                $reqPath = substr($sOriginalPath, 0, strpos($sOriginalPath, '/view'));
                $isCRUD = true;
                $mode = 'view';
            }



            if($type == null){
       			$type = $mode;
       		}

	        $reqPathParts = explode('/', $reqPath);
	        $modulePath = '';
	        foreach($reqPathParts as $str){
	        	if (ctype_digit($str) && $mode != 'strict'){
	        		$modulePath .= '/ID';
	        	}else{
	        		$modulePath .= '/'.$str;
	        	}
	        }

	        $userModules = Session::get('moduleRights');

	        if($userModules == null || $refresh){
		        $userModules = HelperFunctions::getModuleUserRights($userProfile);
		        if($isCRUD){
		        	$userModules = $userModules->where('modules.mod_url', 'like', $modulePath.'%')->get();
		        }else{
		        	$userModules = $userModules->where('modules.mod_url', '=', $modulePath)->get();
		        }

		        if($sessionSave){
		        	Session::put('moduleRights', $userModules);
		        }
	        }

	        $haveAccess = false;
	        foreach($userModules as $item){
	        	if($type == 'view' && $item->mdr_view_perm == 1){
		       		$haveAccess = true;
		       		break;
		       	}else if($type == 'add' && $item->mdr_add_perm == 1){
		       		$haveAccess = true;
		       		break;
		       	}else if($type == 'edit' && $item->mdr_edit_perm == 1){
		       		$haveAccess = true;
		       		break;
		       	}else if($type == 'delete' && $item->mdr_delete_perm == 1){
		       		$haveAccess = true;
		       		break;
		       	}else if($type == 'report' && $item->mdr_report_perm == 1){
		       		$haveAccess = true;
		       		break;
		       	}else if($type == 'addedit' && ($item->mdr_add_perm == 1 || $item->mdr_edit_perm == 1) ){
		       		$haveAccess = true;
		       		break;
		       	}else if($type == 'crud' && ($item->mdr_add_perm == 1 || $item->mdr_edit_perm == 1 || $item->mdr_delete_perm == 1) ){
		       		$haveAccess = true;
		       		break;
		       	}
			}

			// additional security check for client user on employee module
			$empPath = substr($origReqPath, 0, strlen('account/employee/'));
			if($haveAccess && $userProfile->isClient && $empPath == 'account/employee/' && !Auth::user()->isManagementSupervisor){
				$recId = (int)preg_replace('/[^\-\d]*(\-?\d*).*/','$1',$origReqPath);
				$cltUser = ClientUser::getClientUserDetailsByUserID($userProfile->id);
				if($cltUser){
					if($cltUser->clu_level == config('constants.OPT_SUPERLVL_SECOND')){
						if($cltUser->client_team_id != null && $cltUser->client_team_id != ''){
							$employeeList = Employee::getEmployeesByClientTeamID($cltUser->client_team_id);
						}else{
							$employeeList = Employee::getActiveEmployees()->where('emp_client_id', $cltUser->clu_client_id );
						}

					}else{
						$employeeList = Employee::getEmployeesByClientID($cltUser->clu_client_id)->where("emp_employment_status", config('constants.OPT_EMP_STAT_ACTIVE'));
					}

					$employeeList = $employeeList->where('employees.id', $recId)->get();
					if(count($employeeList) == 0){
						$haveAccess = false;
					}

					if ($cltUser->clu_level == config('constants.OPT_SUPERLVL_TOP')) {
						$haveAccess = true;
					}
					//\Log::info('test>>>'.$haveAccess.'<<'.$origReqPath.'>>>>'.$cltUser->clu_level.'<<<'.$recId);
				}else{
					$haveAccess = false;
				}
			}

			return $haveAccess;

		}else{
			return true;
		}
	}


	/**
	 * Method that retrieves all modules a specific user has access.
	 * @param User $userprofile
	 * @param string $moduleCode
	 */
	public static function getModuleUserRightsByCode($userprofile, $moduleCode){

		$userModules = HelperFunctions::getModuleUserRights($userprofile);
		return $userModules->where('modules.mod_code', $moduleCode)->get();

	}

	public static function getModuleUserRights($userprofile){

		$groups = HelperFunctions::getUserGroupRights($userprofile);
		return Module::distinct()->select('*')
			->leftjoin('module_rights', 'module_rights.mdr_module_id', '=', 'modules.id')
			->where('modules.mod_isactive', 1)
			->where(function($query) use($groups,$userprofile) {
				$query->whereIn('mdr_group_id',$groups)
				->orWhere('mdr_user_id',$userprofile->id);
				
			});
	}
	
	public static function getUserGroupRights($userprofile)
    {
		$userGroupLines = UserGroupLine::getActiveUserGroupLinesByUserId($userprofile->id);
		$groups = [];
		
		$cltUser = ClientUser::getClientUserDetailsByUserID($userprofile->id);
		if($userprofile->isEmployee){
			
			array_push($groups, config('constants.USER_GROUP_OPERATIONS'));
			if($userprofile->isInternalManagement){
			     array_push($groups, config('constants.DOSS_INTERNAL_MANAGEMENRT'));
			}
			
			$employeeData = $userprofile->employee;
			if($employeeData && ($employeeData->emp_client_id == config('constants.CLT_MYREPUBLIC_AU') 
			    || $employeeData->emp_client_id == config('constants.CLT_MYREPUBLIC_SG') 
			    || $employeeData->emp_client_id == config('constants.CLT_MYREPUBLIC_NZ')
			    || $userprofile->id == 530)){
				array_push($groups, config('constants.USER_GROUP_MYREPUBLIC_OPS'));
			}
			
			if($cltUser){
				array_push($groups, config('constants.USER_GROUP_CLIENT_SUP_MNGR'));
			}
			
		}else if($userprofile->isClient){
			array_push($groups, config('constants.USER_GROUP_CLIENT'));
			
			if($cltUser && $cltUser->clu_level == config('constants.OPT_SUPERLVL_TOP')){
				array_push($groups, config('constants.USER_GROUP_CLT_TOP_LVL_USER'));
			}
			
		}else if($userprofile->type_id == config('constants.USER_PROSPECT_CLIENT')){
			array_push($groups, config('constants.USER_GROUP_PROSPECT_CLIENT'));
		}
		
		foreach($userGroupLines as $lineitem){
			array_push($groups, $lineitem->ugl_group_id);
		}

		return $groups;
		
	}
	
	public static function getUserViewableDocumentTypeCodes(){
		
		//$userGroupLines = UserGroupLine::getActiveUserGroupLinesByUserId(Auth::user()->id);
		
		$groups = [];
		if(Auth::user()->type_id == config('constants.USER_EMPLOYEE')){
			array_push($groups, config('constants.USER_GROUP_OPERATIONS'));
		}else if(Auth::user()->type_id == config('constants.USER_CLIENT')){
			array_push($groups, config('constants.USER_GROUP_CLIENT'));
		}
		
		foreach(Auth::user()->userGroupLines as $lineitem){
			array_push($groups, $lineitem->ugl_group_id);
		}
			
		$moduleRights = ModuleRights::getModuleRightsByGroupIDs($groups)->where('mod_parent.mod_code','=','DOCS')->get();
		$documentCodes = [];
		foreach ($moduleRights as $item){
			array_push($documentCodes, $item->mod_code);
		}

		return $documentCodes;
	}
	
	public static function getUserViewableDocuments(){
		
		$documentCodes = HelperFunctions::getUserViewableDocumentTypeCodes();	
		if(Auth::user()->isSuperAdmin){
			$documents = Document::getDocumentList();
		}else{
			$cltUser = ClientUser::getClientUserAccountDetailsByUserID(Auth::user()->id);
			if($cltUser){
				$documents = Document::getDocumentsByClientID($cltUser->clu_client_id)->whereIn('options.code', $documentCodes);
			}else{
				$documents = Document::getDocumentsByEmployeeID(Auth::user()->employee->id);
			}
		}
		
		return $documents;
	}
	
	public static function sortableColumn($field, $path, $class=null){
		
	    $sortableAttr = ' class="sortable '.$class.' '.app('request')->input($field).'" data-field="'.$field.'"';
		$sortableAttr .= ' data-sorting="'.(app('request')->input($field) == 'ASC' ? 'DESC' : 'ASC').'"';
		$sortableAttr .= ' data-path="'.$path.'"';
		
		return $sortableAttr;
	}
	
	public static function checkUserEmailNotifSetting($userId, $field){
		
		$sendEmail = true;
		$userSettings = UserSetting::getUserSettingsByUserID($userId)->first();
		if($userSettings){
			$emailNotifSettings = $userSettings->emailNotificationSettings;
			// check if user change the setting not to receive late employee notification
			if($emailNotifSettings[$field] != 1){
				$sendEmail = false;
			}
		}
		
		return $sendEmail;
	}
	
	public static function checkDOSSEmployeeSpecialRights($userId, $teamIds){
		
		// check if employee was assigned on either user group support or HR
		$hrAndSupport = [config('constants.USER_GROUP_SUPPORT'), config('constants.USER_GROUP_HR'), config('constants.USER_GROUP_CSS')];
		$hrOrSupport = UserGroupLine::getUserGroupLinesByUserId($userId)->wherein('ugl_group_id', $hrAndSupport)->get();
		foreach ($hrOrSupport as $item){
			if($item->ugl_group_id == config('constants.USER_GROUP_SUPPORT')){
				array_push($teamIds, config('constants.DOSS_SUPPORT'));
			}elseif($item->ugl_group_id == config('constants.USER_GROUP_HR')){
				array_push($teamIds, config('constants.DOSS_HR'));
			}elseif($item->ugl_group_id == config('constants.USER_GROUP_CSS')){
				array_push($teamIds, config('constants.DOSS_CLIENT_SERVICE'));
			}
		}
		
		return $teamIds;
	}
	
	public static function isManagementSupport($userId){
		$teamIds = HelperFunctions::checkDOSSEmployeeSpecialRights($userId, []);
		if(count($teamIds) > 0){
			return true;
		}
		return false;
	}
	
	public static function isManagerAssistant($userId){
		$userGroupLines = UserGroupLine::getUserGroupLinesByUserId($userId)->where('ugl_group_id','=',config('constants.USER_GROUP_MNGR_ASST'))->first();
		if($userGroupLines){
			$employeeData = Employee::where('emp_user_id', $userId)
				->where('emp_user_id','>', 0)
				->where('emp_rehire', '=', 0)
				->where('emp_isactive', '=', 1)->first();

			return $employeeData;
		}else{
			return null;
		}
	}
	
	public static function checkStringArrayValue($str, $value){
		
		$valueArr = explode(',',$str);
		foreach($valueArr as $id){
			if($id == $value){
				return true;
			}
		}
		
		return false;
	}
	
	public static function clientUserEmployeeFilter($userId, $cltUser, $employeeDataList){
		
		$cltIdStr = '';
		
		// double check if user is also assigned as supervisor in other client
		$cltUserList = ClientUser::getClientUserListByUserID($userId)->get();
		$clientTeamIds = [];
		
		if(count($cltUserList) > 1){
			foreach($cltUserList as $item){
				if($cltIdStr != ''){
					$cltIdStr .=',';
				}
				$cltIdStr .= $item->clu_client_id;
				$clientTeamIds[] = $item->client_team_id;
			}
		}else{
			$cltIdStr .= $cltUser->clu_client_id;
			$clientTeamIds[] = $cltUser->client_team_id;
		}
		
		$employeeDataList->where(function($query) use($cltIdStr, $userId) {
			$query->wherein('emp_client_id', explode(',',$cltIdStr))
			->orWhere('emp_user_id', $userId);
		});

		if($cltUser->clu_level == config('constants.OPT_SUPERLVL_SECOND')){
			$employeeDataList->where(function($query) use($clientTeamIds, $userId) {
				$query->wherein('emp_client_team_id', $clientTeamIds)
				->orWhere('emp_user_id', $userId);
			});
		}else if($cltUser->clu_teams != null && $cltUser->clu_teams != ''){
		    $employeeDataList->where(function($query) use($cltUser, $userId) {
		        $query->wherein('emp_client_team_id', explode(',',$cltUser->clu_teams))
		        ->orWhere('emp_user_id', $userId);
		    });
		}
		
		return $employeeDataList;
	}
	
	public static function managerAssistantFilter($listData, $userId, $teamId){

		return $listData->wherein('emp_client_team_id', explode(',',$teamId))->where('users.id', '!=', $userId);
		
	}
	
	public static function getRealIpAddr()
	{
		 if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){   //to check ip is pass from proxy
		 	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		 	
		 }elseif (!empty($_SERVER['HTTP_CLIENT_IP'])){   //check ip from share internet
		 	$ip=$_SERVER['HTTP_CLIENT_IP'];
		 	
		 }else{
		 	$ip=$_SERVER['REMOTE_ADDR'];
		 }
		  
		 return $ip;
	}
	
	public static function checkAllowedIP(){
		
	    return true;
	    
		/* $dataItem = IpWhitelist::getIpDetailByIPAddress(HelperFunctions::getRealIpAddr());
		
		if(count($dataItem) > 0){
			return true;
		}
		
		return false; */
		
	}
	
	public static function userWithOffsiteSchedule($userId, $currDay){

	    $user = User::find($userId);
	    if($user && $user->isEmployee && $user->employee->enableIPBlocker && !$user->employee->isWFH){
	         $allowedIP = HelperFunctions::checkAllowedIP();
	         if(!$allowedIP){
	               $schedule = EmployeeSchedule::getScheduleByUserID($userId);
	               if($schedule != null){
	                   $allowedIP = HelperFunctions::isEqualDaySchedule('offsite', 1, $currDay, $schedule->daysTimeDataArr);
	               }
	         }
	         return $allowedIP;
	    }

	    return true;
		
	}
	
	public static function getTrainingQuestionsWithWrongAnswers($data){
		
	    $returnStr = '';
	    if($data){
    		$cmiData = unserialize($data);
    		
    		if(array_key_exists('interactions', $cmiData)){
    			$interactions = $cmiData['interactions'];
    			$ctr = 1;
    			foreach($interactions as $interaction){
    				
    				if($interaction['result'] == 'wrong'){
    					
    					if($returnStr != ''){
    						$returnStr .= ', ';
    					}
    					
    					$returnStr .= 'Q'.$ctr;
    				}
    				
    				$ctr++;
    			}
    		}
	    }
	    
		return $returnStr;
		
	}
	
	public static function getTrainingNumberOfQuestions($data){
	    if($data){
    		$cmiData = unserialize($data);
    		
    		if(array_key_exists('interactions', $cmiData)){
    			return count($cmiData['interactions']);
    		}
	    }
		
		return 0;
	}
	
	public static function checkApplicantCertificateValue($data, $value){
		$certificates = explode(',', $data->app_certificates);
	
		foreach ($certificates as $certificate){
			if($certificate == $value){
				return true;
			}
		}
	
		return false;
	}
	
	public static function getQuestionOptionValue($option, $type){
		
		if($option != null){
			$optArr = explode('-', $option);
			if(count($optArr) > 0){
				if($type == 'value'){
					return trim($optArr[0]);
				}else if($type == 'label'){
					if(count($optArr) > 1){
						if(trim($optArr[0]) == trim($optArr[1])){
							return '';
						}else{
							return trim($optArr[1]);
						}
					}else{
						return trim($optArr[0]);
					}
				}else if($type == 'type'){
					if(count($optArr) > 2){
					return trim($optArr[2]);
					}else {
						return trim($optArr[1]);
					}
				}else if($type == 'data'){
				    if(count($optArr) > 3){
				        return trim($optArr[3]);
				    }
				}
			}
		}
	
		return '';
	}
	
	public static function getSalaryDailyRate($salary){
		
		return round(($salary * 12 ) / 261, 2);
		
	}
	
	public static function getSalaryHourlyRate($salary){
		
		return round(( ($salary * 12 ) / 261) / 8, 2);
		
	}
	
	public static function getPercentageAmount($amount, $count, $startDate, $payrollDate){
		
		$empStartDate = Carbon::createFromFormat('Y-m-d', $startDate);
		
		if($empStartDate->gt($payrollDate->copy()->startOfMonth())){
			
			$dailyRate = HelperFunctions::getSalaryDailyRate($amount);
			$amount = $amount / 2;
			$amount -= $count * $dailyRate;
		}else{
			$amount = $amount / 2;
		}
		
		return $amount;
	}
	
	public static function getEmployeeUserLocation(){
		
		if(Auth::user() && Auth::user()->type_id == config('constants.USER_EMPLOYEE') ){
			$employeDetails = Employee::getActiveEmployeeProfileDetailsByUserIDByStatus(Auth::user()->id);
			if($employeDetails){
				return $employeDetails->emp_office_site;
			}
		}
		
		return 0;
	}
	
	public static function easterSunday($year){
		
		$day = 0;
		$month = 0;
		
		$g = $year % 19;
		$c = $year / 100;
		$h = ($c - (int)($c / 4) - (int)((8 * $c + 13) / 25) + 19 * $g + 15) % 30;
		$i = $h - (int)($h / 28) * (1 - (int)($h / 28) * (int)(29 / ($h + 1)) * (int)((21 - $g) / 11));
		
		$day   = $i - (($year + (int)($year / 4) + $i + 2 - $c + (int)($c / 4)) % 7) + 28;
		$month = 3;
		
		if ($day > 31)
		{
			$month++;
			$day -= 31;
		}
		
		return Carbon::create($year, $month, $day - 1, 0, 0, 0);
	}
	
	public static function isUserFinancePRFApprover($userId){
	    if(Auth::user() && Auth::user()->isSuperAdmin){
	        return true;
	    }
	    
		$recordData = UserGroupLine::getUserInUserGroup(config('constants.USER_GROUP_PRF_APPROVER'), $userId);
		if($recordData){
			return true;
		}else{
			return false;
		}
	}
	
	public static function isUserFinancePRFReleaser($userId){
	    if(Auth::user() && Auth::user()->isSuperAdmin){
	        return true;
	    }
	    
		$recordData = UserGroupLine::getUserInUserGroup(config('constants.USER_GROUP_PRF_RELEASER'), $userId);
		if($recordData){
			return true;
		}else{
			return false;
		}
		
	}
	
	public static function isShortBreakFullyUsed($id, $type){
		
		$break15 = TimeTrackerLine::getEmployeeTimeTrackLineByTimeTrackID($id)->where('ttl_assigned_task_id', 1)->get();
		$break30 = TimeTrackerLine::getEmployeeTimeTrackLineByTimeTrackID($id)->where('ttl_assigned_task_id', 8)->get();
		
		if($type == 1 && (count($break15) > 1 || count($break30) > 0)){
			return true;
		}else if($type == 8 && (count($break15) > 0 || count($break30) > 0)){
			return true;
		}
		
		return false;
	}
	
	public static function recordActivity($model, $userId, $properties, $description){
		
		activity()
			->performedOn($model)
			->causedBy($userId)
			->withProperties($properties)
			->log($description);
		
	}
	
	public static function getAssignToList(){
	    if(Auth::user()->isEmployee){
	        if(Auth::user()->employee->emp_client_id == config('constants.CLIENT_DOSS_ID')){
	            $groupIds = config('constants.USER_GROUP_AMR_ASSIGN_TO');
	        }else{
	            $groupIds = config('constants.DOSS_CLIENT_SERVICE');
	        }
	        
	        $assignToList = UserGroupLine::getUsersInGroupIds($groupIds)
    	        ->orderby('first_name','ASC')
    	        ->orderby('last_name','ASC')
    	        ->get();
	        
    	    return HelperFunctions::getClientServiceSupervisorList(Auth::user()->id, $assignToList);
	    }
	    
	    return [];
	}
	
	public static function getClientServiceSupervisorList($userId, &$cssList){
		
	    if($cssList == null){
	        $cssList = [];
	    }
	    
		$employeeInfo = Employee::getActiveEmployeeProfileDetailsByUserIDByStatus($userId);
		if($employeeInfo){
			$cssData = CssClient::getCssByClientId($employeeInfo->emp_client_id);
			if($cssData->count() > 0) {
				foreach ($cssData as $css) {
				    if(is_array($cssList)){
				        array_push($cssList, $css->user);
				    }else{
				        $cssList->push($css->user);
				    }
				}
			}
		}
		
		return $cssList;
		
	}
	
	public static function getClientServicesSupervisorClients($userId){
		
		$clients = CssClient::distinct()->select('csc_client_id')->where('csc_user_id', $userId)->get();
		return $clients->toArray();
	}
	
	public static function extractBDOForexData($asRaw=true){
		
	    $currUSD = 0;
	    $currAUD = 0;
	    
	    //temporary fix, while the pull of forex on site is not working
	    if($asRaw){
	           $bdoForex = '<table width="180px" height="215px" border="1" cellspacing="0" cellpadding="0" class="forexbody" bordercolor="#ffffff">
	         <tbody><tr>
	         <td colspan="3" class="forexheading"><b>FOREIGN EXCHANGE RATE</b><br>as of 16:10:13 2022-06-16</td>
	         </tr>
	         <tr class="forexcolhead">
	         <td>Curr</td>
	         <td>Buy</td>
	         <td>Sell</td>
	         </tr>
	         <tr>
	         <td> <b>US$</b> </td>
	         <td> <b>58.5500</b> </td>
	         <td> <b>59.0500</b> </td>
	         </tr>
	         <tr>
	         <td>AUD</td>
	         <td>36.1800</td>
	         <td>37.4800</td>
	         </tr>
	         </tbody></table> ';
	           
	        return $bdoForex;
	    }else{
	       return (object) ['currUSD' => $currUSD,'currAUD' => $currAUD,];
	    }
	    
	    
	    
	    
	    
	    
	    if(($bdoForex = @file_get_contents("https://www.bdo.com.ph/sites/default/files/forex/forex.htm")) === false) {
	        \Log::info(print_r(error_get_last(), true));
	        return (object) ['currUSD' => $currUSD,'currAUD' => $currAUD,];
	    }
	    
		//$bdoForex = file_get_contents('https://www.bdo.com.ph/sites/default/files/forex/forex.htm');
		if($bdoForex != ''){
			$bdoForex = substr($bdoForex, strpos($bdoForex,'<table '));
			$bdoForex = substr($bdoForex, 0, strpos($bdoForex,'</table>'));
		}
		
		if($asRaw){
			return $bdoForex;
		}
		
		$rows = explode('<tr>',$bdoForex);
		foreach ($rows as $row){
			$row = substr($row, 0, strpos($row,'</tr>'));
			$columns = explode('<td>',$row);
			if(count($columns) > 2){
				$currCode = HelperFunctions::clearTableTags($columns[1]);
				if($currCode == 'US$'){
					$currUSD = HelperFunctions::clearTableTags($columns[2]);
				}else if($currCode == 'AUD'){
					$currAUD = HelperFunctions::clearTableTags($columns[2]);
				}
			}
		}
		
		return (object) ['currUSD' => $currUSD,'currAUD' => $currAUD,];
	}
	
	public static function clearTableTags($tdString){
		
		if($tdString){
			$tdString= str_replace("<b>","",$tdString);
			$tdString= str_replace("</b>","",$tdString);
			$tdString= str_replace("</td>","",$tdString);
			$tdString= trim($tdString);
		}
		
		return $tdString;
	}

	public static function getClientsIdByUserId($userId) {
		$clients = [];
		if ($userId) {
			$clientUsersData = ClientUser::getClientUserListByUserID($userId)->get();
			if ($clientUsersData) {
				foreach ($clientUsersData as $clientUser) {
					array_push($clients, $clientUser->clu_client_id);
				}
			}
		}
		return $clients;
	}

	public static function logTicketActivity($ticketData) {
		$logData = null;
		if ($ticketData) {
			$userId = Auth::user()->id;
			$empData = Employee::getEmployeeRecordByUserID($userId);

			if ($empData) {
				$logData = new TicketTrackerLine;
				$logData->tcl_ticket_id = $ticketData->tic_id;
				$logData->tcl_status_id = $ticketData->tic_status_id;
				$logData->tcl_assigned_to = $ticketData->tic_assigned_to;
				$logData->tcl_department_id = $empData->emp_client_team_id;
				$logData->tcl_priority_id  = $ticketData->tic_priority_id;
				$logData->created_at = Carbon::now();
				$logData->created_by = $userId;
				$logData->save();
			}
		}
		return $logData;
	}

	public static function getDateTimeDifference($startDate, $endDate, $returnType=null) {
        $dateTimeDiff = '';
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate);
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $endDate);

        $days = $startDate->diffInDays($endDate);
        $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
        $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);
        $seconds = $startDate->copy()->addDays($days)->addHours($hours)->addMinutes((int)$minutes)->diffInSeconds($endDate);

        if ($days || $hours || $minutes || $seconds) {
            // if ($days >= 1) $dateTimeDiff .= ($days > 1) ? $days.' Days ' : $days.' Day ';
            // if ($hours >= 1) $dateTimeDiff .= ($hours > 1) ? $hours.' Hours ' : $hours.' Hour ';
            // if ($minutes >= 1) $dateTimeDiff .= ($minutes > 1) ? $minutes.' Minutes ' : $minutes.' Minutes ';
			// if ($seconds >= 1) $dateTimeDiff .= ($seconds > 1) ? $seconds.' Seconds ' : $seconds.' Seconds ';
			
			switch ($returnType) {
				case 'raw':
					return ['days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $seconds];
					break;
				
				case 'shorten': 
					if ($days >= 1) return $days.'d';
					if ($hours >= 1) return $hours.'h';
					if ($minutes >= 1) return $minutes.'m';
					if ($seconds >= 1) return $seconds.'s';
					break;

				default:
					if ($days >= 1) $dateTimeDiff .=  $days.'d ';
					if ($hours >= 1) $dateTimeDiff .= $hours.'h ';
					if ($minutes >= 1) $dateTimeDiff .= $minutes.'m ';
					if ($seconds >= 1) $dateTimeDiff .= $seconds.'s';
					break;
			}

        }

        return $dateTimeDiff;
    }
    
    public static function getSystemConfigValue($code){
    	$sysConData = SystemConfiguration::where('scn_code','=',$code)->first();
    	if($sysConData){
    		return $sysConData->scn_value;
    	}else{
    		return '';
    	}
    }
    
    public static function isSystemConfigEnabled($code, $enableValue, $list=null){
        if($list){
            foreach($list as $item){
                if($item->scn_code == $code){
                    if($item->scn_value == $enableValue){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }else{
        	$value = HelperFunctions::getSystemConfigValue($code);
        	if($value == $enableValue){
        		return true;
        	}
        }
        return false;
    }
    
    public static function isManagementUser($userProfile) {
    	
    	if ($userProfile) {
    		if($userProfile->type_id == config('constants.SUPER_ADMIN')){
    			return true;
    		}else if($userProfile->type_id == config('constants.USER_CLIENT')){
    			$recordData = User::join('client_teams', 'cte_user_id', '=', 'users.id')
    				->where('users.id', $userProfile->id)
	    			->where('cte_client_id', config('constants.CLIENT_DOSS_ID'))
	    			->first();
    		}else{
    			$recordData = User::join('employees', 'employees.emp_user_id', '=', 'users.id')
    				->where('users.id', $userProfile->id)
    				->where('employees.emp_client_id', config('constants.CLIENT_DOSS_ID'))
		    		->first();
    		}
    		
    		if($recordData){
    			return true;
    		}
    	}
    	
    	return false;
    }
    
	public static function cssCsmAccessSalary($userId, $loginUserId)
	{
		$user = User::find($userId);
		$userClientId = $user->client_id;
	
		$isCSSandCSM = UserGroupLine::getUserInUserGroupByName(config("constants.USER_GROUP_CSM_AND_CSS"), $loginUserId) !== null;
	
		if ($isCSSandCSM) {
			$clients = CssClient::getClientsByUserId($loginUserId)
				->pluck('csc_client_id')
				->reject(function ($clientId) {
					return $clientId == 10;
				})
				->toArray();
	
			return in_array($userClientId, $clients);
		}
	
		return false;
	}
	

	public static function accessSalaryExceptDoss($userId, $loginUserId)
	{
        $user = User::find($userId);
        $isAccsSlrExDoss = UserGroupLine::getUserInUserGroupByName(config("constants.USER_GROUP_ACCESS_SALARY_EXCEPT_DOSS"), $loginUserId) !== null;
		if ($isAccsSlrExDoss) {
			return ($user->client_id === 10) ? false : true;
		}
	}

	public static function generateRoomReservationDisplay($roomReservations)
	{
		$user = Auth::user();
		$userId = $user->id;
		$events = [];

		$officeLocations = Option::getOfficeLocationList();
		$officeSites  = [];
		
		foreach ($officeLocations as $item) {
			$baseColor = '';
			
			switch ($item->id) {
				case config('constants.OFFICE_LOC_MKT'):
					$baseColor = '#7f56c6';
					break;
				
				case config('constants.OFFICE_LOC_BGC'):
					$baseColor = '#01b287';
					break;

				case config('constants.OFFICE_LOC_BGC_CS'):
					$baseColor = '#26cbd3';
					break;

				default:
					$baseColor = '#c4d700';
					break;
			}

			$rooms = Option::getLinkedOptionsList()->where('linked_option', $item->id)->pluck('id')->toArray();
			$colors = HelperFunctions::getColors($baseColor, count($rooms));

			$office = [
				"office_id" => $item->id,
				"rooms" => []
			];

			foreach ($rooms as $key => $room_id) {
				$office["rooms"][] = [
					"room_id" => $room_id,
					"room_color" => $colors[$key]
				];
			}

			array_push($officeSites, $office);
		}

		foreach ($roomReservations as $item) {

			// Event Start
			$eventStart = $item->rre_date_from->format('Y-m-d');
			if($item->rre_time_start != null){
				$eventStart .= ' '.$item->rre_time_start;
			}
			
			// Event End
			$eventEnd = '';
			if ($item->rre_date_to != null && $item->rre_date_from != $item->rre_date_to){
				$eventEnd = $item->rre_date_to->format('Y-m-d');
				if ($item->rre_time_end != null){
					$eventEnd .= ' '.$item->rre_time_end;
				} 
				else {
					$eventEnd = $item->rre_date_to->addDay()->format('Y-m-d');
				}
			} 
			else if ($item->rre_time_end != null){
				$eventEnd = $item->rre_date_from->format('Y-m-d').' '.$item->rre_time_end;
			}

			// Is All Day
			$isAllDay = ($item->rre_time_start == null || $item->rre_time_end == null) ? true : false;
			
			$startTime = Carbon::parse($item->rre_date_from->format('Y-m-d').' '.$item->rre_time_start)->format('g:ia');
			$endTime = Carbon::parse($item->rre_date_to->format('Y-m-d').' '.$item->rre_time_end)->format('g:ia');

			$contentHTML = '<div class="rr-content">';
			$contentHTML .= '<p><strong>Time: </strong>'. $startTime.' - '.$endTime .'</p>';
			$contentHTML .= '<p><strong>Location: </strong>'. $item->location->name .'</p>';
			$contentHTML .= '<p><strong>Room: </strong>'. $item->room->name .'</p>';
			$contentHTML .= '<p><strong>Description: </strong>'. htmlspecialchars($item->rre_description) .'</p>';
			$contentHTML .= '<p><strong>Created by: </strong>'. $item->creatorFullName .'</p>';

			if ($item->rre_has_repeat) {
				$contentHTML .= '<p><strong>Repeat ends: </strong>'. $item->whenRecurringEnds .'</p>';
			}

			if ($item->updated_at && $item->modified_by) {
				$contentHTML .= '<p><strong>Updated by: </strong>'. $item->modifierFullName .' at '. $item->updated_at->format('F d, Y') .'</p>';
			}

			$contentHTML .= '</div>';

			$isRecurring = ($item->rre_has_repeat == 1 && $item->rre_status == 0) ? true : false;

			$isEditable = "true";

			if ($user->type_id != config('constants.SUPER_ADMIN')) {
				
				if ($item->rre_participants != '') {
					$participantIds = explode(",", $item->rre_participants);
					$isEditable = (in_array($userId, $participantIds) || $userId == $item->created_by) ? true : false;
					
				}
						
				$userGroupLineData = UserGroupLine::getUserGroupLinesByGroupId(config('constants.USER_GROUP_HR'))
													->where('ugl_user_id', '=', $userId)
													->first();
					
				if ($userGroupLineData) {
					$isEditable = true;
				}

            } else {
				$isEditable = true;
			}
			
			$officeSiteArray = $officeSites[array_search($item->rre_location_id, array_column($officeSites, 'office_id'))];
			$color = $officeSiteArray['rooms'][array_search($item->rre_room_id, array_column($officeSiteArray['rooms'], 'room_id'))]['room_color'];

			$eventItem = [
				"title" => $item->rre_title, 
				"start" => $eventStart,
				"end" => $eventEnd,
				"eventId" => $item->rre_id,
				"allDay" => $isAllDay,
				"content" => $contentHTML,
				"recurring" => $isRecurring,
				"editable" => $isEditable,
				"color" => $color,
			];

			array_push($events, $eventItem);
			
		}

		return json_encode($events);
	}
	
	public static function generatePTOForecast($employeeDetails, $lastItem) {
        $SLAvailable =  0;
        $VLAvailable = 0;

        if ($lastItem) {
    	    $SLAvailable =  $lastItem->SLAvailable;
    	    $VLAvailable = $lastItem->VLAvailable;
	    }

		$id = $employeeDetails->employee_id;
		$currDate = Carbon::now();
        //@marylyn: Retain this for testing purposes (advance)
        //$currDate = Carbon::createFromFormat("Y-m-d", "2024-12-31");
		
		$ptoForecast = (object) [
				'totalNewVL' => 0,
				'totalNewSL' => 0,
				'totalIncomingVL' => 0,
				'totalIncomingSL' => 0,
				'actualVLBalance' => 0,
				'actualSLBalance' => 0,
				'forecastVLBalance' => 0,
				'forecastSLBalance' => 0,
				'nextVLUpdate'=>'',
				'nextSLUpdate'=>'',
		];
		
		$totalNewLeaves = EmployeeLeave::getEmployeeLeavesByEmployeID($id)
		    ->where('eml_date_from','>', $currDate)
			->where('eml_status_id','=', config('constants.LEAVE_STAT_NEW'))
			->where('eml_unpaid','=',0)->get();
		
		foreach ($totalNewLeaves as $newLeave){
			if($newLeave->eml_type_id == config('constants.LEAVE_TYPE_VL')){
			    $ptoForecast->totalNewVL += $newLeave->leaveDays;
			}else if($newLeave->eml_type_id == config('constants.LEAVE_TYPE_SL')){
			    $ptoForecast->totalNewSL += $newLeave->leaveDays;
			}
		}
		
		$totalIncomingLeaves = EmployeeLeave::getEmployeeLeavesByEmployeID($id)
			->where('eml_date_from','>', $currDate)
			->where('eml_status_id','<=', config('constants.LEAVE_STAT_APPROVED'))
			->where('eml_unpaid','=',0)
			->orderby('eml_date_from','ASC')->get();
		
		$lastVLItem = null;
		$lastSLItem = null;
		$vlIncomingNew = 0;
		$slIncomingNew = 0;
		foreach($totalIncomingLeaves as $incomingLeave){
			if($incomingLeave->eml_type_id == config('constants.LEAVE_TYPE_VL')){
				if($incomingLeave->eml_status_id == config('constants.LEAVE_STAT_NEW')){
				    $vlIncomingNew += $incomingLeave->leaveDays;
				}else{
				    $ptoForecast->totalIncomingVL += $incomingLeave->leaveDays;
				}
				$lastVLItem = $incomingLeave;
			}else if($incomingLeave->eml_type_id == config('constants.LEAVE_TYPE_SL')){
				if($incomingLeave->eml_status_id == config('constants.LEAVE_STAT_NEW')){
				    $slIncomingNew += $incomingLeave->leaveDays;
				}else{
				    $ptoForecast->totalIncomingSL += $incomingLeave->leaveDays;
				}
				
				$lastSLItem = $incomingLeave;
			}
		}
		
		$ptoForecast->actualVLBalance = $VLAvailable - ($ptoForecast->totalNewVL - $vlIncomingNew);
		$ptoForecast->actualSLBalance = $SLAvailable - ($ptoForecast->totalNewSL - $slIncomingNew);
		$ptoForecast->forecastVLBalance = $VLAvailable - ($ptoForecast->totalNewVL + $ptoForecast->totalIncomingVL);
		$ptoForecast->forecastSLBalance = $SLAvailable - ($ptoForecast->totalNewSL + $ptoForecast->totalIncomingSL);
		
		$vlCreditsPerMonth = $employeeDetails->emp_leave_credit_per_month;
		$savedCOL = CarryOverLeave::getEmployeeCarryOverLeavesByEmployeID($id)->first();
		if($savedCOL){
			$vlCreditsPerMonth = $savedCOL->col_new_credit_per_month;
		}
		
		if($employeeDetails->emp_start_date != null){
            $employeeStartDate = Carbon::create($employeeDetails->emp_start_date);
    		$vlForecast = HelperFunctions::getLeaveForecastValues($employeeStartDate, $lastVLItem, $vlCreditsPerMonth, $employeeDetails->emp_client_id);
    		$ptoForecast->nextVLUpdate = $vlForecast->nextUpdate;
    		$ptoForecast->forecastVLBalance += $vlForecast->forecastBalance;

            $employeeStartDate = Carbon::create($employeeDetails->emp_start_date);
    		$slForecast = HelperFunctions::getLeaveForecastValues($employeeStartDate, $lastSLItem, null, $employeeDetails->emp_client_id);
    		$ptoForecast->nextSLUpdate = $slForecast->nextUpdate;
    		$ptoForecast->forecastSLBalance += HelperFunctions::assignMonthlyAccrual(0);
		}else{
		    $ptoForecast->nextVLUpdate = Carbon::now();
		    $ptoForecast->forecastVLBalance += 0;
		    $ptoForecast->nextSLUpdate = Carbon::now();
		    $ptoForecast->forecastSLBalance += 0;
		}

		return $ptoForecast;
		
	}

    /**
     * [Leave Tracker] Get leave forecast values
     * @param string $employeeStartDate
     * @param object $dataItem
     * @param int $creditsPerMonth
     * @param int $iClientID
     * @return object
     */
	public static function getLeaveForecastValues($employeeStartDate, $dataItem, $creditsPerMonth = null, $iClientID = null) {
		
		$currDate = Carbon::now();
        //@marylyn: Retain this for testing purposes (advance)
        //$currDate = Carbon::createFromFormat("Y-m-d", "2024-12-31");
		if ($creditsPerMonth == null) {
            $creditsPerMonth = HelperFunctions::assignMonthlyAccrual($iClientID);
		}
		
		if($employeeStartDate == null){
		    $employeeStartDate = Carbon::now();
		}
		
		$nextUpdateDate = Carbon::now();
		if($currDate->day > $employeeStartDate->day){
			$nextUpdateDate->addMonth()->day = $employeeStartDate->day;
		}else{
			$nextUpdateDate->day = $employeeStartDate->day;
		}
		
		$months = 1;
		$forecastData = (object) [
				'nextUpdate' => $nextUpdateDate->format(config('constants.DEFAULT_DATE_FORMAT')),
				'forecastBalance' => round($creditsPerMonth,2),
		];
		
		if($dataItem){
			if($dataItem->eml_date_from->month > $currDate->month){
				$months = $dataItem->eml_date_from->month - $currDate->month;
			}

			if($currDate->day > $employeeStartDate->day && $employeeStartDate->day > $dataItem->eml_date_from->day){
				$months--;
			}
			if($currDate->day < $employeeStartDate->day && $employeeStartDate->day < $dataItem->eml_date_from->day){
				$months++;
			}
			
			$forecastData->nextUpdate = $dataItem->leaveUntilDate;
			$forecastData->forecastBalance = round(($months * $creditsPerMonth),2);
		}
		
		return $forecastData;
	}

	public static function addDayAndTime($date, $time, $dayTime) 
	{
		$dateTime = null;

		if (!empty($date) && !empty($dayTime) && is_array($dayTime)) 
		{

			$dateTime = Carbon::parse($date.' '.$time);
			$days = $dayTime['days'];
			$hours = $dayTime['hours'];
			$minutes = $dayTime['minutes'];
			$seconds = $dayTime['seconds'];
			
			if ($days > 0) $dateTime->addDays((int)$days);
			if ($hours > 0) $dateTime->addHour((int)$hours);
			if ($minutes > 0) $dateTime->addMinutes((int)$minutes);
			if ($seconds > 0) $dateTime->addSeconds((int)$seconds);

		}

		return $dateTime;
	}

	public static function generateSeriesDateTime($startDateTime, $endDateTime, $returnType, $dayOfWeek=null, $occurrence=null, $months=null) 
	{
		$startDate = $startDateTime->format('Y-m-d');
		$endDate = $endDateTime->format('Y-m-d');
		$startTime = $startDateTime->format('H:i:s');

		$months = ($returnType == 2) ? $months+1 : $months;

		$dateRangeFrom = Carbon::parse($startDate);
		$dateRangeTo = (!is_null($months) && $months > 0) ? Carbon::parse($startDate)->addMonths((int)$months) : Carbon::parse($startDate)->addYear();

		// Selected day of the week
		$preferredDayOfWeek = ($dayOfWeek > 0) ? $dayOfWeek-1 : null;
		
		// Occurrence
		$weekName = null;

		if (!is_null($occurrence)) {			
			switch ($occurrence) {
				case 1:
					$weekName = 'First';
					break;
				
				case 2:
					$weekName = 'Second';
					break;
				
				case 3:
					$weekName = 'Third';
					break;
				
				case 4:
					$weekName = 'Fourth';
					break;
				
				case 5:
					$weekName = 'Last';
					break;
				
				default:
					$weekName = null;
					break;
			}
		}

		$dayName = null;

		if (!is_null($dayOfWeek)) {			
			switch ($dayOfWeek) {
				case 1:
					$dayName = 'Monday';
					break;
				
				case 2:
					$dayName = 'Tuesday';
					break;
				
				case 3:
					$dayName = 'Wednesday';
					break;
				
				case 4:
					$dayName = 'Thursday';
					break;
				
				case 5:
					$dayName = 'Friday';
					break;

				case 6: 
					$dayName = 'Saturday';
					break;
				
				default:
					$dayName = null;
					break;
			}
		}

		
		// Include Start & End Date Time
		$seriesArr = [];

		array_push($seriesArr, [
			'start_date' => $dateRangeFrom, 
			'start_datetime' => $startDateTime, 
			'end_datetime' => $endDateTime
		]);

		// Day/Time difference of StartDateTime and EndDateTime to be used on setting end date & time for generated week dates 
		$dayTimeDifference = HelperFunctions::getDateTimeDifference($startDateTime->format('Y-m-d H:i:s'), $endDateTime->format('Y-m-d H:i:s'), 'raw');

		$currentDay = $dateRangeFrom->copy();
		
		// Generate
		while ($currentDay < $dateRangeTo) {

			if ($returnType == 1) // Weekly 
			{
				$currentDay = $currentDay->addWeek();
				$currStartDate = (!is_null($preferredDayOfWeek)) ? $currentDay->copy()->startOfWeek()->addDay($preferredDayOfWeek) : $currentDay->copy();
			}
			else if ($returnType == 2) // Monthly
			{
				$currentDay = $currentDay->addMonth();
				$currStartDate = (!is_null($dayName) && !is_null($weekName)) ? new Carbon($weekName.' '.$dayName.' of '.$currentDay->copy()->format('F').' '.$currentDay->copy()->year) : $currentDay->copy();
			}

			if ($currentDay < $dateRangeTo) 
			{
				$currStartDateTime = Carbon::parse($currStartDate->format('Y-m-d').' '.$startTime);
				$currEndDateTime = HelperFunctions::addDayAndTime($currStartDate->format('Y-m-d'), $startTime, $dayTimeDifference);
				
				array_push($seriesArr, [
					'start_date' => $currStartDate,
					'start_datetime' => $currStartDateTime,
					'end_datetime' => $currEndDateTime,
				]);
			}

		}

		return $seriesArr;
	}

	public static function hexToRgb($hex) 
	{
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = [$r, $g, $b];
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}

	public static function rgbToHex($rgb)
	{
		$hex = "#";
		$hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

		return $hex; // returns the hex value including the number sign (#)
	}

	public static function getColors($hex, $ctr) 
	{
		$arr = [];
		$hexArr = [$hex];
		$rgb = HelperFunctions::hexToRgb($hex);
		for ($i = 1; $i < $ctr; $i++) {
			$colorArr = [];
			foreach($rgb as $color) {
				$mcolor = (255 - $color) / $ctr ;
				array_push($colorArr, $color+$mcolor);
			}
			array_push($arr, $colorArr);
			$rgb = $colorArr;
		}
		
		foreach($arr as $item) {
			array_push($hexArr, HelperFunctions::rgbToHex($item));
		}
		
		return $hexArr; 
		
		// return $arr;
	}

	public static function isUserBelongsToThisGroupId($groupId, $userId) {
		$hasGroupAccess = UserGroupLine::getUserInUserGroup($groupId, $userId);

		if($hasGroupAccess){ return true; }

		return false;
   	}

   	public static function checkForSignDocuments()
   	{
   	    $userprofile = Auth::user();
   	    $totalForSignDocuments = 0;
   	    $documents = collect();

   	    if ($userprofile && $userprofile->isEmployee) {
   	        $employeeDetails = $userprofile->employee;
   	    	$documents = Document::where('doc_employee_id', $employeeDetails->id)
   	    		->where('doc_for_signing', 1)
   	    		->whereNull('doc_signed_at')
   	    		->get();

	    	$totalForSignDocuments = $documents->count();
   	    }
		
   	    return (object)compact('totalForSignDocuments', 'documents');
   	}
   	
   	public static function checkUnconfirmedPoliciesAndAcknowledgements(){
   	    
   	    $unconfirmedData = (object) [
   	        'unconfirmedPolicy' => false,
   	        'daysToComply' => 0,
   	        'isNewHire'=>false,
   	        'unconfirmedAcknowledgements'=>false,
   	        'daysToComplyAck'=>0,
   	    ];
   	    
   	    $userprofile = Auth::user();
   	    if($userprofile && $userprofile->isEmployee){
   	        $currDate = Carbon::now($userprofile->timezone);
   	        $employeeDetails = Auth::user()->employee;
   	        if($employeeDetails){
				$employeeDetails->emp_start_date = Carbon::parse($employeeDetails->emp_start_date);
           	    if($employeeDetails->emp_start_date->diffInDays($currDate, false) >= 0){
           	        $unconfirmedPolicies = Policy::getUnconfirmedPolicyByUserAndClientID($userprofile->id, $userprofile->type_id, $employeeDetails->emp_client_id, $employeeDetails->emp_office_site, $employeeDetails->emp_client_team_id)
           	            ->where(function($query) use($employeeDetails) {
               	            $query->where('pol_effective_date','<=', $employeeDetails->emp_start_date)
               	            ->orWhereNull('pol_effective_date');
               	        })->first();
           	        
           	        if($unconfirmedPolicies){
           	            $unconfirmedData->unconfirmedPolicy = true;
           	            if($employeeDetails->emp_start_date->diffInDays($currDate, false) <= 6){
           	                $unconfirmedData->daysToComply = 7 - $employeeDetails->emp_start_date->diffInDays($currDate, false);
           	            }else if($currDate->diffInDays($unconfirmedPolicies->pol_updated_at, false) <= 0){
           	                $unconfirmedData->daysToComply = 7 + $currDate->diffInDays($unconfirmedPolicies->pol_updated_at, false);
           	            }
           	        }else{
           	            $sevenDaysAhead = Carbon::now($userprofile->timezone)->subDays(7)->startOfDay();
           	            $unconfirmedPolicies = Policy::getUnconfirmedPolicyByUserAndClientID($userprofile->id, $userprofile->type_id, $employeeDetails->emp_client_id, $employeeDetails->emp_office_site, $employeeDetails->emp_client_team_id)
           	                ->where('pol_effective_date','>=', $sevenDaysAhead)->where('pol_effective_date','<=',$currDate)->first();
           	            
           	            if($unconfirmedPolicies){
           	                $unconfirmedData->unconfirmedPolicy = true;
           	                if($unconfirmedPolicies->pol_effective_date->diffInDays($currDate, false) <= 6){
         	                      $unconfirmedData->daysToComply = 7 - $unconfirmedPolicies->pol_effective_date->diffInDays($currDate, false);
           	                }else{
           	                    $unconfirmedData->daysToComply = 0;
           	                }
           	            }
           	        }
           	        
           	        $unconfirmedAcknowledgements = Acknowledgement::getUnconfirmedAcknowledgementByUserAndClientID($userprofile->id, $userprofile->type_id, $employeeDetails->emp_client_id, $employeeDetails->emp_office_site)
               	        ->where(function($query) use($employeeDetails) {
               	            $query->where('ack_effective_date','<=', $employeeDetails->emp_start_date)
               	            ->orWhereNull('ack_effective_date');
               	        })->get();

               	    if(count($unconfirmedAcknowledgements)>0){
               	        $unconfirmedAcknowledgement = $unconfirmedAcknowledgements[0];
           	            $unconfirmedData->unconfirmedAcknowledgements = true;
           	            if($employeeDetails->emp_start_date->diffInDays($currDate, false) <= 1){
           	                $unconfirmedData->daysToComplyAck = 2 - $employeeDetails->emp_start_date->diffInDays($currDate, false);
           	            }else if($currDate->diffInDays($unconfirmedAcknowledgement->ack_updated_at, false) <= 0){
           	                $nextTwoDays = $unconfirmedAcknowledgement->ack_updated_at->copy()->addWeekdays(3);
           	                $unconfirmedData->daysToComplyAck = $currDate->diffInDays($nextTwoDays, false);
           	            }
           	        }
           	    }
   	        }
   	    }
   	    
   	    return $unconfirmedData;
   	}

	/**
	 * Function to store user activity logs
	 * 
	 * $params - (object)["key1"=>'value_1', "key2"=>"value_2", etc.,]
	 */
	public static function addToUserActivityLogs($request, $params=null){
		$userActivityLog = new UserActivityLog();
        $userActivityLog->ual_user_id = Auth::user()->id;
        
        $footprintData = (object)[
			'url'=>$request->path()
		];

		if($params) {
			foreach($params as $key => $value) {
				$footprintData->{$key} = $value;
			}
		}
        
        $userActivityLog->ual_footprint = serialize($footprintData);
		$userActivityLog->save();
	}
	
	public static function isEmployeeSettingsON($userId, $code){
	    $empSetting = HelperFunctions::checkEmployeeSettings($userId, $code);
	    if($empSetting && $empSetting->ese_value == 1){
	        return true;
	    }
	    return false;
	}
	
	public static function checkEmployeeSettings($userId, $code){
	    
	    $empSetting = null;
	    $user = User::find($userId);
	    if($user->isEmployee){
    	    $employee = $user->employee;
    	    $empSettingItem = EmployeeSettingItems::where('esi_code','=',$code)->first();
    	    if($empSettingItem){
    	        $empSetting = $employee->getEmployeeSettingsByItemId($empSettingItem->esi_id);
    	    }
	    }
	    return $empSetting;
	}

	public static function amountToWords($amount, $curr){

		$from =  ['-'];
		$to =  [' '];
        $fmt = new NumberFormatter('en_US',NumberFormatter::SPELLOUT);
        $in_words = $fmt->format($amount);
        $in_words = ucwords(str_replace($from, $to, $in_words));
        $point = config('constants.CURRENCY_DECIMAL_IN_WORD');
        $count = substr_count($in_words, $point);
        $desc = explode(",", $curr->desc);
        $currency = $desc[0];
        $centWord = $desc[1];

        if ($count > 0) {

        	$pointReplacer = $currency. ' ' . config('constants.CURRENCY_POINT_REPLACER') . ' ';
        	$cents = $fmt->format(ltrim(strstr($amount, '.'),'.'));
        	$in_words = substr( $in_words, 0, strpos( $in_words, $point )) . $pointReplacer . ucwords(str_replace($from, $to, $cents));
        	$in_words = $in_words . ' ' . lcfirst($centWord);

        } else {

        	$in_words = $in_words . ' ' . $currency;

        }

        return $in_words;
	}

	public static function getScheduleFormatted($ttr_date, $start, $end) {
		if($start && $end){
			$startTime = Carbon::parse($ttr_date)->format(config('constants.DB_DATE_FORMAT').' '.$start);
			$endTime = Carbon::parse($ttr_date)->format(config('constants.DB_DATE_FORMAT').' '.$end);
			return Carbon::parse($startTime)->format(config('constants.DEFAULT_TIME_FORMAT')).' - '.Carbon::parse($endTime)->format(config('constants.DEFAULT_TIME_FORMAT'));
		}

		return '';
	}

    /**
     * Assign monthly accrual (SL or VL) (Example: 15 VL days / 12 months -> 1.25)
     * @param int|mixed $iClientID
     * @param bool $bExcludeChangeCredit
     * @return float|int
     */
    public static function assignMonthlyAccrual($iClientID, bool $bExcludeChangeCredit = false)
    {
        $iPaidDayLeaves = 10;
        $iClientIDCenturia = config("constants.CLT_CENTURIA_CLIENT_ID") ?? 112;
        $iClientIDDPE = config("constants.CLT_DPE_LABEL_CLIENT_ID") ?? 12;

        $aFifteenPTOLeaveClients = [$iClientIDCenturia, $iClientIDDPE];

        if ($bExcludeChangeCredit === false) {
            if (in_array($iClientID, $aFifteenPTOLeaveClients) === true) {
                $iPaidDayLeaves = 15;
            }
        }

        $iMonthsInAYear = 12;
        return ($iPaidDayLeaves / $iMonthsInAYear);
    }

    /**
     * [General] Check if <ip_whitelists.ipw_address> is whitelisted
     * @return bool
     */
    public static function checkIfIPAddrWhiteListed($ipAddress)
    {
        $modelIPWhitelist = IpWhitelist::getIpDetailByIPAddress($ipAddress);
        return count($modelIPWhitelist) > 0;
    }

	public static function accessSalary($userId, $loginUserId)
	{
		$isAccessSalaryExceptDoss = UserGroupLine::getUserInUserGroupByName(config("constants.USER_GROUP_ACCESS_SALARY_EXCEPT_DOSS"), $loginUserId) !== null;
		$isCSSandCSM = UserGroupLine::getUserInUserGroupByName(config("constants.USER_GROUP_CSM_AND_CSS"), $loginUserId) !== null;

		if ($isAccessSalaryExceptDoss) {
			return self::accessSalaryExceptDoss($userId, $loginUserId);
		} elseif ($isCSSandCSM) {
			return self::cssCsmAccessSalary($userId, $loginUserId);
		}
	
		return true;
	}

    public static function isUserAllowedAccessManagerSalary($userId, $loginUserId)
    {
        $isAllowed = true;
        $dossManager = UserGroupLine::getUserInUserGroup(config('constants.USER_GROUP_DOSS_MANAGERS'), $userId);
        if($dossManager){
            $allowedUser = UserGroupLine::getUserInUserGroup(config('constants.USER_GROUP_ACCESS_MANAGER_SALARY'), $loginUserId);
            if(!$allowedUser){
                $isAllowed = false;
            }
        }

        return $isAllowed;
    }

    /**
     * [Finance > Payroll > Payslip] Check if user can see YTD summary
     * @param mixed $loginUserId
     * @return bool
     */
    public static function isUserAllowPayslipYearToDateCheck($loginUserId)
    {
        $userGroupName = "DOSS Finance";
        return UserGroupLine::getUserInUserGroupByName($userGroupName, $loginUserId) !== null || Auth::user()->isSuperAdmin === true;
    }

    /**
     * [Employee] Show [Documents] section
     * @param mixed $loginUserId
     * @return bool
     */
    public static function showDetailsPermissionDocuments($loginUserId)
    {
        $flagShowDetailsDocuments = true;
        if (Auth::user()->type_id == config('constants.USER_EMPLOYEE')) {
            $flagShowDetailsDocuments = self::showRestrictedEmployeeProfileSections($loginUserId);
        }

        return $flagShowDetailsDocuments;
    }

    /**
     * [Employee] Show [Salary] section
     * @param mixed $loginUserId
     * @return bool
     */
    public static function showDetailsPermissionSalary($detailsEmployee, $detailsLoggedInUser)
    {
        $flagShowDetailsSalary = true;
        if (Auth::user()->type_id == config('constants.USER_EMPLOYEE')) {
            $loginUserId = $detailsLoggedInUser->employee->emp_user_id ?? 0;
            $userGroupLineIDEmployeeSalary = 43;

            $eligibleUserGroupLineIDsDefault = "$userGroupLineIDEmployeeSalary";
            $eligibleUserGroupLineIDsDefault = UserGroupLine::getUsersInGroupIds($eligibleUserGroupLineIDsDefault)->where('ugl_user_id', $loginUserId)->get();
            if ($eligibleUserGroupLineIDsDefault->count() <= 0) {
                $flagShowDetailsSalary = false;
            }

            $userGroupLineIDAccessSalaryExceptHGS = 100;
            $userGroupLineIDCSSCSM = 101;

            $eligibleUserGroupLineIDsCustom = "$userGroupLineIDAccessSalaryExceptHGS,$userGroupLineIDCSSCSM";
            $userGroupLineEmployeeSalaryCustom = UserGroupLine::getUsersInGroupIds($eligibleUserGroupLineIDsCustom)->where('ugl_user_id', $loginUserId)->get();

            if ($userGroupLineEmployeeSalaryCustom->count() > 0) {
                $employeeClientID = $detailsEmployee->emp_client_id ?? 0;
                $clientIDHGSDiversify = 10;

                if ($employeeClientID !== $clientIDHGSDiversify) {
                    $flagShowDetailsSalary = true;
                }
            }
        }

        $typeIDClient = config('constants.USER_CLIENT');
        $typeIDProspectClient = config('constants.USER_PROSPECT_CLIENT');
        $clientIDTypes = [$typeIDClient, $typeIDProspectClient];

        if (in_array(Auth::user()->type_id, $clientIDTypes) === true) {
            $servicesClientUsersGeneral = new ServicesClientUsersGeneral();
            $loginUserProfile = Auth::user();
            $flagShowDetailsSalary = $servicesClientUsersGeneral->checkPermissionSalary($loginUserProfile);
        }

        return $flagShowDetailsSalary;
    }

    /**
     * [Employee] Show [Careers History] section
     * @param mixed $loginUserId
     * @return bool
     */
    public static function showDetailsPermissionCareerHistory($loginUserId)
    {
        $flagShowDetailsCareerHistory = true;
        if (Auth::user()->type_id === config('constants.USER_EMPLOYEE')) {
            $flagShowDetailsCareerHistory = self::showRestrictedEmployeeProfileSections($loginUserId);
        }

        return $flagShowDetailsCareerHistory;
    }

    /**
     * [Employee] Show [Job Rank History] section
     * @param mixed $loginUserId
     * @return bool
     */
    public static function showDetailsPermissionJobRankHistory($loginUserId)
    {
        $flagShowDetailsJobRankHistory = true;
        if (Auth::user()->type_id === config('constants.USER_EMPLOYEE')) {
            $flagShowDetailsJobRankHistory = self::showRestrictedEmployeeProfileSections($loginUserId);
        }

        return $flagShowDetailsJobRankHistory;
    }

    /**
     * [Employee] Show [HMO Eligibility History] section
     * @param mixed $loginUserId
     * @return bool
     */
    public static function showDetailsPermissionHMOEligibilityHistory($loginUserId)
    {
        $flagShowDetailsHMOEligibility = true;
        if (Auth::user()->type_id === config('constants.USER_EMPLOYEE')) {
            $flagShowDetailsHMOEligibility = self::showRestrictedEmployeeProfileSections($loginUserId);
        }

        return $flagShowDetailsHMOEligibility;
    }

    /**
     * [Employee] Show [Employee Information - SSS, Philhealth, PagIBIG, etc.] fields (Authorized teams - FNA, CSS, PNC, Finance)
     * @param mixed $loginUserId
     * @return bool
     */
    public static function showEmployeeInfoFieldsAuthorizedAll($loginUserId)
    {
        $flagShowInfoFields = true;
        if (Auth::user()->type_id === config('constants.USER_EMPLOYEE')) {
            $addExceptTeams = [
                "Diversify OSS - Audit and Compliance",
                "Diversify OSS - Admin and Facilities",
                "Diversify OSS - Client Services",
                "Diversify OSS - Client Success",
                "Diversify OSS - COO",
                "Diversify OSS - Finance"
            ];

            $clientHGSOSSID = config('constants.CLIENT_DOSS_ID');
            $modelServicesTeamOSS = ClientTeam::where(
                [
                    ["cte_client_id", "=", $clientHGSOSSID],
                    ["cte_name", "LIKE", "%OSS - Finance%"]
                ]
            );

            $assignServicesTeamOSS = $modelServicesTeamOSS->get();
            $assignServicesTeamOSSNames = [];
            if ($assignServicesTeamOSS->count() > 0) {
                $assignServicesTeamOSSCompile = $assignServicesTeamOSS->toArray();
                $assignServicesTeamOSSNames = array_column($assignServicesTeamOSSCompile, "cte_name");
            }

            if (LibUtility::isArray($assignServicesTeamOSSNames) === true) {
                $addExceptTeams = array_unique(array_merge($addExceptTeams, $assignServicesTeamOSSNames), SORT_REGULAR);
            }

            $flagShowInfoFields = self::showRestrictedEmployeeProfileSections($loginUserId, $addExceptTeams);
        }

        return $flagShowInfoFields;
    }

    /**
     * [Employee] Show [Employee Information - SSS, Philhealth, PagIBIG, etc.] fields (Authorized teams - PNC, Director Job Ranks)
     * @param mixed $loginUserId
     * @return bool
     */
    public static function showEmployeeInfoFieldsAuthorizedPNCTeamAndDirectors($loginUserId)
    {
        $flagShowInfoFieldsPNCTeamManagersDirectors = true;
        if (Auth::user()->type_id === config('constants.USER_EMPLOYEE')) {
            $flagShowInfoFieldsPNCTeamManagersDirectors = self::showRestrictedEmployeeProfileSections($loginUserId);
        }

        return $flagShowInfoFieldsPNCTeamManagersDirectors;
    }

    /**
     * [Employee] Show [Employee Information - SSS, Philhealth, PagIBIG, etc.] fields (PNC, CSS, FNA)
     * @param mixed $loginUserId
     * @return bool
     */
    public static function showEmployeeInfoFieldsAuthorizedPNCCSSTeam($loginUserId)
    {
        $flagShowInfoFieldsPNCCSSTeam = true;
        if (Auth::user()->type_id === config('constants.USER_EMPLOYEE')) {
            $addExceptTeams = [
                "Diversify OSS - Client Services",
                "Diversify OSS - Client Success",
                "Diversify OSS - COO"
            ];

            $flagShowInfoFieldsPNCCSSTeam = self::showRestrictedEmployeeProfileSections($loginUserId, $addExceptTeams);
        }

        return $flagShowInfoFieldsPNCCSSTeam;
    }

    /**
     * [Employee] Show [Employee Information - SSS, Philhealth, PagIBIG, etc.] fields (Authorized teams except CSS team)
     * @param mixed $loginUserId
     * @return bool
     */
    public static function showEmployeeInfoFieldsAuthorizedExceptCSSFNATeam($loginUserId)
    {
        $flagShowInfoFieldsExceptCSSTeam = true;
        if (Auth::user()->type_id === config('constants.USER_EMPLOYEE')) {
            $addExceptTeams = [
                "Diversify OSS - Finance",
                "Diversify OSS - Finance Lead"
            ];

            $clientHGSOSSID = config('constants.CLIENT_DOSS_ID');
            $modelServicesTeamOSS = ClientTeam::where(
                [
                    ["cte_client_id", "=", $clientHGSOSSID],
                    ["cte_name", "LIKE", "%OSS - Finance%"]
                ]
            );

            $assignServicesTeamOSS = $modelServicesTeamOSS->get();
            $assignServicesTeamOSSNames = [];
            if ($assignServicesTeamOSS->count() > 0) {
                $assignServicesTeamOSSCompile = $assignServicesTeamOSS->toArray();
                $assignServicesTeamOSSNames = array_column($assignServicesTeamOSSCompile, "cte_name");
            }

            if (LibUtility::isArray($assignServicesTeamOSSNames) === true) {
                $addExceptTeams = array_unique(array_merge($addExceptTeams, $assignServicesTeamOSSNames), SORT_REGULAR);
            }

            $flagShowInfoFieldsExceptCSSTeam = self::showRestrictedEmployeeProfileSections($loginUserId, $addExceptTeams);
        }

        return $flagShowInfoFieldsExceptCSSTeam;
    }

    /**
     * [Employee] Show [Employee Information - SSS, Philhealth, PagIBIG, etc.] fields (Custom per team)
     * @param mixed $loginUserId
     * @param mixed $addExceptTeams
     * @return bool
     */
    public static function showEmployeeInfoFieldsAuthorizedCustomPerTeam($loginUserId, $addExceptTeams)
    {
        $flagShowInfoFieldsExceptCSSTeam = true;
        if (Auth::user()->type_id === config('constants.USER_EMPLOYEE')) {
            $flagShowInfoFieldsExceptCSSTeam = self::showRestrictedEmployeeProfileSections($loginUserId, $addExceptTeams);
        }

        return $flagShowInfoFieldsExceptCSSTeam;
    }

    /**
     * [Employee] Show [Employee Information - SSS, Philhealth, PagIBIG, etc.] fields (IT team)
     * @param mixed $detailsLoginUserId
     * @return bool
     */
    public static function showEmployeeInfoFieldsAuthorizedITTeam($loginUserDepartmentID, $detailsLoginUserId)
    {
        $selectedClientTeams = \App\Models\ClientTeam::where([
            ["cte_id", "=", $loginUserDepartmentID]
        ])->get()[0] ?? [];

        $loggedInUserEmployeeTeamName = $selectedClientTeams->cte_name ?? "";
        $addExceptTeams = [];
        $eligibleTeamEntity = [
            "Diversify OSS - IT Infrastructure"
        ];

        if (in_array($loggedInUserEmployeeTeamName, $eligibleTeamEntity) === true) {
            $addExceptTeams = [$loggedInUserEmployeeTeamName];
        }

        return HelperFunctions::showEmployeeInfoFieldsAuthorizedCustomPerTeam($detailsLoginUserId, $addExceptTeams);
    }

    /**
     * [Employee] Show [Employee Information - SSS, Philhealth, PagIBIG, etc.] fields (IT team)
     * @param mixed $detailsLoginUserId
     * @return bool
     */
    public static function showEmployeeInfoTabLeaveTrackers($loginUserId)
    {
        $flagTabShowLeaveTrackers = false;
        if (Auth::user()->type_id === config('constants.USER_EMPLOYEE')) {
            $addExceptTeams = [
                "Diversify OSS - Audit and Compliance",
                "Diversify OSS - Admin and Facilities",
                "Diversify OSS - Client Services",
                "Diversify OSS - Client Success",
                "Diversify OSS - COO",
                "Diversify OSS - Finance",
                "Diversify OSS - Finance Lead"
            ];


            $clientHGSOSSID = config('constants.CLIENT_DOSS_ID');
            $modelServicesTeamOSS = ClientTeam::where(
                [
                    ["cte_client_id", "=", $clientHGSOSSID],
                    ["cte_name", "LIKE", "%OSS - Finance%"]
                ]
            );

            $assignServicesTeamOSS = $modelServicesTeamOSS->get();
            $assignServicesTeamOSSNames = [];
            if ($assignServicesTeamOSS->count() > 0) {
                $assignServicesTeamOSSCompile = $assignServicesTeamOSS->toArray();
                $assignServicesTeamOSSNames = array_column($assignServicesTeamOSSCompile, "cte_name");
            }

            if (LibUtility::isArray($assignServicesTeamOSSNames) === true) {
                $addExceptTeams = array_unique(array_merge($addExceptTeams, $assignServicesTeamOSSNames), SORT_REGULAR);
            }

            $flagTabShowLeaveTrackers = self::showRestrictedEmployeeProfileSections($loginUserId, $addExceptTeams);
        }

        if (Auth::user()->type_id === config('constants.SUPER_ADMIN')) {
            $flagTabShowLeaveTrackers = true;
        }

        return $flagTabShowLeaveTrackers;
    }

    /**
     * [Employee] Show restricted sections/fields (PNC team -> Can access, DOSS managers -> cant access)
     * @param mixed $loginUserId
     * @param array $addExceptTeams
     * @return bool
     */
    private static function showRestrictedEmployeeProfileSections($loginUserId, $addExceptTeams = [])
    {
        $flagShowDetails = true;
        $employeeService = new EmployeeService();
        $modelEmployee = new Employee();
        $employeeIsActive = 1;
        $whereParams = [
            ["emp_user_id", "=", $loginUserId],
            ["emp_isactive", "=", $employeeIsActive]
        ];

        $employeeID = -1;
        $employeeDetailsByLoggedInUser = $modelEmployee->select("id", "emp_client_team_id")->where(
            $whereParams
        );

        if ($employeeDetailsByLoggedInUser->get()->count() > 0) {
            $employeeID = $employeeDetailsByLoggedInUser->first()["id"];
        }

        $selectedEmployeeJobRank = [];
        $selectedTeam = [];
        if ($employeeID > 0) {
            $selectedEmployeeJobRank = $employeeService->assignEmployeeServiceJobRank($employeeID)["selected_employee_job_rank"] ?? [];
            $selectedTeam = $employeeDetailsByLoggedInUser->first()->team()->get();
        }

        if (LibUtility::isArray($selectedEmployeeJobRank) === true) {
            $eligibleJobRanks = [
                "JR_D1DIRGEN",
                "JR_D2DIRSR",
                "JR_D2DIREXEC"
            ];

            $assignJobRank = $selectedEmployeeJobRank["code"] ?? "";
            if (in_array($assignJobRank, $eligibleJobRanks) !== true) {
                $flagShowDetails = false;
            }
        }		

        if ( !empty($selectedTeam) && $selectedTeam->count() > 0) {
            $eligibleTeams = [];

            $assignSelectedTeam = $selectedTeam[0]->cte_name ?? "";
            preg_match('/People and Culture/', $assignSelectedTeam, $matchCount, PREG_OFFSET_CAPTURE);
            if (LibUtility::isArray($matchCount) === true) {
                $eligibleTeams = [$assignSelectedTeam];
            }

            $assignEligibleTeams = array_merge($eligibleTeams, $addExceptTeams);
            if (in_array($assignSelectedTeam, $assignEligibleTeams) === true) {
                $flagShowDetails = true;
            }
        }

        return $flagShowDetails;
    }

    /**
     * [Payroll Payrun & Registry] Assign deminimis daily rate
     * @param mixed $deminimisAmount
     * @return float
     */
    public static function getDeminimisRateDaily($deminimisAmount)
    {
        $totalMonthsInYear = 12;
        $totalDaysInYear = 261;
        return round(($deminimisAmount * $totalMonthsInYear) / $totalDaysInYear, 2);
    }

    /**
     * [Payroll Payrun & Registry] Assign deminimis hourly rate
     * @param mixed $deminimisAmountDaily
     * @return float
     */
    public static function getDeminimisRateHourly($deminimisAmountDaily)
    {
        $totalHoursWorkingDay = 8;
        return round (($deminimisAmountDaily / $totalHoursWorkingDay), 2);
    }

    /**
     * Subtract a given number of business days from a date. 
     * @param object Carbon\Carbon $date 
     * @param int $days 
     * @return object Carbon\Carbon 
     */
    public static function subtractBusinessDays(Carbon $date, int $days)
    {
    	$businessDays = 0;
    	$currentDate = $date->copy();
    	while ($businessDays < $days) {
    		$currentDate->subDay();
    		if ($currentDate->isWeekday()) {
    			$businessDays++;
    		}
    	}
    	return $currentDate;
    }

    public static function getIdByName($model, $column, $name, $idColumn = 'id')
    {
        $record = $model::where($column, $name)->first();
        return $record ? $record->{$idColumn} : null;  // Use the specified ID column or fallback to 'id'
    }

    public static function getTicketCategoryIdByName($cat_name)
    {
        return self::getIdByName(TicketCategory::class, 'cat_name', $cat_name, 'cat_id');
    }

    public static function getClientTeamIdByName($client_team_name)
    {
        return self::getIdByName(ClientTeam::class, 'cte_name', $client_team_name, 'cte_id');
    }

    public static function accessToDocuments($userId, $profileId)
    {
        $user = User::find($userId);
        $employee = Employee::find($profileId);
        $userID = $employee->emp_user_id ?? 0;
        $empClientID = $employee->emp_client_id ?? 0;
        if ($user->id == $userID) {
            return true;
        }

        return !$user->isHRIS && $empClientID == config("constants.CLT_DOSS_LABEL_CLIENT_ID") ? false : true;
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