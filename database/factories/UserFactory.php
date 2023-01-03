<?php
namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

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
}
