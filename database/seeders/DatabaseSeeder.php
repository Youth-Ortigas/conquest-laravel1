<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $data = [
            ['name' => 'Jack', 'reg_code' => 'AAAAA'],
            ['name' => 'Enzo', 'reg_code' => 'BBBBB'],
            ['name' => 'Ayee', 'reg_code' => 'CCCCC'],
            ['name' => 'Faith', 'reg_code' => 'DDDDD'],
            ['name' => 'Ivan', 'reg_code' => 'EEEEE'],
            ['name' => 'Dean', 'reg_code' => 'FFFFF'],
            ['name' => 'Kyle', 'reg_code' => 'GGGGG'],
            ['name' => 'Eryca', 'reg_code' => 'HHHHH'],
            ['name' => 'Rommel', 'reg_code' => 'IIIII'],
            ['name' => 'Shaira', 'reg_code' => 'JJJJJ'],
        ];

        foreach ($data as $userData) {
            User::create($userData);
        }

        $this->call([
            PuzzleSeeder::class,
        ]);
    }
}
