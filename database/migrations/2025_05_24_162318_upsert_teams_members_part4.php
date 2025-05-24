<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Teams;
use App\Lib\LibUtility;
use App\Models\TeamsMembers;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $this->assignMembersTeam1();
            $this->assignMembersTeam2();
            $this->assignMembersTeam3();
            $this->assignMembersTeam4();

            $this->assignMembersTeam5();
            $this->assignMembersTeam6();
            $this->assignMembersTeam7();
            $this->assignMembersTeam8();
        } catch (Exception $exception) {
            $errorMsg = $exception->getMessage();
            \Log::error("DB Migration Upsert Teams Members Error: $errorMsg");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }

    /**
     * [General] Designate new <teams_members> (Team 1)
     * @return void
     */
    public function assignMembersTeam1()
    {
        $whereParamsTeams = [
            ["team_name", "=", "Team 1"],
            ["team_code", "=", "team1"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $whereParamsUsersRegCodes = [
            "J77N4" => ["cabin_name" => "Cabin TBA"],
            "X22EL" => ["cabin_name" => "Cabin TBA"],
            "H451M" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1) {
            $assignTeams = $modelTeams->first();
            foreach ($modelUsers->get() as $userIndex => $userItem) {
                $userItemID = $userItem->id ?? -1;
                $whereParams = [
                    ["teams_id", "=", $assignTeams->id],
                    ["teams_user_id", "=", $userItemID]
                ];

                $checkExistingUserInTeam = TeamsMembers::where($whereParams);
                if ($checkExistingUserInTeam->count() < 1) {
                    $assignTeamsUsers[$userIndex] = [
                        "teams_id"      => $assignTeams->id,
                        "teams_user_id" => $userItemID,
                        "cabin_name"    => $whereParamsUsersRegCodes[$userItem->reg_code]["cabin_name"] ?? "Cabin TBA",
                        "created_at"    => now(),
                        "updated_at"    => now()
                    ];
                }
            }
        }

        if (LibUtility::isArray($assignTeamsUsers)) {
            DB::table('teams_members')->insert($assignTeamsUsers);
        }
    }

    /**
     * [General] Designate new <teams_members> (Team 2)
     * @return void
     */
    public function assignMembersTeam2()
    {
        $whereParamsTeams = [
            ["team_name", "=", "Team 2"],
            ["team_code", "=", "team2"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $whereParamsUsersRegCodes = [
            "J77QH" => ["cabin_name" => "Cabin TBA"],
            "A786V" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1) {
            $assignTeams = $modelTeams->first();
            foreach ($modelUsers->get() as $userIndex => $userItem) {
                $userItemID = $userItem->id ?? -1;
                $whereParams = [
                    ["teams_id", "=", $assignTeams->id],
                    ["teams_user_id", "=", $userItemID]
                ];

                $checkExistingUserInTeam = TeamsMembers::where($whereParams);
                if ($checkExistingUserInTeam->count() < 1) {
                    $assignTeamsUsers[$userIndex] = [
                        "teams_id"      => $assignTeams->id,
                        "teams_user_id" => $userItemID,
                        "cabin_name"    => $whereParamsUsersRegCodes[$userItem->reg_code]["cabin_name"] ?? "Cabin TBA",
                        "created_at"    => now(),
                        "updated_at"    => now()
                    ];
                }
            }
        }

        if (LibUtility::isArray($assignTeamsUsers)) {
            DB::table('teams_members')->insert($assignTeamsUsers);
        }
    }

    /**
     * [General] Designate new <teams_members> (Team 3)
     * @return void
     */
    public function assignMembersTeam3()
    {
        $whereParamsTeams = [
            ["team_name", "=", "Team 3"],
            ["team_code", "=", "team3"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $whereParamsUsersRegCodes = [
            "E100X" => ["cabin_name" => "Cabin TBA"],
            "W11QP" => ["cabin_name" => "Cabin TBA"],
            "D00H9" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1) {
            $assignTeams = $modelTeams->first();
            foreach ($modelUsers->get() as $userIndex => $userItem) {
                $userItemID = $userItem->id ?? -1;
                $whereParams = [
                    ["teams_id", "=", $assignTeams->id],
                    ["teams_user_id", "=", $userItemID]
                ];

                $checkExistingUserInTeam = TeamsMembers::where($whereParams);
                if ($checkExistingUserInTeam->count() < 1) {
                    $assignTeamsUsers[$userIndex] = [
                        "teams_id"      => $assignTeams->id,
                        "teams_user_id" => $userItemID,
                        "cabin_name"    => $whereParamsUsersRegCodes[$userItem->reg_code]["cabin_name"] ?? "Cabin TBA",
                        "created_at"    => now(),
                        "updated_at"    => now()
                    ];
                }
            }
        }

        if (LibUtility::isArray($assignTeamsUsers)) {
            DB::table('teams_members')->insert($assignTeamsUsers);
        }
    }

    /**
     * [General] Designate new <teams_members> (Team 4)
     * @return void
     */
    public function assignMembersTeam4()
    {
        $whereParamsTeams = [
            ["team_name", "=", "Team 4"],
            ["team_code", "=", "team4"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $whereParamsUsersRegCodes = [
            "D00L5" => ["cabin_name" => "Cabin TBA"],
            "D04EA" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1) {
            $assignTeams = $modelTeams->first();
            foreach ($modelUsers->get() as $userIndex => $userItem) {
                $userItemID = $userItem->id ?? -1;
                $whereParams = [
                    ["teams_id", "=", $assignTeams->id],
                    ["teams_user_id", "=", $userItemID]
                ];

                $checkExistingUserInTeam = TeamsMembers::where($whereParams);
                if ($checkExistingUserInTeam->count() < 1) {
                    $assignTeamsUsers[$userIndex] = [
                        "teams_id"      => $assignTeams->id,
                        "teams_user_id" => $userItemID,
                        "cabin_name"    => $whereParamsUsersRegCodes[$userItem->reg_code]["cabin_name"] ?? "Cabin TBA",
                        "created_at"    => now(),
                        "updated_at"    => now()
                    ];
                }
            }
        }

        if (LibUtility::isArray($assignTeamsUsers)) {
            DB::table('teams_members')->insert($assignTeamsUsers);
        }
    }

    /**
     * [General] Designate new <teams_members> (Team 5)
     * @return void
     */
    public function assignMembersTeam5()
    {
        $whereParamsTeams = [
            ["team_name", "=", "Team 5"],
            ["team_code", "=", "team5"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $whereParamsUsersRegCodes = [
            "E11LA" => ["cabin_name" => "Cabin TBA"],
            "X22H6" => ["cabin_name" => "Cabin TBA"],
            "A77YH" => ["cabin_name" => "Cabin TBA"],
            "G33LT" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1) {
            $assignTeams = $modelTeams->first();
            foreach ($modelUsers->get() as $userIndex => $userItem) {
                $userItemID = $userItem->id ?? -1;
                $whereParams = [
                    ["teams_id", "=", $assignTeams->id],
                    ["teams_user_id", "=", $userItemID]
                ];

                $checkExistingUserInTeam = TeamsMembers::where($whereParams);
                if ($checkExistingUserInTeam->count() < 1) {
                    $assignTeamsUsers[$userIndex] = [
                        "teams_id"      => $assignTeams->id,
                        "teams_user_id" => $userItemID,
                        "cabin_name"    => $whereParamsUsersRegCodes[$userItem->reg_code]["cabin_name"] ?? "Cabin TBA",
                        "created_at"    => now(),
                        "updated_at"    => now()
                    ];
                }
            }
        }

        if (LibUtility::isArray($assignTeamsUsers)) {
            DB::table('teams_members')->insert($assignTeamsUsers);
        }
    }

    /**
     * [General] Designate new <teams_members> (Team 6)
     * @return void
     */
    public function assignMembersTeam6()
    {
        $whereParamsTeams = [
            ["team_name", "=", "Team 6"],
            ["team_code", "=", "team6"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $whereParamsUsersRegCodes = [
            "F22ZR" => ["cabin_name" => "Cabin TBA"],
            "G33NB" => ["cabin_name" => "Cabin TBA"],
            "R66Q6" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1) {
            $assignTeams = $modelTeams->first();
            foreach ($modelUsers->get() as $userIndex => $userItem) {
                $userItemID = $userItem->id ?? -1;
                $whereParams = [
                    ["teams_id", "=", $assignTeams->id],
                    ["teams_user_id", "=", $userItemID]
                ];

                $checkExistingUserInTeam = TeamsMembers::where($whereParams);
                if ($checkExistingUserInTeam->count() < 1) {
                    $assignTeamsUsers[$userIndex] = [
                        "teams_id"      => $assignTeams->id,
                        "teams_user_id" => $userItemID,
                        "cabin_name"    => $whereParamsUsersRegCodes[$userItem->reg_code]["cabin_name"] ?? "Cabin TBA",
                        "created_at"    => now(),
                        "updated_at"    => now()
                    ];
                }
            }
        }

        if (LibUtility::isArray($assignTeamsUsers)) {
            DB::table('teams_members')->insert($assignTeamsUsers);
        }
    }

    /**
     * [General] Designate new <teams_members> (Team 7)
     * @return void
     */
    public function assignMembersTeam7()
    {
        $whereParamsTeams = [
            ["team_name", "=", "Team 7"],
            ["team_code", "=", "team7"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $whereParamsUsersRegCodes = [
            "U8JJL" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1) {
            $assignTeams = $modelTeams->first();
            foreach ($modelUsers->get() as $userIndex => $userItem) {
                $userItemID = $userItem->id ?? -1;
                $whereParams = [
                    ["teams_id", "=", $assignTeams->id],
                    ["teams_user_id", "=", $userItemID]
                ];

                $checkExistingUserInTeam = TeamsMembers::where($whereParams);
                if ($checkExistingUserInTeam->count() < 1) {
                    $assignTeamsUsers[$userIndex] = [
                        "teams_id"      => $assignTeams->id,
                        "teams_user_id" => $userItemID,
                        "cabin_name"    => $whereParamsUsersRegCodes[$userItem->reg_code]["cabin_name"] ?? "Cabin TBA",
                        "created_at"    => now(),
                        "updated_at"    => now()
                    ];
                }
            }
        }

        if (LibUtility::isArray($assignTeamsUsers)) {
            DB::table('teams_members')->insert($assignTeamsUsers);
        }
    }

    /**
     * [General] Designate new <teams_members> (Team 8)
     * @return void
     */
    public function assignMembersTeam8()
    {
        $whereParamsTeams = [
            ["team_name", "=", "Team 8"],
            ["team_code", "=", "team8"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $whereParamsUsersRegCodes = [
            "Z22VQ" => ["cabin_name" => "Cabin TBA"],
            "Q44XN" => ["cabin_name" => "Cabin TBA"],
            "C8PPP" => ["cabin_name" => "Cabin TBA"],
            "S77Z2" => ["cabin_name" => "Cabin TBA"],
            "S78V4" => ["cabin_name" => "Cabin TBA"],
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1) {
            $assignTeams = $modelTeams->first();
            foreach ($modelUsers->get() as $userIndex => $userItem) {
                $userItemID = $userItem->id ?? -1;
                $whereParams = [
                    ["teams_id", "=", $assignTeams->id],
                    ["teams_user_id", "=", $userItemID]
                ];

                $checkExistingUserInTeam = TeamsMembers::where($whereParams);
                if ($checkExistingUserInTeam->count() < 1) {
                    $assignTeamsUsers[$userIndex] = [
                        "teams_id"      => $assignTeams->id,
                        "teams_user_id" => $userItemID,
                        "cabin_name"    => $whereParamsUsersRegCodes[$userItem->reg_code]["cabin_name"] ?? "Cabin TBA",
                        "created_at"    => now(),
                        "updated_at"    => now()
                    ];
                }
            }
        }

        if (LibUtility::isArray($assignTeamsUsers)) {
            DB::table('teams_members')->insert($assignTeamsUsers);
        }
    }
};
