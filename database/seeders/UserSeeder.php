<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // (new DatabaseSeeder())->seedTable('users');
        $users = [];

        for ($i = 1; $i <= 5; $i++) {
            $avatar= "a$i.jpg";

            $name = 'user' . sprintf("%03d", $i);
            $users[] = [
                'id' => $i,
                'name' => $name,
                'email' => "$name@example.com",
                'password' => bcrypt("$name@example.com"),
                'current_team_id' => $i,
                'profile_photo_path' => "profile-photos/$avatar",
                'created_at' => now()->subMonths(rand(0,3))->subDays(rand(0,30)),
                'updated_at' => now()->subMonths(rand(0,3))->subDays(rand(0,30)),
            ];
        }

        $teams = [];

        foreach ($users as $user){
            $teams[] = [
                'id' => $user['current_team_id'],
                'user_id' => $user['id'],
                'name' => $user['name'] . '\'s Team',
                'personal_team' => 1,
                'created_at' => $user['created_at'],
                'updated_at' => $user['updated_at'],
            ];
        }

        DB::table('users')->upsert($users, ['id']);
        DB::table('teams')->upsert($teams, ['id']);
    }
}
