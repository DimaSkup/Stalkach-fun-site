<?php

namespace App\Service;

use App\Helpers\Utils;
use ErrorException;
use Google\Client as Google_Client;
use Google\Service\YouTube as Google_Service_YouTube;
use Google\Service\YouTube\Video as Google_Service_YouTube_Video;
use Google\Service\Exception as Google_Service_Exception;
use Google\Exception as Google_Exception;

class YouTubeVideoService
{
    private const MAX_DESCRIPTION_SIZE = 255;
    public const YOUTUBE_PREVIEW_IMAGE = 'youtube_image_preview'; // a key to configurations of videos preview

    public function __construct($videoLink)
    {
        try
        {
            $this->videoId = "";
            $this->linkToVideo = $videoLink;

            $this->initVideoIdUsingLink($videoLink);  // first of all we get a video id

            $client = new Google_Client();
            $client->setDeveloperKey(config('services.google.api_key'));
            $googleServiceYouTube = new Google_Service_YouTube($client);

            // call the API's videos.list method to retrieve the video resource
            $response = $googleServiceYouTube->videos->listVideos(["snippet", "contentDetails", "statistics"], ['id' => $this->videoId]);
            $responseItems = current($response->getItems());

            if ($responseItems === false)
            {
                dump("link: ", $this->getLinkToVideo(), "id: ", $this->getId());
                throw new \RuntimeException("a response items variable is empty");
            }

            $this->snippet = $responseItems->getSnippet();
            $this->googleServiceYouTubeVideo = $responseItems;
            $this->thumbnails = $this->snippet->getThumbnails();

            $this->init = true;
        }
        catch (\Exception $e)
        {
            $this->init = false;
            dd($e->getLine(), $e->getMessage(), $e->getTrace());
        }
    }



    // ------------------------------------------------------------------------------- //
    //                                  GETTERS                                        //
    // ------------------------------------------------------------------------------- //

    // returns video data (look at the keys of an array which returns)
    public function getVideoData() : array
    {
        if ($this->init)
        {
            return [
                'id'                => $this->getId(),
                'videoLink'         => $this->getLinkToVideo(),
                'videoTitle'        => $this->getTitle(),
                'channelTitle'      => $this->getChannelTitle(),
                'channelLink'       => $this->getChannelLink(),
                //'defaultThumbnail'  => $this->getDefaultThumbnail(),
                //'mediumThumbnail'   => $this->getMediumThumbnail(),
                'highThumbnail'     => $this->getHighThumbnail(),
                'views'             => $this->getViewsCount(),
                'description'       => $this->getDescription(),
                'duration'          => $this->getDuration(),
                'publishedAt'       => $this->getPublishedAt(),
            ];
        }

        return [
            'error'             => "Something went wrong, please, check what's happened
                                    using the getErrorMessage() function",
        ];
    }

    // just pass to this function a link of some youtube video and get its id as a result
    public static function getIdByLink($link)
    {
        parse_str(parse_url($link, PHP_URL_QUERY), $my_array_of_vars);
        return ($my_array_of_vars['v']) ?? "";   // if there is no value, so we return false
    }

    public function getLinkToVideo(): string
    {
        return $this->linkToVideo;
    }

    // return an array of tags of this video
    public function getTags(): array
    {
        return $this->snippet->tags;
    }

    // return an id of the video
    public function getId() : string
    {
        return $this->videoId;
    }

    // return a title of the video
    public function getTitle() : string
    {
        return $this->snippet->title;
    }

    // return a views count of the video
    public function getViewsCount() : int
    {
        return $this->getStatistics()->viewCount;
    }

    // return a name of a channel where this video is posted
    public function getChannelTitle() : string
    {
        return $this->snippet->channelTitle;
    }

    // return a link to a YouTube channel of this video
    public function getChannelLink(): string
    {
        return "https://www.youtube.com/channel/" . $this->snippet->channelId;
    }

    // return a description of the video
    public function getDescription(): string
    {
        if (!isset($this->videoDescription))  // if the video description hasn't been handled yet
        {
            $this->initDescription($this->snippet->description); // handle it
        }

        return $this->videoDescription;
    }

    // return time when the video was published
    public function getPublishedAt(): string
    {
        return $this->snippet->publishedAt;
    }

    // return a duration of the video
    public function getDuration() : string
    {
        if (!isset($this->videoDuration)) // if the video duration value hasn't been handled yet
        {
            $this->initDuration($this->getContentDetails()->duration);
        }

        return (string)$this->videoDuration;
    }

    // ---- THUMBNAILS GETTERS ---- //
    public function getDefaultThumbnail(): \Google\Service\YouTube\Thumbnail
    {
        return $this->thumbnails->getDefault();
    }

    public function getMediumThumbnail(): \Google\Service\YouTube\Thumbnail
    {
        return $this->thumbnails->getMedium();
    }

    public function getHighThumbnail(): \Google\Service\YouTube\Thumbnail
    {
        $highThumb = $this->thumbnails->getHigh();  // get a standard high thumbnail

        // make new params for this thumbnail
        $linkToImage = "http://img.youtube.com/vi/".$this->getId()."/maxresdefault.jpg";
        $configKey = 'content.' . Utils::getConfigKeyByFileType(self::YOUTUBE_PREVIEW_IMAGE);
        $youTubeVideoPreviewParams =  Utils::getConfig($configKey);
        $width = $youTubeVideoPreviewParams['width'];   // set new width
        $height = $youTubeVideoPreviewParams['height']; // set new height

        // set new params for this thumbnail
        $highThumb->setUrl($linkToImage);
        $highThumb->setWidth($width);
        $highThumb->setHeight($height);

        return $highThumb;
    }



    // ------------------------------------------------------------------------------- //
    //                               INITIALIZERS                                      //
    // ------------------------------------------------------------------------------- //

    // initializes the video id using the video link
    public function initVideoIdUsingLink($videoLink)
    {
        // if there is an incorrect video link
        if (!is_string($videoLink) || empty($videoLink))
        {
            $this->init = false;
            throw new \InvalidArgumentException(__METHOD__." at line ".__LINE__. ": video link is incorrect or empty!");
        }

        $this->videoId = self::getIdByLink($videoLink);     // an id of the video

        // if there is a video link with incorrect video id
        if (!is_string($this->videoId))
        {
            $this->init = false;
            throw new \RuntimeException(__METHOD__." at line ".__LINE__. ":\n  please, provide a video link together with a correct video id!");
        }
    }


    // initialize the description property with the first video description line
    /*
     * param: full text of the video description
     */
    private function initDescription(string $rawDescription) : void
    {
        $count = mb_strpos($rawDescription, "\n");              // get the symbols count of the first line in this description
        $count = ($count < self::MAX_DESCRIPTION_SIZE) ? $count : self::MAX_DESCRIPTION_SIZE;   // if the first line size is above $descriptionSize characters then we'll set it to $descriptionSize value
        $description =  mb_substr($rawDescription, 0, $count);   // get the first line separately or the $descriptionSize characters line
        $this->videoDescription = trim($description, ", "); // trim all spaces and commas
    }

    // initialize the duration property with the video duration time
    private function initDuration(string $dateCode): void
    {
        // because YouTube return a video duration in DateInterval initialization codes
        // we need to translate it to the proper format (in our case it is a duration in minutes)
        $dateInterval = new \DateInterval($dateCode);
        $this->videoDuration = ($dateInterval->h * 60) + $dateInterval->i;
    }


    /*
     * @return Google_Service_YouTube_VideoStatistics
     * Google_Service_YouTube_VideoStatistics Object ( [commentCount] => 0 [dislikeCount] => 0 [favoriteCount] => 0 [likeCount] => 0 [viewCount] => 0 )
     */
    private function getStatistics()
    {
        try
        {
            if ($this->googleServiceYouTubeVideo instanceof Google_Service_YouTube_Video)
            {
                return $this->googleServiceYouTubeVideo->getStatistics();
            }
        }
        catch (Google_Service_Exception $e)
        {
            return sprintf("<p>A service error occurred: <code>%s</code></p>",
                htmlspecialchars($e->getMessage()));
        }
        catch (Google_Exception $e)
        {
            return sprintf("<p>An client error occurred: <code>%s</code></p>",
                htmlspecialchars($e->getMessage()));
        }
    }

    /*
    * @return Google_Service_YouTube_VideoSnippet
    * Google_Service_YouTube_VideoSnippet Object
    */
    private function getSnippet()
    {
        try
        {
            if ($this->googleServiceYouTubeVideo instanceof Google_Service_YouTube_Video)
            {
                return $this->googleServiceYouTubeVideo->getSnippet();
            }
        }
        catch (Google_Service_Exception $e)
        {
            return sprintf("<p>A service error occurred: <code>%s</code></p>",
                htmlspecialchars($e->getMessage()));
        }
        catch (Google_Exception $e)
        {
            return sprintf("<p>An client error occurred: <code>%s</code></p>",
                htmlspecialchars($e->getMessage()));
        }
    }

    /*
   * @return Google_Service_YouTube_VideoContentDetails
   * Google_Service_YouTube_VideoContentDetails Object
   */
    private function getContentDetails()
    {
        try
        {
            if ($this->googleServiceYouTubeVideo instanceof Google_Service_YouTube_Video)
            {
                return $this->googleServiceYouTubeVideo->getContentDetails();
            }
        }
        catch (Google_Service_Exception $e)
        {
            return sprintf("<p>A service error occurred: <code>%s</code></p>",
                htmlspecialchars($e->getMessage()));
        }
        catch (Google_Exception $e)
        {
            return sprintf("<p>An client error occurred: <code>%s</code></p>",
                htmlspecialchars($e->getMessage()));
        }
    }

    // check if this instance was initialized correct using this function
    public function isInit(): bool
    {
        return $this->init;
    }

    // if an error happened, we can look what's wrong using the errorMessage property
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }


    // ------------------------------------------------------------------------------- //
    //                               PRIVATE VARIABLES                                 //
    // ------------------------------------------------------------------------------- //
    private string $videoId;
    private string $linkToVideo;
    private string $videoDescription;
    private int $videoDuration;

    private  \Google\Service\YouTube\VideoSnippet $snippet;
    private  \Google\Service\YouTube\ThumbnailDetails $thumbnails;

    // here is placed data of a video after calling the API's videos.list method to retrieve the video resource
    private $googleServiceYouTubeVideo;

    // google youtube service
    private Google_Service_YouTube $youtube;

    // is this YouTubeVideoService instance initialized correctly?
    private bool $init;

    // if this instance is not initialized correctly we set a message about its cause
    private string $errorMessage;
}
