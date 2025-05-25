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
        //@marylyn: No transfer: Team 2
        $this->transferTeamMembers1();
        $this->transferTeamMembers3();
        $this->transferTeamMembers4();
        $this->transferTeamMembers5();
        $this->transferTeamMembers6();
        $this->transferTeamMembers7();
        $this->transferTeamMembers8();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }

    /**
     * [General] Transfer to new <teams_members> (Team 1)
     * @return void
     */
    public function transferTeamMembers1()
    {
        $whereParamsTeams = [
            ["team_code", "=", "team1"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $userForTransfers = User::where([
            ["reg_code", "=", "Y6662"],
        ]);

        $userIDLists = $userForTransfers->get()->pluck("id")->toArray();
        DB::table("teams_members")->whereIn("teams_user_id", $userIDLists)->update(["teams_id" => $modelTeams->first()->id]);
    }

    /**
     * [General] Transfer to new <teams_members> (Team 3)
     * @return void
     */
    public function transferTeamMembers3()
    {
        $whereParamsTeams = [
            ["team_code", "=", "team3"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $userForTransfers = User::where([
            ["reg_code", "=", "U8KZU"],
            ["reg_code", "=", "W19WM"]
        ]);

        $userIDLists = $userForTransfers->get()->pluck("id")->toArray();
        DB::table("teams_members")->whereIn("teams_user_id", $userIDLists)->update(["teams_id" => $modelTeams->first()->id]);
    }

    /**
     * [General] Transfer to new <teams_members> (Team 4)
     * @return void
     */
    public function transferTeamMembers4()
    {
        $whereParamsTeams = [
            ["team_code", "=", "team4"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $userForTransfers = User::where([
            ["reg_code", "=", "P326M"],
            ["reg_code", "=", "U98L6"]
        ]);

        $userIDLists = $userForTransfers->get()->pluck("id")->toArray();
        DB::table("teams_members")->whereIn("teams_user_id", $userIDLists)->update(["teams_id" => $modelTeams->first()->id]);
    }

    /**
     * [General] Transfer to new <teams_members> (Team 5)
     * @return void
     */
    public function transferTeamMembers5()
    {
        $whereParamsTeams = [
            ["team_code", "=", "team5"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $userForTransfers = User::where([
            ["reg_code", "=", "L8UD8"]
        ]);

        $userIDLists = $userForTransfers->get()->pluck("id")->toArray();
        DB::table("teams_members")->whereIn("teams_user_id", $userIDLists)->update(["teams_id" => $modelTeams->first()->id]);
    }

    /**
     * [General] Transfer to new <teams_members> (Team 6)
     * @return void
     */
    public function transferTeamMembers6()
    {
        $whereParamsTeams = [
            ["team_code", "=", "team6"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $userForTransfers = User::where([
            ["reg_code", "=", "W0LNX"],
            ["reg_code", "=", "Y65Y9"],
            ["reg_code", "=", "H3D3L"],
        ]);

        $userIDLists = $userForTransfers->get()->pluck("id")->toArray();
        DB::table("teams_members")->whereIn("teams_user_id", $userIDLists)->update(["teams_id" => $modelTeams->first()->id]);
    }

    /**
     * [General] Transfer to new <teams_members> (Team 7)
     * @return void
     */
    public function transferTeamMembers7()
    {
        $whereParamsTeams = [
            ["team_code", "=", "team7"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $userForTransfers = User::where([
            ["reg_code", "=", "N0M4Z"],
            ["reg_code", "=", "C96WX"],
            ["reg_code", "=", "M07M1"],
            ["reg_code", "=", "H414V"],
            ["reg_code", "=", "X26AT"],
            ["reg_code", "=", "P30FT"],
        ]);

        $userIDLists = $userForTransfers->get()->pluck("id")->toArray();
        DB::table("teams_members")->whereIn("teams_user_id", $userIDLists)->update(["teams_id" => $modelTeams->first()->id]);
    }

    /**
     * [General] Transfer to new <teams_members> (Team 7)
     * @return void
     */
    public function transferTeamMembers8()
    {
        $whereParamsTeams = [
            ["team_code", "=", "team8"]
        ];

        $modelTeams = Teams::where($whereParamsTeams);

        $userForTransfers = User::where([
            ["reg_code", "=", "V08Z6"],
            ["reg_code", "=", "M08M8"],
            ["reg_code", "=", "V00XA"]
        ]);

        $userIDLists = $userForTransfers->get()->pluck("id")->toArray();
        DB::table("teams_members")->whereIn("teams_user_id", $userIDLists)->update(["teams_id" => $modelTeams->first()->id]);
    }
};
