<?php

namespace Database\Seeders;

use App\Helpers\LocalFileManager;
use App\Helpers\Utils;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->clearDatabaseAndData();

        $this->call(FakeUsersSeeds::class);
        //$this->call(PostCategoriesSeeder::class);
        //$this->call(FakePostsSeeds::class);
        $this->call(FakeModsSeeds::class);

    }

    private function clearDatabaseAndData(): void
    {
        if (config('filesystems.stage') === 'dev')  // if we are on development stage
        {
            // REMOVING OF MODELS IMAGES
            $fileManager = new LocalFileManager('public');

            $storagePathToModsImages = \App\Models\Mod::getPathToImagesDir();
            $storagePathToPostsImages = \App\Models\Post::getPathToImagesDir();
            $storagePathToPostsCategoriesImages = \App\Models\PostCategory::getPathToImagesDir();

            $fullPathToModsImages = $fileManager->getFullPathByStoragePath($storagePathToModsImages);
            $fullPathToPostsImages = $fileManager->getFullPathByStoragePath($storagePathToPostsImages);
            $fullPathToPostsCategoriesImages = $fileManager->getFullPathByStoragePath($storagePathToPostsCategoriesImages);

            FacadesFile::cleanDirectory($fullPathToModsImages);  // drop all the mods images
            FacadesFile::cleanDirectory($fullPathToPostsImages);  // drop all the posts images
            FacadesFile::cleanDirectory($fullPathToPostsCategoriesImages); // drop all the posts categories images

            // CLEANING UP THE DATABASE
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table("files")->truncate();
            DB::table("file_models")->truncate();
            DB::table('posts')->truncate();
            DB::table('tags')->truncate();
            DB::table('taggables')->truncate();
            DB::table("tags_tags")->truncate();
            DB::table('mods')->truncate();
            DB::table('mod_reviews')->truncate();
            DB::table('mod_ratings')->truncate();
            DB::table('post_categories')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
