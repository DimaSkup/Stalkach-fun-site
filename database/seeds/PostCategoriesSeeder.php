<?php

namespace Database\Seeders;

use App\Helpers\Utils;
use Illuminate\Database\Seeder;
use App\Models\PostCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class PostCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakeBackgroundImagesPaths = Storage::disk('storage_root')
            ->allFiles(config("filesystems.types.".PostCategory::IMAGE_TYPE_BACKGROUND.".fake"));

        foreach(self::$postCategoryData as $postCategoryData)
        {
            $newCategory = PostCategory::factory()
                ->postCategory(new Collection([
                    'name' => $postCategoryData['en'],
                    'dev_name' => $postCategoryData['dev_name'],
                    'pinned_title' => $postCategoryData['pinned_title'] ?? null,
                    'pinned_subtitle' => $postCategoryData['pinned_subtitle'] ?? null,
                    'pinned_description' => $postCategoryData['pinned_description'] ?? null,
                    'is_private' => $postCategoryData['is_private'],
                    'is_enabled' => $postCategoryData['is_enabled'],
                ]))
                ->create();

            $image = Utils::getFileByStoragePath($fakeBackgroundImagesPaths[0], "storage_root");
            $newCategory->backgroundImage = $image;
        }
    }

    public static array $postCategoryData = [
        'community' => [
            'dev_name' => "community",
            'en'   => "Community",
            'ua'   => "Спільнота",
            'is_private' => false,
            'is_enabled' => true,
        ],
        'events' => [
            'dev_name' => "events",
            'en'   => "Events",
            'ua'   => "Події",
            'pinned_title' => 'Announced stalker-themed events from fans and developers',
            'pinned_subtitle' => 'Upcoming events',
            'pinned_description' => 'The most important and interesting events not to be missed',
            'is_private' => false,
            'is_enabled' => true,
        ],
        'from_dev' => [
            'dev_name' => "from_dev",
            'en'   => "From developers",
            'ua'   => "Від розробників",
            'pinned_title' => 'Interesting interviews with developers about S.T.A.L.K.E.R. 2',
            'pinned_subtitle' => 'Developer Interviews',
            'pinned_description' => 'Here are collected various interviews and answers to questions from developers. They talk about the progress of the development of the game and about future innovations in the gameplay and plot.',
            'is_private' => true,
            'is_enabled' => true,
        ],
        'modding' => [
            'dev_name' => "modding",
            'en'   => "Modding",
            'ua'   => "Модифікації",
            'pinned_title' => 'Detailed lessons and tips for developing modifications',
            'pinned_subtitle' => 'Guides for developers',
            'pinned_description' => 'If you have ever thought about developing mods, or if you already have experience in modding, you may want to check out some helpful articles',
            'is_private' => false,
            'is_enabled' => true,
        ],
        'guide' => [
            'dev_name' => "guide",
            'en'   => "Guide",
            'ua'   => "Гайд",
            'is_private' => false,
            'is_enabled' => true,
        ],
        'other' => [
            'dev_name' => "other",
            'en'   => "Other",
            'ua'   => "Інші",
            'is_private' => false,
            'is_enabled' => false,
        ],
    ]; // $postCategoryData
}
