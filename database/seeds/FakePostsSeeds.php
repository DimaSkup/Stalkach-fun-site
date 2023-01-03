<?php

namespace Database\Seeders;


use App\Models\PostCategory;
use App\Models\Post;
use App\Models\User;

use App\Service\YouTubeVideoService;
use App\Helpers\Utils;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;


class FakePostsSeeds extends Seeder
{
    private \Faker\Generator $faker;
    private int $numberOfFakeImages;
    private array $fakeImagesPathArray;
    private Collection $categories;
    private int $creationIndex = 0;
    private static array $pinCountToCategory = [];
    private int $isPinnedCount;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();

        // get all the paths to the fake images
        $this->fakeImagesPathArray = Storage::disk('storage_root')
             ->allFiles(config("filesystems.types.".Post::IMAGE_TYPE_MAIN.".fake"));
        $this->numberOfFakeImages = count($this->fakeImagesPathArray);


        $this->categories = PostCategory::getList();
        foreach ($this->categories as $category)
        {
            self::$pinCountToCategory[$category->dev_name] = 0;
        }
        $this->isPinnedCount = 3;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->runHelper();
    }

    // -------------------------------------------------------------------------- //
    //
    //                           PRIVATE SEEDERS
    //
    // -------------------------------------------------------------------------- //

    private function runHelper()
    {
        $casualState = true;
        $videoState = true;
        $galleryState = true;

        for ($i = 0; $i < 50; $i++)
        {
            if ($casualState)
                $casualState = $this->createCasualPosts();

            if ($videoState)
                $videoState = $this->createVideoPosts();

            if ($galleryState)
                $galleryState = $this->createGalleryPosts(5, 15);

            if (!($casualState || $videoState || $galleryState))
                break;

            $this->creationIndex++;
        }
    }

    //  CREATION OF CASUAL POSTS
    private function createCasualPosts(): bool
    {
        if ($this->creationIndex < count(self::$fakePostsData))
        {
            $postData = new Collection(self::$fakePostsData[$this->creationIndex]);
            {
                $newPost = $this->createNewCasualPostObject($postData);
                $newPost->tags = $postData->get('tags'); // relate tags to this new post
                $this->relateFakeImagesTo($newPost,
                                          Post::TYPE_CASUAL,
                                          $postData->get('image_link'));  // relate images to this new post
            }
            return true;   // we can create one more post of this type
        }

        return false; // we can't create one more post of this type
    }

    // CREATION OF THE VIDEO POSTS
    private function createVideoPosts(): bool
    {
        if ($this->creationIndex < count(self::$fakeVideoPostsData))
        {
            $videoFakeData = self::$fakeVideoPostsData[$this->creationIndex];

            // get data about video by its link
            $videoService = new YouTubeVideoService($videoFakeData['link']);
            $newVideoPost = $this->createNewVideoPostObject($videoService);

            $newVideoPost->videoUrl = $videoService->getLinkToVideo(); // we need to set the video separately because there will be thumbnail image
            $newVideoPost->tags = $videoFakeData['tags'];  // relate tags to this new video post

            // relate images to this new post
            $this->relateFakeImagesTo($newVideoPost, Post::TYPE_VIDEO, $videoService->getHighThumbnail()->url);

            return true;   // we can create one more post of this type
        }

        return false;  // we can't create one more post of this type
    }

    // CREATION OF THE GALLERY POST
    private function createGalleryPosts(int $galleryPostsCount = 5, int $galleryImagesCountPerPost = 15): bool
    {

        if ($this->creationIndex < $galleryPostsCount)
        {
            $galleryIndex = $this->creationIndex + 1;
            $newGalleryPost = $this->createNewGalleryPostObject($galleryIndex);

            // relate images to this new post
            $this->relateFakeImagesTo($newGalleryPost, Post::TYPE_GALLERY,
                                      null, $galleryImagesCountPerPost);

            return true;   // we can create one more post of this type
        }

        return false;   // we can't create one more post of this type
    }


    // -------------------------------------------------------------------------- //
    //
    //                           PRIVATE FUNCTIONS
    //
    // -------------------------------------------------------------------------- //

    // create and store a new fake casual post into the database
    private function createNewCasualPostObject(Collection $postData): Post
    {
        $postCategory = $this->categories->where('dev_name', $postData->get('category'))->first(); // look for category object with such a name
        $isRemotePost = random_int(0, 1);  // if this post is remoted or not
        $isPinned = $this->isPinnedPostOfCategory($postCategory->dev_name);
        $author = (!$isRemotePost) ? User::inRandomOrder()->first() : null;

        return Post::factory()     // create a new casual post
            ->casual(new Collection([
                'title'             => $postData->get('title'),

                // if this post is local or remoted
                'user_id'           => $isRemotePost ? null : $author->id,
                'source_title'      => $isRemotePost ? $this->faker->userName : null,
                'source_url'        => $isRemotePost ? $this->faker->url : null,
                'is_pinned'         => $isPinned,
            ]))
            ->withPostCategory($postCategory) // make a relation
            ->create();
    }

    // create and store a new fake video post into the database
    private function createNewVideoPostObject($videoService): Post
    {
        static $featureVideosCount = 3;
        $isFeature = ($featureVideosCount-- > 0) ? true : random_int(0, 1);
        $postCategory = $this->categories->random();     // get random category to make relation with it
        $videoData = $videoService->getVideoData();  // get data about this video using a YouTube video service
        $isPinned = $this->isPinnedPostOfCategory($postCategory->dev_name);

        // store the data into the database as video post
        return Post::factory()     // create a new casual post
            ->video(new Collection([
                'title'             => $videoData['videoTitle'],
                'duration'          => $videoData['duration'],     // a duration of the video
                'source_title'      => $videoData['channelTitle'], // a channel name
                'source_url'        => $videoData['channelLink'],  // a link to the channel
                'is_feature'        => $isFeature,
                'is_pinned'         => $isPinned,
            ]))
            ->withPostCategory($postCategory)  // make a relation
            ->create();
    }

    private function createNewGalleryPostObject(string $galleryIndex)
    {
        $postCategory = $this->categories->random();     // get random category to make relation with it
        $isRemotePost = random_int(0, 1);  // if this post is remoted or not
        $author = (!$isRemotePost) ? User::inRandomOrder()->first() : null;
        $isPinned = $this->isPinnedPostOfCategory($postCategory->dev_name);

        return Post::factory()     // create a new casual post
            ->gallery(new Collection([
                'title'             => "Gallery " . $galleryIndex,
                'description'       => "This is the gallery " . $galleryIndex,

                // if this post is local or remoted
                'user_id'           => $isRemotePost ? null : $author->id,
                'source_title'      => $isRemotePost ? $this->faker->userName : null,
                'source_url'        => $isRemotePost ? $this->faker->url : null,

                'is_pinned'         => $isPinned,
            ]))
            ->withPostCategory($postCategory)  // make a relation
            ->create();
    }

    // here we calculate the number of file in a particular directory ($pathToDir)
    private function fileCount(string $pathToDir): int
    {
        //$fi = new \FilesystemIterator($pathToDir, FilesystemIterator::SKIP_DOTS);
        //$filesFullDataArray = iterator_to_array($fi, false);
        //return iterator_count($fi);
    }

    private function getRandFakeImagePath(): string
    {
        $randFileNum = random_int(0, $this->numberOfFakeImages - 1);
        return $this->fakeImagesPathArray[$randFileNum];
    }

    // according to the post's type we make relations between fake images and this post
    private function relateFakeImagesTo($model, string $type,
                                        string $urlToImage = null, int $imagesCount = null): void
    {
        switch($type) {
            case Post::TYPE_CASUAL:
                $this->setFakeMainImageAndMasthead($model, $urlToImage);
                break;
            case Post::TYPE_GALLERY:
                $this->setFakeMainImageAndMasthead($model, $urlToImage);
                $this->setFakeGalleryImages($model, $imagesCount);
                break;
            case Post::TYPE_VIDEO:
                $model->mastheadImage = $urlToImage;
                break;
        }
    }

    private function setFakeMainImageAndMasthead($model, $urlToImage = null): void
    {
        if ($urlToImage) // if we have a link to some image we use it instead of a local file
        {
            $fileOrUrl = $urlToImage;
        }
        else
        {
            $fakeMainImagePath = $this->getRandFakeImagePath();  // get a random fake image
            $fileOrUrl = Utils::getFileByStoragePath($fakeMainImagePath, "storage_root");
        }

        $model->mainImage = $fileOrUrl;
        $model->mastheadImage = $fileOrUrl;
    }

    private function setFakeGalleryImages($model, $imagesCount): void
    {
        while ($imagesCount--)
        {
            $fakeMainImagePath = $this->getRandFakeImagePath();  // get a random fake image
            $fileOrUrl = Utils::getFileByStoragePath($fakeMainImagePath, "storage_root");

            $model->galleryImage = $fileOrUrl;
        }
    }

    // defines if to pin or not the post of such category
    private function isPinnedPostOfCategory(string $categoryDevName): bool
    {
        return (self::$pinCountToCategory[$categoryDevName]++ < $this->isPinnedCount) ? true : false;
    }

    // -------------------------------------------------------------------------- //
    //
    //                           FAKE DATA
    //
    // -------------------------------------------------------------------------- //

    private static $fakeVideoPostsData =
    [
        [
            'link'  => "https://www.youtube.com/watch?v=zm8KrDJ4Axw&ab_channel=StopGame.Ru",
            'tags'  => "history Shadow_Of_Chernobyl",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=NRYuzTbSfmY&ab_channel=VANDELEY",
            'tags'  => "bugs Clear_Sky",
        ],

        [
            'link'  => "https://www.youtube.com/watch?v=DLAb-ROjC_0&ab_channel=XGTV",
            'tags'  => "Heart_Of_Chornobyl demo",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=OuHdnsF118U&ab_channel=TheWolfstalker",
            'tags'  => "mods",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=ZxNkzLuACR8&ab_channel=OnlyGames",
            'tags'  => "history",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=wEyVUr_uSJY&ab_channel=%D0%A5%D0%90%D0%99%D0%9F%D0%95%D0%A0",
            'tags' => "Heart_Of_Chornobyl demo",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=JEFdHp2p-jA&ab_channel=Bazingarrey",
            'tags'  => "slogans",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=fSs_RPxapVw&ab_channel=%D0%91%D1%8D%D0%B1%D1%8D%D0%B9",
            'tags'  => "bebey kek",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=-rxAxXnu_p0&ab_channel=%D0%91%D1%8D%D0%B1%D1%8D%D0%B9",
            'tags'  => "Clear_Sky kek bebey",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=PFxdwbm2gNY&ab_channel=%D0%91%D1%8D%D0%B1%D1%8D%D0%B9",
            'tags'  => "Call_Of_Pripyat kek bebey",
        ],

        [
            'link'  => "https://www.youtube.com/watch?v=-lfWFzhdqv4&ab_channel=GamePlayerRUS",
            'tags'  => "Shadow_Of_Chernobyl playthrough",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=2jSCeSogZbA&ab_channel=ZanZax",
            'tags'  => "Shadow_Of_Chernobyl cache",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=ocuor5a2Ysk&ab_channel=VANDELEY",
            'tags'  => "Shadow_Of_Chernobyl secrets bugs",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=gvE_pOQuQUk&ab_channel=Marmok",
            'tags'  => "Shadow_Of_Chernobyl kek",
        ],
        [
            'link'  => "https://www.youtube.com/watch?v=dT1LfyQMlQ0&ab_channel=%D0%91%D1%8D%D0%B1%D1%8D%D0%B9",
            'tags'  => "Shadow_Of_Chernobyl bebey kek",
        ],
    ];

    private static $fakePostsData =
    [
        [
            'title'         => "ОБНОВИЛСЯ ОФИЦИАЛЬНЫЙ САЙТ S.T.A.L.K.E.R. 2",
            'category'      => 'from_dev',
            'tags'          => "S.T.A.L.K.E.R.2",
            'image_link'    => "https://giknutye.ru/wp-content/uploads/2022/01/stalker-poryadok-prohozhdeniya-igr-5-696x427.webp",
        ],
        [
            'title'         => "«Объединенный Пак 2.2»",
            'category'      => 'modding',
            'tags'          => "mods release",
        ],
        [
            'title'         => "Смерти Вопреки 3. Что стало с модом?",
            'category'      => 'modding',
            'tags'          => "mods",
        ],
        [
            'title'         => "Новые скриншоты «Dead Air 1.0»",
            'category'      => 'modding',
            'tags'          => "mods",
        ],
        [
            'title'         => "S.T.A.L.K.E.R. New Project",
            'category'      => 'modding',
            'tags'          => "mods",
            'image_link'    => "https://giknutye.ru/wp-content/uploads/2022/01/stalker-poryadok-prohozhdeniya-igr-1-696x392.webp",
        ],
        [
            'title'         => "Новые моды августа",
            'category'      => 'modding',
            'tags'          => "mods",
        ],
        [
            'title'         => "Скриншоты оружия были слиты на этой неделе: Калашников и СВД",
            'category'      => 'community',
            'tags'          => "weapon community",
        ],
        [
            'title'         => "Community Call: Первый опыт S.T.A.L.K.E.R.",
            'category'      => 'community',
            'tags'          => "community",
            'image_link'    => "https://giknutye.ru/wp-content/uploads/2022/01/stalker-poryadok-prohozhdeniya-igr-2-696x392.webp",
        ],
        [
            'title'         => "Прохождение stalker: зов припяти — затон, юпитер, припять и дополнительные  задания — Играем вместе",
            'category'      => 'community',
            'tags'          => "playthrough community",
        ],

        [
            'title'         => "Дневник сталкера-блондинки. Чистое небо. Часть 2 | Пикабу",
            'category'      => 'community',
            'tags'          => "community Clear_Sky",
        ],
        [
            'title'         => "Прохождение S.T.A.L.K.E.R: Call of Pripyat",
            'category'      => 'community',
            'tags'          => "playthrough Call_Of_Pripyat",
            'image_link'    => "https://giknutye.ru/wp-content/uploads/2022/01/stalker-poryadok-prohozhdeniya-igr-3-696x392.webp",
        ],
        [
            'title'         => "Прохождение S.T.A.L.K.E.R: Clear Sky",
            'category'      => 'community',
            'tags'          => "playthrough Clear_Sky",
            'image_link'    => "https://giknutye.ru/wp-content/uploads/2022/01/stalker-poryadok-prohozhdeniya-igr-2-696x392.webp",
        ],
        [
            'title'         => "Григорович отрезал себе палец, чтобы стать черепашкой-ниндзя",
            'category'      => 'from_dev',
            'tags'          => "from_developers Grigorovich",
            'image_link'    => "https://giknutye.ru/wp-content/uploads/2022/01/stalker-poryadok-prohozhdeniya-igr-4-696x392.webp",
        ],
        [
            'title'         => "Скупейко: новый разработчик низкоуровневой архитектуры игры",
            'category'      => 'from_dev',
            'tags'          => "architecture development inside",
        ],
        [
            'title'         => "Компания SGC представила трейлер на презентации Xbox, показав все возможности движка",
            'category'      => 'other',
            'tags'          => "trailer engine",
        ],
    ];
}
