<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Teams;
use App\Lib\LibUtility;

/**
 * Class DB Migration (Teams - Upsert data)
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since May 11, 2025
 */
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
            foreach ($assignTeams as $teamIndex => $teamItem) {
                $whereParams = [
                    ["team_name", "=", $teamItem["team_name"]],
                    ["team_code", "=", $teamItem["team_code"]]
                ];

                $modelTeams = Teams::where($whereParams);
                if ($modelTeams->count() < 1) {
                    $assignTeamsModel[$teamIndex] = $teamItem;
                }
            }

            if (LibUtility::isArray($assignTeamsModel)) {
                DB::table('teams')->insert($assignTeamsModel);
            }

        } catch (Exception $exception) {
            $errorMsg = $exception->getMessage();
            \Log::error("DB Migration Upsert Teams Error: $errorMsg");
        }
    }

    /**
     * [General] Assign Teams
     * @return array[]
     */
    public function assignTeams()
    {
        $userIDPrimaryTeam1 = User::where([
            ["reg_code", "=", "X29NA"],
            ["first_name", "=", "Wendy Mae"],
            ["last_name", "=", "Villasin"]
        ])->first();

        $userIDSecondaryTeam1 = User::where([
            ["reg_code", "=", "W0LNX"],
            ["first_name", "=", "Elijah"],
            ["last_name", "=", "Villasor"]
        ])->first();

        $userIDPrimaryTeam2 = User::where([
            ["reg_code", "=", "Q49JS"],
            ["first_name", "=", "Nicolas Kevin"],
            ["last_name", "=", "Sabado"]
        ])->first();

        $userIDSecondaryTeam2 = User::where([
            ["reg_code", "=", "R63UX"],
            ["first_name", "=", "Mckayla Rio"],
            ["last_name", "=", "Perater"]
        ])->first();

        $userIDPrimaryTeam3 = User::where([
            ["reg_code", "=", "Z1EYH"],
            ["first_name", "=", "Elijah"],
            ["last_name", "=", "Cheng"]
        ])->first();

        $userIDSecondaryTeam3 = User::where([
            ["reg_code", "=", "N0M4Z"],
            ["first_name", "=", "Bea Camille"],
            ["last_name", "=", "Dairo"]
        ])->first();

        $userIDPrimaryTeam4 = User::where([
            ["reg_code", "=", "Q3FG3"],
            ["first_name", "=", "Ericka Joy"],
            ["last_name", "=", "Magboo"]
        ])->first();

        $userIDSecondaryTeam4 = User::where([
            ["reg_code", "=", "M9CGL"],
            ["first_name", "=", "Joshua Emmanuel"],
            ["last_name", "=", "Moya"]
        ])->first();

        $userIDPrimaryTeam5 = User::where([
            ["reg_code", "=", "X1Q5H"],
            ["first_name", "=", "Air"],
            ["last_name", "=", "Licud"]
        ])->first();

        $userIDSecondaryTeam5 = User::where([
            ["reg_code", "=", "Y65Y9"],
            ["first_name", "=", "Aeon Margarett"],
            ["last_name", "=", "Talaguit"]
        ])->first();

        $userIDPrimaryTeam6 = User::where([
            ["reg_code", "=", "Y6662"],
            ["first_name", "=", "Matthew"],
            ["last_name", "=", "Corteza"]
        ])->first();

        $userIDSecondaryTeam6 = User::where([
            ["reg_code", "=", "E10XW"],
            ["first_name", "=", "Alyanna Jamie"],
            ["last_name", "=", "Lim"]
        ])->first();

        $userIDPrimaryTeam7 = User::where([
            ["reg_code", "=", "U98M6"],
            ["first_name", "=", "Ashley Allsun"],
            ["last_name", "=", "Irwin"]
        ])->first();

        $userIDSecondaryTeam7 = User::where([
            ["reg_code", "=", "X21SA"],
            ["first_name", "=", "Joshua"],
            ["last_name", "=", "Illera"]
        ])->first();

        $userIDPrimaryTeam8 = User::where([
            ["reg_code", "=", "A7630"],
            ["first_name", "=", "Ma. Vinarose"],
            ["last_name", "=", "Mendoza"]
        ])->first();

        $userIDSecondaryTeam8 = User::where([
            ["reg_code", "=", "W19WM"],
            ["first_name", "=", "Pristine Rui"],
            ["last_name", "=", "Sazon"]
        ])->first();

        $upsertTeams1 = [
            'team_name' => 'Team 1',
            'team_code' => 'team1',
            'team_leader_user_id_primary' => $userIDPrimaryTeam1->id ?? -1,
            'team_leader_user_id_secondary' => $userIDSecondaryTeam1->id ?? -1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $upsertTeams2 = [
            'team_name' => 'Team 2',
            'team_code' => 'team2',
            'team_leader_user_id_primary' => $userIDPrimaryTeam2->id ?? -1,
            'team_leader_user_id_secondary' => $userIDSecondaryTeam2->id ?? -1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $upsertTeams3 = [
            'team_name' => 'Team 3',
            'team_code' => 'team3',
            'team_leader_user_id_primary' => $userIDPrimaryTeam3->id ?? -1,
            'team_leader_user_id_secondary' => $userIDSecondaryTeam3->id ?? -1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $upsertTeams4 = [
            'team_name' => 'Team 4',
            'team_code' => 'team4',
            'team_leader_user_id_primary' => $userIDPrimaryTeam4->id ?? -1,
            'team_leader_user_id_secondary' => $userIDSecondaryTeam4->id ?? -1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $upsertTeams5 = [
            'team_name' => 'Team 5',
            'team_code' => 'team5',
            'team_leader_user_id_primary' => $userIDPrimaryTeam5->id ?? -1,
            'team_leader_user_id_secondary' => $userIDSecondaryTeam5->id ?? -1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $upsertTeams6 = [
            'team_name' => 'Team 6',
            'team_code' => 'team6',
            'team_leader_user_id_primary' => $userIDPrimaryTeam6->id ?? -1,
            'team_leader_user_id_secondary' => $userIDSecondaryTeam6->id ?? -1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $upsertTeams7 = [
            'team_name' => 'Team 7',
            'team_code' => 'team7',
            'team_leader_user_id_primary' => $userIDPrimaryTeam7->id ?? -1,
            'team_leader_user_id_secondary' => $userIDSecondaryTeam7->id ?? -1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $upsertTeams8 = [
            'team_name' => 'Team 8',
            'team_code' => 'team8',
            'team_leader_user_id_primary' => $userIDPrimaryTeam8->id ?? -1,
            'team_leader_user_id_secondary' => $userIDSecondaryTeam8->id ?? -1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

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

        $upsertTeamsLeaders = [
            'team_name' => 'Team Leaders',
            'team_code' => 'teamleaders',
            'team_leader_user_id_primary' => 1,
            'team_leader_user_id_secondary' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        return [
            $upsertTeams1, $upsertTeams2, $upsertTeams3, $upsertTeams4, $upsertTeams5,
            $upsertTeams6, $upsertTeams7, $upsertTeams8, $upsertTeams9, $upsertTeams10,
            $upsertTeamsLeaders
        ];
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $assignTeams = $this->assignTeams();
        $assignTeamsCodeColumns = array_column($assignTeams, "team_code");
        Teams::whereIn("team_code", $assignTeamsCodeColumns)->delete();
    }
};
