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
        } catch (Exception $exception) {
            $errorMsg = $exception->getMessage();
            \Log::error("DB Migration Upsert Teams Members Error: $errorMsg");
        }
    }

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
     * Reverse the migrations.
     */
    public function down(): void
    {
        //DB::table('teams_members')->delete();
        TeamsMembers::query()->delete();
    }
};
