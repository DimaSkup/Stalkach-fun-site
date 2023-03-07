<?php

namespace Database\Seeders;

use App\Helpers\FileManager;
use App\Helpers\LocalFileManager;
use App\Helpers\Utils;
use App\Models\User;
use App\Service\ImageChecker;
use App\Service\ImageEditor;
use App\Service\ImageUploader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public string $avatarsDirPath;               // a path to fake avatars directory
	public array $avatarsPathsArray;             // an array of paths to fake avatars


    public function __construct()
	{
	}

    // Run the database seeds.
    public function run(): void
    {
        foreach (self::USERS_DATA as $userData) {
            $user = User::factory()->create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt('12345678'),
                'is_admin' => $userData['isAdmin'] ?? false,               // define if this user is an administrator or not
            ]);

			$user->avatar = User::factory()->getRandomAvatarImageFile();   // relate an avatar image to this user
        }
    }
}


