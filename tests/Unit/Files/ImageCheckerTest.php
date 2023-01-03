<?php

namespace Tests\Unit\Files;

use App\Service\ImageChecker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

// here we execute testing of the ImageChecker class to make an assurance that
// images params are checking correctly
class ImageCheckerTest extends TestCase
{
    private static string $correctLinkToRemoteImage = "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/1280px-Google_2015_logo.svg.png";
    private static string $wrongLinkToRemoteImage = "";


    // --- CASE 1: the image resource is correct --- //
    public function test_check_method_with_correct_data(): void
    {
        // preparation
        $imageChecker = new ImageChecker();
        $testImage = UploadedFile::fake()->image('image', 1000, 1000);

        // acts
        $checkResultPath = $imageChecker->check($testImage->getRealPath()); // act (using of the path)
        $checkResultLink = $imageChecker->check(self::$correctLinkToRemoteImage);   // act (using of the link)

        // assertions
        $this->assertTrue($checkResultPath);
        $this->assertTrue($checkResultLink);
    }

    // --- CASE 2.1: the image file resource is wrong --- //
    public function test_check_method_with_wrong_image_object(): void
    {
         // preparation
        $imageChecker = new ImageChecker();
        $testImage = UploadedFile::fake()->image('testImage.jpg', 10, 10);

        // assertions/acts
        $this->expectException(\Exception::class);  // assertions: because we check wrong data we will get an exception about it
        $imageChecker->check($testImage->getRealPath()); // act (using of the path)
    }

    // --- CASE 2.2: the image file resource is wrong --- //
    public function test_check_method_with_wrong_link_to_image(): void
    {
        // preparation
        $imageChecker = new ImageChecker();

        // assertions/acts
        $this->expectException(\Exception::class);  // assertions: because we check wrong data we will get an exception about it
        $imageChecker->check(self::$wrongLinkToRemoteImage);   // act (using of the link)
    }
}
