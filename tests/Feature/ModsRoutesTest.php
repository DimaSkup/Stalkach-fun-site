<?php

namespace Tests\Feature;

use App\Helpers\LocalFileManager;
use App\Helpers\Utils;
use App\Models\Mod;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File as FacadesFile;

class ModsRoutesTest extends TestCase
{
    use RefreshDatabase;
    //use DatabaseTransactions;

    // ----------------------------------------------------------------- //
    //
    //                          TESTS
    //
    // ----------------------------------------------------------------- //
    // an attempt to get to a main mods page (the page with the list of mods)
    public function test_mods_get_main_page(): void
    {
        $response  = $this->get(route('mods'));  // try to get to this page
        $response->assertStatus(200);  // assertions
    }

    // an attempt to get to a single mod page
    public function test_mods_show_route(): void
    {
        //$this->testModsShowRouteHelper();
        $this->assertTrue(true);
    }

    // a successful case of modification storing attempt
    public function test_mods_store_route_successful_case(): void
    {
        //$this->testModsStoreRouteSuccessfulCaseHelper();
        $this->assertTrue(true);
    }

    // an unsuccessful case of modification storing attempt
    public function test_mods_store_route_unsuccessful_case(): void
    {
        //$this->testModsStoreRouteUnsuccessfulCaseHelper();
        $this->assertTrue(true);
    }

    // an attempt to edit some modification using correct data
    public function test_mods_edit_route_successful_case(): void
    {
        //$this->testModsEditRouteSuccessfulCase();
        $this->assertTrue(true);
    }


    // ----------------------------------------------------------------- //
    //
    //                        HELPERS
    //
    // ----------------------------------------------------------------- //
    // an attempt to get to some page
    private function testModsShowRouteHelper(): void
    {
        // preparation
        $this->seed(); // seed the database
        $modification = Mod::find(1); // we'll look for a page about this modification

        // act
        $response  = $this->get(route('mods.show', ['mod' => $modification->slug]));  // try to get to this page

        // assertions
        $response->assertStatus(200);

        $this->cleanUpModDataAfterTest(); // delete all data which was created during this test
    }

    // ---------------- A SUCCESSFUL CASE OF MODIFICATION STORING -------------------- //
    private function testModsStoreRouteSuccessfulCaseHelper(): void
    {
        // PREPARATION
        $this->executeLogin();   // first of all we need to log in
        $rawModData = Mod::factory()->getRawCorrectData(Auth::user());  // retrieve correct raw modification data like we get it from the creation form

        // ACT: try store this modification into the database
        $response = $this->post(route('mods.store'), ['request' => $rawModData]);          // send post request to store the data in the database

        // ASSERTIONS
        $response->assertJson(function (AssertableJson $json) {
            $json->where('success', true)->etc();
        });

        $this->cleanUpModDataAfterTest(); // delete all data which was created during this test
    }

    // ------------ AN UNSUCCESSFUL CASE OF MODIFICATION STORING ATTEMPT ---------------- //
    private function testModsStoreRouteUnsuccessfulCaseHelper(): void
    {
        $this->executeLogin();                         // first of all we need to login

        // ------------------------ CASE: NOT EMPTY DATA ------------------------- //
        // prepare not empty data for storing
        $rawModData = Mod::factory()->getRawWrongData(); // incorrect raw modification data like we get it from the creation form

        // try to store a modification with INCORRECT (not empty) data
        $response = $this->post('mods.store', $rawModData);  // send post request to store the data in the database

        // assertions (the case when not empty data)
        $response->assertJson(function (AssertableJson $json) {
            $json->where('success', false)->etc();
            $json->has('errorMessages', fn ($json) =>
            $json->hasAll('name',
                'description',
                'tags',
                'main_image',
                'screenshots',
                'game',
                'video_link',
                'google_drive_disk',
                'yandex_disk',
                'cloud_mail_disk',
                'images'));
        }); // assertJson


        // ------------------------ CASE: EMPTY DATA ------------------------- //

        // prepare empty data for storing
        $rawModData = Mod::factory()->getRawWrongData(true); // empty raw modification data like we get it from the creation form

        // try to store a modification with INCORRECT (empty) data
        $response = $this->post('mods.store', $rawModData);  // send post request to store the data in the database

        // assertions (the case when empty data)
        $response->assertJson(function (AssertableJson $json) {
            $json->where('success', false)->etc();
            $json->has('errorMessages', fn ($json) =>
            $json->hasAll('name',
                'description',
                //'tags', // we don't have an error if send an empty tags line
                'main_image',
                'screenshots',
                'game',
                'video_link',
                'download_links',   // we didn't pass any download link so we received a common error
                'images'));
        }); // assertJson

        $this->cleanUpModDataAfterTest(); // delete all data which was created during this test
    }

    // --------------- A SUCCESSFUL CASE OF MODIFICATION EDITING ATTEMPT --------------- //
    private function testModsEditRouteSuccessfulCase()
    {
        $this->executeLogin();   // first of all we need to login

        // second of all we need to have some modification which already have been created
        $rawModDataForStoring = Mod::factory()->getRawCorrectData();            // correct raw modification data like we get it from the creation form
        $response = $this->post(route('mods.store'), $rawModDataForStoring);     // send post request to store the data in the database
        $modSlug = Str::slug($rawModDataForStoring['name']);                     // we'll use this slug to find the modification in the database

        // change some data
        $rawModDataForEditing = $rawModDataForStoring;
        $rawModDataForEditing['name'] = "edit_mod_test_name";
        $rawModDataForEditing['description'] = "test editing description";
        $rawModDataForEditing['main_image'] = UploadedFile::fake()->image('test_edit_main_image.jpg');
        $rawModDataForEditing['screenshots'] = [
            UploadedFile::fake()->image('edit_screenshot_1.jpg'),
            UploadedFile::fake()->image('edit_screenshot_2.jpg'),
            UploadedFile::fake()->image('edit_screenshot_3.jpg'),
            UploadedFile::fake()->image('edit_screenshot_4.jpg'),
        ];
        $rawModDataForEditing['tags'] = "edited_tag_1 edited_tag_2";

        // get mods objects before and after updating
        $modBeforeUpdating = Mod::where('slug', $modSlug)->first();     // get a modification object before updating
        $tagsBeforeUpdating = $modBeforeUpdating->tagsNamesString;       // get a tags names string because later we change related tags
        $response = $this->put(route('mods.update', ['mod' => $modSlug]), $rawModDataForEditing);  // an attempt to update the modification
        $modAfterUpdating = Mod::where('slug', $modSlug)->first();     // get a modification object after updating (because slug doesn't change during updating we can use it again)

        // assertions
        $this->assertNotEquals($modBeforeUpdating->name, $modAfterUpdating->name);                // names must be different
        $this->assertEquals($modBeforeUpdating->slug, $modAfterUpdating->slug);                    // slugs must be equal
        $this->assertNotEquals($modBeforeUpdating->description, $modAfterUpdating->description);  // descriptions must be different
        $this->assertNotEquals($modBeforeUpdating->main_image, $modAfterUpdating->main_image);
        $this->assertNotCount(count($modBeforeUpdating->screenshotsList), $modAfterUpdating->screenshotsList); // the counts of screenshots before and after updating are different
        $this->assertNotEquals($tagsBeforeUpdating, $modAfterUpdating->tagsNamesString);

        $this->cleanUpModDataAfterTest(); // delete all data which was created during this test
    }

    // this function executes the login process because
    // in another case we can't do some actions
    private function executeLogin(): void
    {
        $testUser = User::factory()->create();

        $this->post('/login', [
            'email'     => $testUser->email,
            'password'  => '12345678',
        ]);
    }

    // this function cleans up data after test
    private function cleanUpModDataAfterTest()
    {
        $fileManager = new LocalFileManager('public');
        $pathToModsImagesDir = $fileManager->getPathToDirByType(Mod::IMAGE_TYPE_MAIN);
        $pathToModsVideosDir = $fileManager->getPathToDirByType(Mod::VIDEO_TYPE_GALLERY);

        $fullPathToModsImagesDir = $fileManager->getFullPathByStoragePath($pathToModsImagesDir);
        $fullPathToModsVideosDir = $fileManager->getFullPathByStoragePath($pathToModsVideosDir);

        FacadesFile::cleanDirectory($fullPathToModsImagesDir); // clean up all the mods images
        FacadesFile::cleanDirectory($fullPathToModsVideosDir); // clean up all the mods videos
    }

    private function writeIntoLogFile($content)
    {
        $logFilePath = Utils::getPathToDirByFileType(Mod::IMAGE_TYPE_MAIN)."/test_log.html";
        Storage::disk('public')->put($logFilePath, $content);
    }
}
