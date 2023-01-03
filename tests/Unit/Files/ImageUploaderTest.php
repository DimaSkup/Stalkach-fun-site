<?php

namespace Tests\Unit\Files;

use App\Helpers\LocalFileManager;
use App\Service\ImageChecker;
use App\Service\ImageEditor;
use App\Service\ImageUploader;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Tests\Unit\TestUtils;   // for using some testing utils

// here we check if the files uploading works correctly
class ImageUploaderTest extends TestCase
{
    private static string $linkToRemoteImage = "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/1280px-Google_2015_logo.svg.png";
    private static string $tempFilesType = "temp_file";

    // can we upload image if we pass an UploadedFile object?
    public function test_upload_method_with_image_object()
    {
        // preparation
        $imageUploader = $this->getTestImageUploader(); // get a configured instance of the ImageUploader
        $file = UploadedFile::fake()->image('fake_image.jpg', 1200, 1200);

        // act
        $uploadedImage = $imageUploader->upload($file, self::$tempFilesType, "jpg");

        // assertions
        $this->assertInstanceOf(File::class, $uploadedImage);
    }

    // can we upload image if we pass a link to this image?
    public function test_upload_method_with_link_to_image(): void
    {
        // preparation
        $imageUploader = $this->getTestImageUploader();  // get a configured instance of the ImageUploader
        $linkToImage = self::$linkToRemoteImage;
        $imageType = self::$tempFilesType;
        $extension = "jpg";

        // act
        $uploadedImage = $imageUploader->upload($linkToImage, $imageType, $extension);

        // assertions
        $this->assertInstanceOf(File::class, $uploadedImage);
    }


    // --------------------------------- UTILS --------------------------------------- //

    // THIS IS NOT A TEST BY ITSELF but we need to clean up the
    // temporary directory from test files after all tests;
    public function test_clean_up_temporary_directory_from_temporal_files(): void
    {
        $cleanResult = TestUtils::cleanTempDir();

        $this->assertTrue($cleanResult); // confirm that the temp directory is empty now
    }



    // --------------------------------- HELPERS ------------------------------------- //

    // sets up and returns an instance of ImageUploader
    private function getTestImageUploader(): ImageUploader
    {
        $fileManager = new LocalFileManager('storage_root');
        $imageEditor = new ImageEditor;
        $imageChecker = new ImageChecker();

        return new ImageUploader($fileManager, $imageEditor, $imageChecker);
    }

}
