<?php

namespace Database\Seeders;

use App\Helpers\FileManager;
use App\Helpers\LocalFileManager;
use App\Helpers\Traits\DevUtils;
use App\Helpers\Utils;
use App\Models\Mod;

use App\Models\ModReview;
use App\Models\User;
use App\Service\ImageChecker;
use App\Service\ImageEditor;
use App\Service\ImageUploader;
use App\Service\YouTubeVideoService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File as HttpFile;

class FakeModsSeeds extends Seeder
{
    private string $mainImagesDirPath;      // a path to mod fake main images directory
	private string $screenshotsDirPath;     // a path to mod fake screenshots directory
    private array $screenshotsPathArray;    // a path to mod fake screenshots images
    private array $galleryVideoPathsArray;  // a path to mod gallery videos directory

    // fake video links
    private static string $defaultReviewVideoLink = "https://www.youtube.com/watch?v=OuHdnsF118U";

    // some objects
    private FileManager $fileManager;     // for work with files and filesystem
    private ImageUploader $imageUploader; // for uploading of the images

    public function __construct()
    {
        // initialize the image uploader object to upload fake images
        $this->fileManager = new LocalFileManager();
        $this->imageUploader = new ImageUploader($this->fileManager, new ImageEditor(), new ImageChecker());

        // get all the paths to the fake images
        $this->mainImagesDirPath = Utils::getFileTypeConfig(Mod::IMAGE_TYPE_MAIN)['fake'];   // storage path to the mod main images directory
		$this->screenshotsDirPath = Utils::getFileTypeConfig(Mod::IMAGE_TYPE_SCREENSHOTS)['fake'];
        $this->screenshotsPathArray = Storage::disk('storage_root')->allFiles($this->screenshotsDirPath);

        // get all the paths for the fake gallery videos
        $galleryVideosDirStoragePath = Utils::getFileTypeConfig(Mod::VIDEO_TYPE_GALLERY)['fake'];
        $this->galleryVideoPathsArray = Storage::disk("storage_root")->allFiles($galleryVideosDirStoragePath);  // get a list of paths to gallery videos
    } // __construct()


    // run the database seeds.
    public function run(): void
    {
        foreach (self::$modsFakeData as $index => $modData) {
            $modData = new Collection($modData); // we will use data array as a Collection

            // prepare some data
            $authorOfMod = User::inRandomOrder()->limit(1)->first();
            $trailerLink = $modData->get('trailer_video_link');
            $reviewLink = self::$defaultReviewVideoLink;
            $mainImageFilename = $modData->get('main_image_name');
            $screenshotsCount = 10;

            // create an new instance of the Mod model
            $newMod = $this->createNewModObject($modData);

            // make some EXTERNAL relations
            $newMod->author_id = $authorOfMod->id;
            $newMod->tags = $modData['tags'];                                      // relate tags to this modification
            $this->relateFakeImagesTo($newMod, $mainImageFilename, $screenshotsCount);   // relate images to this modification
            $this->relateFakeModReviewsTo($newMod);                               // relate mod reviews to this modification
            //$this->relateFakeVideosToModel($newMod, $trailerLink, $reviewLink);   // make relations between videos and this modification

            $newMod->update(); // after all we need to update this new mod

            // ATTENTION: DROP IT LATER
            //if ($index == 3)
            //   break;
        }
    } // run()

    public static function getFakeData(): array
    {
        return self::$modsFakeData;
    }

    // ------------------------------------------------------------------------------- //
    //                                                                                 //
    //                              PUBLIC FUNCTIONS                                   //
    //                                                                                 //
    // ------------------------------------------------------------------------------- //


    // get a new Mod object
    public function createNewModObject(Collection $modData): Mod
    {
        return Mod::factory()
            ->mod(new Collection([
                'name'            => $modData->get('name'),
                'game'            => $modData->get('game'),
                'download_links'  => $modData->get('download_links'),
            ]))
            ->create();
    }

    // make images relations to this $model
    public function relateFakeImagesTo($model,
                                       string $mainImageName,
                                       int $screenshotsCount = 20): void
    {
        // because we need fake files we use the "storage_root" disk
        $this->fileManager->setDisk('storage_root');

        // ---------- prepare A MAIN IMAGE --------- //
        $storagePathToMainImage = $this->mainImagesDirPath . $mainImageName;
        $mainImageFile = $this->fileManager->getFileByStoragePath($storagePathToMainImage);

        // --------- prepare SCREENSHOTS ----------- //
        $screenshotsFiles = [];    // here we will place screenshots files
        for ($i = 0; $i < $screenshotsCount; $i++)
        {
            $screenshotsFiles[] = $this->getRandImageFile(Mod::IMAGE_TYPE_SCREENSHOTS); // get screenshots files
        }

        $model->mainImage = $mainImageFile; // make a MAIN IMAGE relation
        $model->screenshots = $screenshotsFiles; // make a SCREENSHOTS relation
        $model->boxartImage = $this->getRandImageFile(Mod::IMAGE_TYPE_BOXART); // make a BOXART relation
        $model->backgroundImage = $this->getRandImageFile(Mod::IMAGE_TYPE_BACKGROUND); // make a BACKGROUND relation

        // set the file manager to the default disk state
        $this->fileManager->setDisk('public');
    }  //relateFakeImagesTo()


    // make relations between this $modification and mod reviews (ModReview)
    private function relateFakeModReviewsTo(Mod $mod, int $modReviewsNum = 3): void
    {
        // create modification reviews
        for ($i = 0; $i < $modReviewsNum; $i++)
        {
            ModReview::factory()
                     ->hasAuthor()           // set a random author
                     ->hasMod($mod->id)      // relate this modification to the modification review
                     ->hasModRating()        // set a random modification rating
                     ->getModel();
        }

        // after creation of all the mod reviews we need to calculate the mod average rate
		$this->updateAverageGradeOfMod($mod);

    }  // relateFakeModReviewsTo()

    // this function makes relations between videos and this model
    public function relateFakeVideosToModel($model, $trailerLink, $reviewLink)
    {
        $this->setTrailerVideoForModel($model, $trailerLink);
        $this->setReviewVideoForModel($model, $reviewLink);
        $this->setRandomGalleryVideoForModel($model);
    }


    // ------------------------------------------------------------------------------- //
    //                                                                                 //
    //                          PRIVATE FUNCTIONS (HELPERS)                            //
    //                                                                                 //
    // ------------------------------------------------------------------------------- //

    // returns a File object of some random image;
	// if we have some INTERNAL image type as parameter we convert a random image
	// to necessary params
    private function getRandImageFile(string $imageType = ""): HttpFile
    {
        $path = Arr::random($this->screenshotsPathArray);
        $imageFile = $this->fileManager->getFileByStoragePath($path);

        if ($imageType) // if we want to convert image to some particular type
		{
			$imageFile = $this->imageUploader->upload($imageFile, $imageType);
		}

		return $imageFile;
    }

    // sets the TRAILER VIDEO for this model
    private function setTrailerVideoForModel($model, $trailerLink): void
    {
        // get a preview image of the YouTubeVideoService::YOUTUBE_PREVIEW_IMAGE type and an id of the video
        $trailerVideoData = $this->getVideoPreviewImageAndId($trailerLink, YouTubeVideoService::YOUTUBE_PREVIEW_IMAGE);

        // make relations
        $model->trailerVideoId = $trailerVideoData->get('id');
        $model->trailerVideoPreviewImage = $trailerVideoData->get('image');
    }

    // sets the REVIEW VIDEO for this model
    private function setReviewVideoForModel($model, $reviewLink): void
    {
        // get a preview image of the YouTubeVideoService::YOUTUBE_PREVIEW_IMAGE type and an id of the video
        $reviewVideoData = $this->getVideoPreviewImageAndId($reviewLink, YouTubeVideoService::YOUTUBE_PREVIEW_IMAGE);

        // make relations
        $model->reviewVideoId = $reviewVideoData->get('id');
        $model->reviewVideoPreviewImage = $reviewVideoData->get('image');
    }

    // sets a random GALLERY VIDEO for this model
    private function setRandomGalleryVideoForModel($model): void
    {
        // get random gallery video path
        $galleryVideoStoragePath = Arr::random($this->galleryVideoPathsArray);

        // get video File object
        $this->fileManager->setDisk('storage_root');
        $galleryVideoFile = $this->fileManager->getFileByStoragePath($galleryVideoStoragePath);
        $this->fileManager->setDisk('public');

        // make a relation
        $model->galleryVideo = $galleryVideoFile;
    }

    // get the video's preview image of particular $videoType and id by a video link
    private function getVideoPreviewImageAndId(string $videoLink, string $videoImageType): Collection
    {
        // first of all we need to check the input parameters
        DevUtils::checkArguments($videoLink, $videoImageType);

        // upload the video preview image file
        $video = new YouTubeVideoService($videoLink);
        $previewImageFile = $this->imageUploader->upload($video->getHighThumbnail()->url, $videoImageType, "jpg");

        // return the video's thumbnail image and its id
        return new Collection([
            'image'   => $previewImageFile,
            'id'      => $video->getId(),
        ]);
    } // getVideoPreviewImageAndId()

	private function updateAverageGradeOfMod(Mod $mod)
	{
		$countOfModReviews = count($mod->modReviews);
		$sumRateByAllReviews = 0;

		foreach($mod->modReviews as $modReview)
		{
			$sumRateByAllReviews += $modReview->modRating->averageRating;
		}

		$averageRateByAllReviews = $sumRateByAllReviews / $countOfModReviews;
		$roundedRate = round($averageRateByAllReviews, 1);

		$mod->setAttribute('average_grade', $roundedRate);
		$mod->update();
	}



    // ----------------------------------------------------------------------- //
    //                            FAKE DATA                                    //
    // ----------------------------------------------------------------------- //

    private static $modsFakeData = [
        [
            'name'          => "SFZ Project: Lost Story",
            "trailer_video_link"    => "https://www.youtube.com/watch?v=VmoQTgX78do",
            "download_links" => [
                "google_drive_disk" => "https://drive.google.com/file/d/1Jk6my7qHPSEKE-trWdQFg8EJYdOMJ3R9/view",
                "yandex_disk"  => "https://disk.yandex.ru/",
                "cloud_mail_disk" => "https://cloud.mail.ru/",
            ],
            "game"          => Mod::GAME['soc'],
            "tags"          => "mods Shadow_of_Chernobyl",
            "main_image_name" => "1.jpg",
        ],
        [
            'name'          => "Secrets of Chernobyl",
            "trailer_video_link"    => "https://www.youtube.com/watch?v=xA1MPuYYNfU&ab_channel=TheWolfstalker2",
            "download_links" => [
                "google_drive_disk" => "https://drive.google.com/file/d/1aBJqNbOxmNb89M8_de_xfni_OPk0dnDM/view?usp=sharing",
                "cloud_mail_disk" => "https://cloud.mail.ru/",
            ],
            "game"          => Mod::GAME['soc'],
            "tags"          => "mods Shadow_of_Chernobyl",
            "main_image_name" => "2.jpg",
        ],
        [
            'name'          => "Зимняя Сказка",
            "trailer_video_link"    => "https://www.youtube.com/watch?v=H7NSNuFxAb4&ab_channel=darkMarshall",
            "download_links" => [
                "cloud_mail_disk" => "https://cloud.mail.ru/",
                "yandex_disk" => "https://disk.yandex.ru/d/qUv4BxDnk1tNGQ",
            ],
            "game"          => Mod::GAME['cop'],
            "tags"          => "mods Call_of_Pripyat",
            "main_image_name" => "3.jpg",
        ],
        [
            'name'          => "Плохая компания 2: Масон",
            "trailer_video_link"    => "https://www.youtube.com/watch?v=WDLb_AXJ_HA&ab_channel=TheWolfstalker2",
            "download_links" => [
                "google_drive_disk" => "https://drive.google.com/file/d/1tcEitm4XXVB30p6eIc27zfjXDLtCpDsI/view?usp=sharing",
                "yandex_disk"  => "https://disk.yandex.ru/",
                "cloud_mail_disk" => "https://cloud.mail.ru/",
            ],
            "game"          => Mod::GAME['cop'],
            "tags"          => "mods Call_of_Pripyat",
            "main_image_name" => "4.jpg",
        ],
        [
            'name'          => "The Journey",
            "trailer_video_link"    => "https://www.youtube.com/watch?v=uRNxYf-t8wE&ab_channel=TheWolfstalker2",
            "download_links" => [
                "google_drive_disk" => "https://drive.google.com/file/d/1imBdEdUr_wEFlS1po28q-gmu7Eq4GbBm/view?usp=sharing%20",
                "yandex_disk"  => "https://disk.yandex.ru/",
            ],
            "game"          => Mod::GAME['cop'],
            "tags"          => "mods Call_of_Pripyat",
            "main_image_name" => "5.jpg",
        ],
        [
            'name'          => "Боевая подготовка 3",
            "trailer_video_link"    => "https://www.youtube.com/watch?v=o2_82vpYNkQ",
            "download_links" => [
                "yandex_disk"  => "https://disk.yandex.ru/",
                "cloud_mail"   => "https://cloud.mail.ru/public/zDZY/9msHiNCSX",
            ],
            "game"          => Mod::GAME['cop'],
            "tags"          => "mods Call_of_Pripyat",
            "main_image_name" => "6.jpg",
        ],
        [
            'name'          =>  "D.E.V.I.L.R.Y.",
            "trailer_video_link"    => "https://www.youtube.com/watch?v=glQF58N_EN0",
            "download_links" => [
                "google_drive_disk" => "https://drive.google.com/file/d/1yYl3T1Yt4aQGP7BCHd_hT7D4XIGSoQOL/edit",
            ],
            "game"          => Mod::GAME['cop'],
            "tags"          => "mods Call_of_Pripyat",
            "main_image_name" => "8.webp",
        ],
        [
            'name'          => "Возвращение в Зону",
            "trailer_video_link"    => "https://www.youtube.com/watch?v=xnMP9qiiFIY&ab_channel=HugTV",
            "download_links" => [
                "google_drive_disk" => "https://drive.google.com/file/d/12Uv2NdOrWzDelqQf9IkKcAjkVj6oVqpq/view",
            ],
            "game"          => Mod::GAME['cop'],
            "tags"          => "mods Call_of_Pripyat",
            "main_image_name" => "9.jpg",
        ],
        [
            'name'          => "Осколки Прошлого",
            "trailer_video_link"    => "https://www.youtube.com/watch?v=cCVOCeb97tU",
            "download_links" => [
                "google_drive_disk"    => "https://drive.google.com/file/d/1Pgaklq4RIkhH8bG2L2jSiDwkYn-vgCE2/view?usp=sharing",
                "yandex_disk"     => "https://disk.yandex.ru/",
                "cloud_mail_disk" => "https://cloud.mail.ru/",
            ],
            "game"          => Mod::GAME['cop'],
            "tags"          => "mods Call_of_Pripyat",
            "main_image_name" => "10.jpg",
        ],
        [
            'name'          => "Hibernation Evil - Эпизод III",
            "trailer_video_link"    => "https://www.youtube.com/watch?v=ISzxuQjOEWI&feature=youtu.be",
            "download_links" => [
                "google_drive_disk"    => "https://drive.google.com/file/d/1S1oLRp9JbS3xbQIIb0sjUozUoFR4osKa/view",
                "cloud_mail_disk" => "https://cloud.mail.ru/",
            ],
            "game"          => Mod::GAME['soc'],
            "tags"          => "mods Shadow_of_Chernobyl",
            "main_image_name" => "11.jpg",
        ],
        [
            'name'          => "Ермак: Последний рейд. Redux",
            "trailer_video_link"    => "https://www.youtube.com/watch?v=wATwrYKn7PI&ab_channel=TheWolfstalker2",
            "download_links" => [
                "google_drive_disk" => "https://drive.google.com/file/d/180WWpheT_Q1vkoKpFv6MRIikWDaAfheS/view?usp=sharing",
                "yandex_disk"  => "https://disk.yandex.ru/",
            ],
            "game"          => Mod::GAME['cs'],
            "tags"          => "mods Clear_Sky",
            "main_image_name" => "7.jpg",
        ],
    ];
}