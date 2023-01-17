<?php


namespace App\Service;


use App\Helpers\Traits\DevUtils;

// this class is responsible for editing images (resizing, etc.)
class ImageEditor
{
    public const DEFAULT_EXTENSION = "webp";


    // ------------------------------------------------------------------------------- //
    //                              PUBLIC FUNCTIONS                                   //
    // ------------------------------------------------------------------------------- //

    // takes some image content and params to make a new image content with such properties
    public function createImageContentWithParams(string $fullPathToImage,
                                                 array $imageParams,
                                                 string $extension = self::DEFAULT_EXTENSION)
	: string  // returned type
    {
		try
		{
			// check params
			DevUtils::checkArguments($fullPathToImage, $imageParams);

			// make an image
			return self::createImageContent($fullPathToImage,
				$imageParams['width'],  // make a new image with such a width
				$imageParams['height'], // and height
				$extension);            // and extension

		}
		catch (\Exception $e)
		{
			dump("EXCEPTION:");
			dump($e->getMessage());
			dump("path to src image: $fullPathToImage");
		}
    }


    // ------------------------------------------------------------------------------- //
    //                              PRIVATE FUNCTIONS                                  //
    // ------------------------------------------------------------------------------- //

    // return us a string which contains an image content
    // 1. an image is a copy of the source image by its $pathToImage path (full system path)
    // 2. $type is a necessary type of image
    // 3. $dstWidth and $dstHeight are sizes of the copy image
    // 4. $extension is the necessary extension
    private static function createImageContent(string $pathToSrcImage,
                                               int $dstWidth,
                                               int $dstHeight = null,
                                               string $extension = self::DEFAULT_EXTENSION): string
    {
        $srcImageResource = self::createImageResource($pathToSrcImage);  // create a resource of the source image
        $copyImageResource = self::cutImage($srcImageResource, $dstWidth, $dstHeight);     // create a copy of the source image

        return self::getImageContentByResource($copyImageResource, $extension);                   // create an image and return its content
    }  // createImageContent()


    // creates a copy of the source image by its $srcImage resource
    // $dstWidth - width of the copy image, $dstHeight - its height
    private static function cutImage(\GdImage $srcImage, int $dstWidth, int $dstHeight): \GdImage
    {
        // we need to define some parameters for proper cutting
        $cuttingParams = self::getCuttingParams($srcImage, $dstWidth, $dstHeight);
        $cutX = $cuttingParams['x'];
        $cutY = $cuttingParams['y'];
        $cutWidth = $cuttingParams['width'];
        $cutHeight = $cuttingParams['height'];


        // create a new empty image with dimensions [$dstWidth x $dstHeight]
        $dstImage = imageCreateTrueColor($dstWidth, $dstHeight);

        // fill in the new image
        $result = imageCopyResampled($dstImage, $srcImage,
                                     0, 0,                    // dst image x and y
                                     $cutX, $cutY,            // cutting x and y positions
                                     $dstWidth, $dstHeight,   // dst width and height
                                     $cutWidth, $cutHeight);  // cutting width and height

        if (!$result)
        {
            throw new \RuntimeException("Can't execute resampling of the source image");
        }

        // if we created a copy we return a resource of a new image for further processing
        return $dstImage;
    }  // cutImage()


    // create an image resource from some image file by $pathToFile
    private static function createImageResource(string $pathToFile): \GdImage|bool
    {
		$ext = pathinfo($pathToFile, PATHINFO_EXTENSION); // get an extension of the file

		switch ($ext) // according to the extension we create an image resource
		{
			// return an image resource or error
			case 'bmp':
				return imageCreateFromBmp($pathToFile);
			case 'webp':
				return imageCreateFromWebp($pathToFile);
			case "jpg":
			case "jpeg":
				return imageCreateFromJpeg($pathToFile);
			case "png":
				return imageCreateFromPng($pathToFile);
			case "gif":
				return imageCreateFromGif($pathToFile);
			default:
				dump("wrong extension: $ext");
				throw new \RuntimeException("there is an error during creation of an image resource");
		}
    }  // createImageResource()

    // creates an image content (a string with image data) by its resource and extension
    private static function getImageContentByResource($imResource, string $extension): string
    {
        ob_start();   // because we don't want to print content we enable buffer
        switch ($extension) // create an image according to its extension
        {
            case 'webp':
                $result = imageWebp($imResource);
                break;
            case 'jpg':
            case 'jpeg':
                $result = imageJpeg($imResource);
                break;
            case 'gif':
                $result = imageGif($imResource);
                break;
            case 'png':
                $result = imagePng($imResource);
                break;
            default:
                $result = false;
        }
        $imageInString = ob_get_clean();  // get content from buffer and put it into a string

        if (!($result && $imageInString))
        {
            dump("result: $result", "ext: $extension");
            throw new \RuntimeException("Can't create a string with the image content");
        }

        return $imageInString;
    }  // createImageContent()

    // computes an upper left point of the cutting rectangle,
    // and width and height of this rectangle;
    // returns an array with these params
    private static function getCuttingParams(\GdImage $srcImageResource,
                                             int $dstWidth,
                                             int $dstHeight): array
    {
        // get dimensions of the source image
        $srcWidth = imagesx($srcImageResource);
        $srcHeight = imagesy($srcImageResource);
        $srcCenterX = $srcWidth / 2;
        $srcCenterY = $srcHeight / 2;

        // get the right proportion of the source image to passed destination image width/height
        $proportionX = $srcWidth / $dstWidth;
        $proportionY = $srcHeight / $dstHeight;
        $mainProportion = min($proportionX, $proportionY);

        // get the area of the source image to cut
        $width = floor($dstWidth * $mainProportion);
        $height = floor($dstHeight * $mainProportion);

        // get the upper left point of the source image to cut
        $posX = floor($srcCenterX - ($width / 2));
        $posY = floor($srcCenterY - ($height / 2));

        // return an array with cutting params
        return [
            'x' => $posX, // the left edge
            'y' => $posY, // the upper edge
            'width' => $width,   // the width of the cutting rectangle
            'height' => $height, // the height of the cutting rectangle
        ];
       /*
         // for debugging (DON'T TOUCH IT)
         dd(__METHOD__,
           "0: $proportionX    $proportionY",
           "1: $srcWidth", "2: $srcHeight",
           "3: $albumImageX", "4: $albumImageY",
           "5: $cutSrcWidth", "6: $cutSrcHeight",
           "7: $srcPosX", "8: $srcPosY");
        */
    }  // getCuttingParams()
}