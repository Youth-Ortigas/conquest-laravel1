<?php

namespace App\Services;
use App\Models\User;
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
     * [General] Response setter/getter
     * @var array
     */
    protected $assignResponse = [
        'status_code' => 200,
        'msg_error' => '',
        'msg_success' => 'Success',
        'data' => []
    ];

    /**
     * [General] Reference employee info
     * @var array
     */
    protected $referenceInfo = [];

    /**
     * [General] Console fetch save data
     * @return void
     */
    public function consoleFetchSaveData()
    {
        try {
            $this->assignResponse = $this->fetchDataAPI()->upsertData();
        } catch (\Exception $oException) {
            \Log::error(print_r($oException->getMessage(), true));
        }
    }

    /**
     * [General] Fetch API Data
     * @return $this
     * @throws \Exception
     */
    public function fetchDataAPI()
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

        return $this->assignReturnResponse(json_decode($checkData, true));
    }

    /**
     * [General] Upsert <users> data
     * @return void
     */
    public function upsertData()
    {
        $counterData = 0;
        $checkAPIRegistration = $this->assignResponse["data"];
        if (LibUtility::isArray($checkAPIRegistration)) {
            foreach ($checkAPIRegistration as $dataItem) {
                $modelUsers = new User();
                $regCode = $dataItem["reg_code"] ?? "";
                if (LibUtility::isString($regCode)) {
                    $checkExistingReg = User::where([
                        ["reg_code", "=", $regCode]
                    ]);

                    if ($checkExistingReg->count() < 1) {
                        $modelUsers->name = $dataItem["name_full"] ?? "TBA";
                        $modelUsers->reg_code = $regCode;
                        $modelUsers->email = $dataItem["email"] ?? "TBA";
                        $modelUsers->first_name = $dataItem["name_first"] ?? "TBA";
                        $modelUsers->last_name = $dataItem["name_last"] ?? "TBA";
                        $modelUsers->type_id = config("constants.USER_PARTICIPANT");
                        $modelUsers->save();
                        $counterData++;
                        \Log::info("Save new <users record>: $regCode");
                    }
                }
            }
        }

        if ($counterData < 1) {
            \Log::info("No data saved");
        }

        \Log::info("Saved records: $counterData");
    }

    /**
     * [General] Assign return response
     * @param mixed $assignData
     * @return $this
     * @throws \Exception
     */
    private function assignReturnResponse($assignData)
    {
        if (LibUtility::isString((trim($this->assignResponse['msg_error']))) === true) {
            throw new \Exception($this->assignResponse['msg_error']);
        }

        $this->assignResponse['data'] = $assignData;
        return $this;
    }
}
