<?php


namespace App\Service;

use App\Helpers\LocalFileManager;
use App\Helpers\Traits\DevUtils;

// this class is responsible for checking the input image resource;
class ImageChecker
{
    // takes ONLY A PATH TO LOCAL IMAGE FILE (not a link);
    // if the image has a proper width/height, size in bytes, etc. -- everything is ok
    // in another case it throws an exception about it
    public function check(string $imagePath): bool
    {
        $imageParams = $this->getImageParams($imagePath);
        $this->checkImageParams($imageParams);

        return true;
    }

    // Get data about the image. This function takes a system path or link to the image as input parameter
    public function getImageParams(string $imagePath): array
    {
        DevUtils::checkArguments($imagePath);  // check the arguments
        $fileManager = new LocalFileManager();  // we use the file manager to get an image size value

        // get image params (width,height,mime-type, etc.)
        $params = getimagesize($imagePath);
        if (!$params)
        {
            throw new \RuntimeException("can't get the image params by such a resource: $imagePath");
        }

        $imageBytes = $fileManager->getFileSizeInBytes($imagePath); // get the image size in bytes
        [$width, $height] = $params;

        // return an array of the necessary image params
        return [
            'width' => $width,
            'height' => $height,
            'centerX' => $width / 2,
            'centerY' => $height / 2,
            'narrower' => min($width, $height), // a narrower side value
            'mime' => $params['mime'],
            'bytes' => $imageBytes, // the image size in bytes
        ];
    }

    // checks image params are acceptable
    // if not then this function throws a responsible exceptions about it
    public function checkImageParams(array $curImageParams): void
    {
        // get acceptable params for images
        $acceptableParams = DevUtils::getConfig('content.images.params');
        $minParams = $acceptableParams['min'];
        $maxParams = $acceptableParams['max'];

        // ---------------------- if the file isn't an image ------------------------ //
        if (!in_array($curImageParams['mime'], $acceptableParams['mime']))
        {
            throw new \RuntimeException("This file isn't an image; file's mime type is: {$curImageParams['mime']}");
        }

        // ------------ if the image size in bytes is bigger than maximal acceptable ------------ //
        if ($curImageParams['bytes'] > $maxParams['size'])
        {
            $maxSizeKBytes = $maxParams['size'] / 1024;       // mix image size in KBytes
            $imageSizeKBytes = $curImageParams['bytes'] / 1024;  // size of the current image in KBytes

            throw new \RuntimeException("Maximum acceptable image size is {$maxSizeKBytes} KBytes but your image is {$imageSizeKBytes} KBytes");
        }

        // ------------ if the image width/height is smaller than minimal acceptable ------------ //
        $isTooSmall = ($curImageParams['width'] < $minParams['width']) ||
                      ($curImageParams['height'] < $minParams['height']);
        if ($isTooSmall)
        {
            throw new \RuntimeException("This image size: {$curImageParams['width']}x{$curImageParams['height']}, \nbut min acceptable size: {$minParams['width']}x{$minParams['height']}");
        }
    } // checkImageHelper()
}