<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $teams = [];

        for ($i = 1; $i <= 10; $i++) {
            $teams[] = [
                'team_name' => "Team $i",
                'team_banner_file_path' => '',
                'team_description' => "Description for Team $i",
                'team_leader_user_id' => 1,
                'team_points' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('teams')->insert($teams);
    }
}
