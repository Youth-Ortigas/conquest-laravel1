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
            $assignTeams = $this->assignTeams();
            $assignTeamsModel = [];
            foreach ($assignTeams as $teamItem) {
                $whereParams = [
                    ["team_name", "=", $teamItem["team_name"]],
                    ["team_code", "=", $teamItem["team_code"]]
                ];

                $modelTeams = Teams::where($whereParams);
                if ($modelTeams->count() > 0) {
                    $modelTeams->update(
                        [
                            'team_leader_user_id_primary' => $teamItem["team_leader_user_id_primary"],
                            'team_leader_user_id_secondary' => $teamItem["team_leader_user_id_secondary"]
                        ]
                    );
                }
            }

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
        $assignTeams = $this->assignTeams();
        $assignTeamsModel = [];
        foreach ($assignTeams as $teamItem) {
            $whereParams = [
                ["team_name", "=", $teamItem["team_name"]],
                ["team_code", "=", $teamItem["team_code"]]
            ];

            $modelTeams = Teams::where($whereParams);
            if ($modelTeams->count() > 0) {
                $assignTeamsModel[] = $modelTeams->get()->pluck("id")->toArray();
            }
        }

        TeamsMembers::whereIn("teams_id", $assignTeamsModel)->delete();
    }

    /**
     * [General] Assign Teams
     * @return array[]
     */
    public function assignTeams()
    {
        $userIDPrimaryTeam9 = User::where([
            ["reg_code", "=", "H44Q0"],
            ["first_name", "=", "Jullie Marry"],
            ["last_name", "=", "Jabay"]
        ])->first();

        $userIDSecondaryTeam9 = User::where([
            ["reg_code", "=", "Z1EYH"],
            ["first_name", "=", "Elijah"],
            ["last_name", "=", "Cheng"]
        ])->first();

        $userIDPrimaryTeam10 = User::where([
            ["reg_code", "=", "X21SA"],
            ["first_name", "=", "Joshua"],
            ["last_name", "=", "Illera"]
        ])->first();

        $userIDSecondaryTeam10 = User::where([
            ["reg_code", "=", "P33NN"],
            ["first_name", "=", "Paula"],
            ["last_name", "=", "Clarito "]
        ])->first();

        $upsertTeams9 = [
            'team_name' => 'Team 9',
            'team_code' => 'team9',
            'team_leader_user_id_primary' => $userIDPrimaryTeam9->id ?? -1,
            'team_leader_user_id_secondary' => $userIDSecondaryTeam9->id ?? -1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $upsertTeams10 = [
            'team_name' => 'Team 10',
            'team_code' => 'team10',
            'team_leader_user_id_primary' => $userIDPrimaryTeam10->id ?? -1,
            'team_leader_user_id_secondary' => $userIDSecondaryTeam10->id ?? -1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        return [
            $upsertTeams9, $upsertTeams10,
        ];
    }

    /**
     * [General] Assign > Save <teams_members> (Team 9)
     * @return void
     */
    public function assignMembersTeam9()
    {
        $whereParamsTeams = [
            ["team_name", "=", "Team 9"],
            ["team_code", "=", "team9"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $whereParamsUsersRegCodes = [
            "H44Q0" => ["cabin_name" => "Cabin TBA"],
            "Q44AB" => ["cabin_name" => "Cabin TBA"],
            "E11M7" => ["cabin_name" => "Cabin TBA"],
            "V009E" => ["cabin_name" => "Cabin TBA"],
            "Q441M" => ["cabin_name" => "Cabin TBA"],
            "V00L6" => ["cabin_name" => "Cabin TBA"],
            "B88XY" => ["cabin_name" => "Cabin TBA"],
            "A77X2" => ["cabin_name" => "Cabin TBA"],
            "Z22WN" => ["cabin_name" => "Cabin TBA"],
            "N1269" => ["cabin_name" => "Cabin TBA"],
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
     * [General] Assign > Save <teams_members> (Team 10)
     * @return void
     */
    public function assignMembersTeam10()
    {
        $whereParamsTeams = [
            ["team_name", "=", "Team 10"],
            ["team_code", "=", "team10"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $whereParamsUsersRegCodes = [
            "P33NN" => ["cabin_name" => "Cabin TBA"],
            "T7DLE" => ["cabin_name" => "Cabin TBA"],
            "A75LA" => ["cabin_name" => "Cabin TBA"],
            "S77XJ" => ["cabin_name" => "Cabin TBA"],
            "B7JA6" => ["cabin_name" => "Cabin TBA"],
            "N11LF" => ["cabin_name" => "Cabin TBA"],
            "N10LC" => ["cabin_name" => "Cabin TBA"],
            "U99Z4" => ["cabin_name" => "Cabin TBA"],
            "X2378" => ["cabin_name" => "Cabin TBA"]
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
};
