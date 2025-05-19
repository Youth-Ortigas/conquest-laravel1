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

            $this->assignMembersTeamLeaders();
        } catch (Exception $exception) {
            $errorMsg = $exception->getMessage();
            \Log::error("DB Migration Upsert Teams Members Error: $errorMsg");
        }
    }

    /**
     * [General] Assign > Save <teams_members> (Team 1)
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
            "X29NA" => ["cabin_name" => "Cabin 4"],
            "W0LNX" => ["cabin_name" => "Cabin 9"],
            "K87F7" => ["cabin_name" => "Cabin TBA"],
            "E104M" => ["cabin_name" => "Cabin TBA"],
            "D07R3" => ["cabin_name" => "Cabin 3"],
            "U97U1" => ["cabin_name" => "Cabin TBA"],
            "C96XA" => ["cabin_name" => "Cabin 6"],
            "E0N90" => ["cabin_name" => "Cabin 7"],
            "B7UB8" => ["cabin_name" => "Cabin 1"],
            "Y5G74" => ["cabin_name" => "Cabin 6"],
            "E15GR" => ["cabin_name" => "Cabin 8"],
            "W16PL" => ["cabin_name" => "Cabin 4"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1 && $modelUsers->count() >= 12) {
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
     * [General] Assign > Save <teams_members> (Team 2)
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
            "Q49JS" => ["cabin_name" => "Cabin TBA"],
            "R63UX" => ["cabin_name" => "Cabin TBA"],
            "T87S8" => ["cabin_name" => "Cabin TBA"],
            "T871C" => ["cabin_name" => "Cabin TBA"],
            "C983D" => ["cabin_name" => "Cabin TBA"],
            "R64KB" => ["cabin_name" => "Cabin TBA"],
            "L96LV" => ["cabin_name" => "Cabin TBA"],
            "U8L74" => ["cabin_name" => "Cabin TBA"],
            "T7NPM" => ["cabin_name" => "Cabin TBA"],
            "Y60KK" => ["cabin_name" => "Cabin TBA"],
            "P37JW" => ["cabin_name" => "Cabin TBA"],
            "Z2982" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1 && $modelUsers->count() >= 12) {
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
     * [General] Assign > Save <teams_members> (Team 3)
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
            "Z1EYH" => ["cabin_name" => "Cabin TBA"],
            "N0M4Z" => ["cabin_name" => "Cabin TBA"],
            "N10LC" => ["cabin_name" => "Cabin TBA"],
            "E1047" => ["cabin_name" => "Cabin TBA"],
            "V08VW" => ["cabin_name" => "Cabin TBA"],
            "Q41QE" => ["cabin_name" => "Cabin TBA"],
            "G2WX4" => ["cabin_name" => "Cabin TBA"],
            "L8UD8" => ["cabin_name" => "Cabin TBA"],
            "N0YS1" => ["cabin_name" => "Cabin TBA"],
            "V9VXL" => ["cabin_name" => "Cabin TBA"],
            "A72QS" => ["cabin_name" => "Cabin TBA"],
            "H414V" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1 && $modelUsers->count() >= 12) {
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
     * [General] Assign > Save <teams_members> (Team 4)
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
            "Q3FG3" => ["cabin_name" => "Cabin TBA"],
            "M9CGL" => ["cabin_name" => "Cabin TBA"],
            "D09X6" => ["cabin_name" => "Cabin TBA"],
            "G3272" => ["cabin_name" => "Cabin TBA"],
            "S74RM" => ["cabin_name" => "Cabin TBA"],
            "D07VT" => ["cabin_name" => "Cabin TBA"],
            "U8KZU" => ["cabin_name" => "Cabin TBA"],
            "Y5DLC" => ["cabin_name" => "Cabin TBA"],
            "P2KZK" => ["cabin_name" => "Cabin TBA"],
            "J6DG5" => ["cabin_name" => "Cabin TBA"],
            "C8CZN" => ["cabin_name" => "Cabin TBA"],
            "J72CZ" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1 && $modelUsers->count() >= 12) {
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
     * [General] Assign > Save <teams_members> (Team 5)
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
            "X1Q5H" => ["cabin_name" => "Cabin TBA"],
            "Y65Y9" => ["cabin_name" => "Cabin TBA"],
            "B87UH" => ["cabin_name" => "Cabin TBA"],
            "X213H" => ["cabin_name" => "Cabin TBA"],
            "U97Y6" => ["cabin_name" => "Cabin TBA"],
            "X29X1" => ["cabin_name" => "Cabin TBA"],
            "C96WX" => ["cabin_name" => "Cabin TBA"],
            "L8DDR" => ["cabin_name" => "Cabin TBA"],
            "H3D3L" => ["cabin_name" => "Cabin TBA"],
            "K85NT" => ["cabin_name" => "Cabin TBA"],
            "U8UKW" => ["cabin_name" => "Cabin TBA"],
            "V00XA" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1 && $modelUsers->count() >= 12) {
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
     * [General] Assign > Save <teams_members> (Team 6)
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
            "Y6662" => ["cabin_name" => "Cabin TBA"],
            "E10XW" => ["cabin_name" => "Cabin TBA"],
            "U98L6" => ["cabin_name" => "Cabin TBA"],
            "R654F" => ["cabin_name" => "Cabin TBA"],
            "M07CZ" => ["cabin_name" => "Cabin TBA"],
            "M08A5" => ["cabin_name" => "Cabin TBA"],
            "M07H5" => ["cabin_name" => "Cabin TBA"],
            "W0ZNR" => ["cabin_name" => "Cabin TBA"],
            "U8PUB" => ["cabin_name" => "Cabin TBA"],
            "K7FZY" => ["cabin_name" => "Cabin TBA"],
            "Z1K0G" => ["cabin_name" => "Cabin TBA"],
            "X26AT" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1 && $modelUsers->count() >= 12) {
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
     * [General] Assign > Save <teams_members> (Team 7)
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
            "U98M6" => ["cabin_name" => "Cabin TBA"],
            "X21SA" => ["cabin_name" => "Cabin TBA"],
            "P326M" => ["cabin_name" => "Cabin TBA"],
            "S765F" => ["cabin_name" => "Cabin TBA"],
            "M08M8" => ["cabin_name" => "Cabin TBA"],
            "V08Z6" => ["cabin_name" => "Cabin TBA"],
            "P30JC" => ["cabin_name" => "Cabin TBA"],
            "S6R9R" => ["cabin_name" => "Cabin TBA"],
            "A6TEY" => ["cabin_name" => "Cabin TBA"],
            "W0S9T" => ["cabin_name" => "Cabin TBA"],
            "R5K9G" => ["cabin_name" => "Cabin TBA"],
            "W10WX" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1 && $modelUsers->count() >= 12) {
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
     * [General] Assign > Save <teams_members> (Team 8)
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
            "A7630" => ["cabin_name" => "Cabin TBA"],
            "Q3M2R" => ["cabin_name" => "Cabin TBA"],
            "W19WM" => ["cabin_name" => "Cabin TBA"],
            "S6Z7N" => ["cabin_name" => "Cabin TBA"],
            "T7DQ0" => ["cabin_name" => "Cabin TBA"],
            "W103S" => ["cabin_name" => "Cabin TBA"],
            "F1E4T" => ["cabin_name" => "Cabin TBA"],
            "S74YV" => ["cabin_name" => "Cabin TBA"],
            "P30FT" => ["cabin_name" => "Cabin TBA"],
            "J74DT" => ["cabin_name" => "Cabin TBA"],
            "M07M1" => ["cabin_name" => "Cabin TBA"],
            "G2S33" => ["cabin_name" => "Cabin TBA"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1 && $modelUsers->count() >= 12) {
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
     * [General] Assign > Save <teams_members> (Team Leaders)
     * @return void
     */
    public function assignMembersTeamLeaders()
    {
        $whereParamsTeams = [
            ["team_name", "=", "Team Leaders"],
            ["team_code", "=", "teamleaders"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $whereParamsUsersRegCodes = [
            "T7SYV" => ["cabin_name" => "Cabin 5"],
            "A6XN9" => ["cabin_name" => "Cabin 5"],
            "B85C3" => ["cabin_name" => "Cabin 5"],
            "F26SZ" => ["cabin_name" => "Cabin 5"],
            "C8CFM" => ["cabin_name" => "Cabin 5"],
            "B7AZ8" => ["cabin_name" => "Cabin 10"],
            "B7AZ7" => ["cabin_name" => "Cabin 10"],
            "T82US" => ["cabin_name" => "Cabin 10"],
            "H3HW8" => ["cabin_name" => "Cabin 10"],
            "V9LJ5" => ["cabin_name" => "Cabin 10"]
        ];

        $modelUsers = User::whereIn("reg_code", array_keys($whereParamsUsersRegCodes));
        $assignTeamsUsers = [];
        if ($modelTeams->count() >= 1 && $modelUsers->count() >= 10) {
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
     * Reverse the migrations.
     */
    public function down(): void
    {
        TeamsMembers::query()->delete();
    }
};
