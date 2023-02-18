<?php
namespace Database\Factories;

use App\Helpers\FileManager;
use App\Helpers\LocalFileManager;
use App\Helpers\Utils;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
	private static array $fakeAvatarPaths = [];
	private static ?FileManager $fileManager = null;


    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $userName = $faker->name;
        $userEmail = "";
        foreach (explode(' ', $userName) as $namePart)
        {
            $userEmail .= ucfirst($namePart);
        }
        $userEmail .= "@gmail.com";

        return [
            'name' => $userName,
            'email' => $userEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
            'is_admin' => false,
            'provider_id' => null,
            'handle_social' => null,
            'created_at' => date('now'),
            'updated_at' => date('now'),
        ];
    }


	// returns a new User instance with set up relations
    public function getModel(): User
	{
		$newUser = User::factory()->create();
		$newUser->avatar = $this->getRandomAvatarImageFile();

		return $newUser;
	}

	public function getRandomAvatarImageFile():  \Illuminate\Http\File
	{
		if (self::$fakeAvatarPaths === [] && !self::$fileManager)  // if we haven't initialized the static array with paths to the fake avatars
		{
			self::$fileManager = new LocalFileManager('storage_root'); // because we need fake files we use the "storage_root" disk

			$userAvatarConfig = Utils::getFileTypeConfig(User::getAvatarImageTypeName());
			$avatarsDirPath = $userAvatarConfig['fake'];                                   // get a path to fake avatars directory
			self::$fakeAvatarPaths = Storage::disk('storage_root')->allFiles($avatarsDirPath); // get an array of paths to fake avatars
		}

		$randomPathToAvatar = Arr::random(self::$fakeAvatarPaths);
		return self::$fileManager->getFileByStoragePath($randomPathToAvatar); // return a random avatar image
	}
}
