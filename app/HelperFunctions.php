<?php
namespace App;
use DB;


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
