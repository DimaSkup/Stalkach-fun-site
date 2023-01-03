<?php

namespace Tests\Unit\Files;

use App\Helpers\LocalFileManager;
use App\Service\ImageEditor;
use Tests\TestCase;
use Tests\Unit\TestUtils;

// here we execute testing of the implementation of the ImageEditor functional;
// we do it to make an assurance that modification of images executes correctly;
class ImageEditorTest extends TestCase
{
    // can we create new image content with particular params which is based on some another image?
    public function test_create_image_content_with_params(): void
    {
        // preparation
        $imageEditor = new ImageEditor();
        $tempImage = TestUtils::createNewTestFile("testImage", "webp");
        $fileManager = new LocalFileManager('storage_root');
        $newImageParams = [
            'width' => 1500,
            'height' => 1200,
        ];

        // act
        $newImageContent = $imageEditor->createImageContentWithParams($tempImage->getRealPath(), $newImageParams, "jpg");

        // assertions
        $this->assertIsString($newImageContent);
        $this->assertNotEmpty($newImageContent);
    }
}
