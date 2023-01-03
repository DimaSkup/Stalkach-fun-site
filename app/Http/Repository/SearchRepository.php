<?php

namespace App\Http\Repository;

use App\Models\Mod;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class SearchRepository
{
    public const CONTENT_TYPES_LIST = [
        'posts',
        'mods',
        'memes',
    ];
    public $GETTERS_BY_CONTENT_TYPE = [];

    public function __construct()
    {
        foreach (self::CONTENT_TYPES_LIST as $contentType)
        {
            $this->GETTERS_BY_CONTENT_TYPE[$contentType] = "get" . ucfirst($contentType) . "ByQuery";
        }
    }

    // -----------------------------------------
    //          THE GETTERS BY QUERY
    // -----------------------------------------

    public function getRandomContentTypeByQuery(array $queryWords, int $maxResultsCount)
    {
        //$randContentTypeName = self::CONTENT_TYPES_LIST[random_int(0, count(self::CONTENT_TYPES_LIST) - 1)];
        $randContentTypeName = 'posts';     // currently we temporarily use searching only for posts
        return $this->{$this->GETTERS_BY_CONTENT_TYPE[$randContentTypeName]}($queryWords, $maxResultsCount);
    }

    public function getPostsByQuery(array $queryWords, int $maxResultsCount) : array
    {
        $posts = collect();    // all the found posts

        // looking for posts which have a title like any of the queryWords
        $postsQueryBuilder = Post::where('title', 'like', "%$queryWords[0]%");
        for ($it = 1, $itMax = count($queryWords); $it !== $itMax; ++$it)
        {
            $postsQueryBuilder->orWhere('title', 'like', "%$queryWords[$it]%");
        }

        $posts = $postsQueryBuilder->get()->all();   // the found posts

        // looking for posts by related tags which have such a name like any of of queryWords
        $tags = Tag::getTagsByNames($queryWords);
        foreach ($tags as $tag)
        {
            foreach ($tag->posts()->get()->all() as $postByTag)
            {
                $posts[] = $postByTag;    // the found posts
            }
        }

        // looking for posts which have a category like any of the queryWords
        $postsQueryBuilder = Post::where('category', 'like', "%$queryWords[0]%");
        for ($it = 1, $itMax = count($queryWords); $it !== $itMax; ++$it)
        {
            $postsQueryBuilder->orWhere('category', 'like', "%$queryWords[$it]%");
        }

        foreach ($postsQueryBuilder->get()->all() as $postWithCategory)
        {
            $posts[] = $postWithCategory; // the found posts
        }

        $postsWithUniqueId = collect($posts)
                            ->unique('id')
                            ->slice(0, $maxResultsCount)
                            ->all();
        return ['posts' => $postsWithUniqueId];
    }

    public function getModsByQuery(array $queryWords, int $maxResultsCount)
    {
        return [];
    }

    public function getMemesByQuery(array $queryWords, int $maxResultsCount)
    {
        return [];
    }

    public function searchTagsByQuery(array $queryWords)
    {
        $tags = Tag::getTagsByNames($queryWords);
        $tagsData = [];

        foreach ($tags as $tag)
        {
            $tagsData[] = [
                'id'    => $tag->id,
                'name'  => $tag->name,
            ];
        }

        return $tagsData;
    }



    // -----------------------------------------
    //           THE GETTERS BY TAG
    // -----------------------------------------

    // get all the posts related to this tag
    public function getPostsByTag(int $tagId, int $maxResultsCount) : array
    {
        $tag = Tag::find($tagId);    // looking for the tag with such an id
        return (is_object($tag)) ? $tag->posts->slice(0, $maxResultsCount)->all() : [];
    }

    public function getModsByTag(int $tagId, int $maxResultsCount = 4) : array
    {
        $tag = Tag::find($tagId);   // looking for the tag with such an id
        return (is_object($tag)) ? $tag->mods->slice(0, $maxResultsCount)->all() : [];
    }

    public function getRelatedTagsByTagId(int $tagId)
    {
        $tag = Tag::find($tagId);
        return $tag->tags()->get()->all(); // return the related tags
    }



    // ------------------------------------------------
    //  THE GETTERS FOR SEARCHING OF POPULAR CONTENT
    // ------------------------------------------------

    // get the popular tags
    /**
     * @param int $countOfPopular
     * @return array
     */
    public function getPopularTags(int $countOfPopular = 6): array
    {
        return Tag::limit($countOfPopular)->get()->all();
    }

    // get the popular content
    // (it can be randomly: popular posts or mods or memes)
    /**
     * @param int $limit
     * @param string $orderBy
     * @return array
     */
    public function getPopularContent(int $limit = 4, string $orderBy = 'DESC'): array
    {
        return [
            'posts'     =>  Post::limit($limit)->orderBy('views', $orderBy)->get()->all(),
            'mods'      =>  Mod::limit($limit)->orderBy('views', $orderBy)->get()->all(),
            'memes'     =>  NULL,
        ];
    }

}
