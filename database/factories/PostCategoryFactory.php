<?php

namespace Database\Factories;

use App\Models\PostCategory;
use Database\Seeders\PostCategoriesSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PostCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();

        # prepare some data
        $data = $faker->randomElement(PostCategoriesSeeder::$postCategoryData);

        $name = $data['en'];
        $dev_name = $data['dev_name'];
        $description = $faker->text;
        $isEnabled = ($dev_name !== 'other');

        # pinned posts
        $pinTitle = $faker->text;
        $pinSubTitle = $faker->text;
        $pinDesc = $faker->text;

        return [
            'name' => $name,
            'dev_name' => $dev_name,
            'description' => $description,

            # pinned posts
            'pinned_title' => $pinTitle,
            'pinned_subtitle' => $pinSubTitle,
            'pinned_description' => $pinDesc,

            'is_private' => false,
            'is_enabled' => $isEnabled,
        ];
    }


    // does some changes about data for this category
    public function postCategory(Collection $data): Factory
    {
        return $this->state(function (array $attributes) use ($data) {
            foreach ($data as $key => $value)
            {
                $attributes[$key] = $value;
            }

            return $attributes;
        });
    }
}
