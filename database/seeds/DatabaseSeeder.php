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


	// ----------------------------------------------------------------------- //
	//                       HELPERS FOR DEV STAGE                             //
	// ----------------------------------------------------------------------- //

    private function clearDatabaseAndData(): void
    {
        if (config('filesystems.stage') === 'dev')  // if we are on development stage
        {
        	$this->removeModelsImages();            // removing of all the models images
			$this->cleanUpDatabase();               // cleans up all the data in the database
        }
    }

    // removing of all the models images
    private function removeModelsImages(): void
	{
		$fileManager = new LocalFileManager('public');

		// get storage path to images directory
		$storagePathToModsImages = \App\Models\Mod::getPathToImagesDir();
		$storagePathToPostsImages = \App\Models\Post::getPathToImagesDir();
		$storagePathToPostsCategoriesImages = \App\Models\PostCategory::getPathToImagesDir();
		$storagePathToUsersImages = \App\Models\User::getPathToImagesDir();

		// get full path to images directory
		$fullPathToModsImages = $fileManager->getFullPathByStoragePath($storagePathToModsImages);
		$fullPathToPostsImages = $fileManager->getFullPathByStoragePath($storagePathToPostsImages);
		$fullPathToPostsCategoriesImages = $fileManager->getFullPathByStoragePath($storagePathToPostsCategoriesImages);
		$fullPathToUsersImages = $fileManager->getFullPathByStoragePath($storagePathToUsersImages);

		// clear up all the models images
		FacadesFile::cleanDirectory($fullPathToModsImages);
		FacadesFile::cleanDirectory($fullPathToPostsImages);
		FacadesFile::cleanDirectory($fullPathToPostsCategoriesImages);
		FacadesFile::cleanDirectory($fullPathToUsersImages);
	} /* removeModelsImages() */


	// cleans up all the data in the database
	private function cleanUpDatabase(): void
	{
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
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
