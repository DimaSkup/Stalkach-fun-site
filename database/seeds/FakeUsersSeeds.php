<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakeUsersSeeds extends Seeder
{
    public const USERS_DATA = [
        ['name' => 'admin1', 'email' => 'admin1@gmail.com', 'isAdmin' => true],
        ['name' => 'admin2', 'email' => 'admin2@gmail.com', 'isAdmin' => true],
        ['name' => 'user1', 'email' => 'user1@gmail.com'],
        ['name' => 'user2', 'email' => 'user2@gmail.com'],
        ['name' => 'user3', 'email' => 'user3@gmail.com'],
        ['name' => 'user4', 'email' => 'user4@gmail.com'],
        ['name' => 'user5', 'email' => 'user5@gmail.com'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = \Faker\Factory::create();
        $fakeUsersCount = count(self::USERS_DATA);

        foreach (self::USERS_DATA as $userData) {
            User::factory()->create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt('12345678'),
                'is_admin' => $userData['isAdmin'] ?? false,
            ]);
        }

    }
}


