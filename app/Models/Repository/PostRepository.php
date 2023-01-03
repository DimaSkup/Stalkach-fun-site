<?php


namespace App\Models\Repository;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Collection;

class PostRepository
{
    public static function getPostsByType($type, $count = null): Collection
    {
        if (!Post::getTypes(true)->has($type))
        {
            throw new \InvalidArgumentException("provide a correct value of type");
        }

        return Post::where('type', $type)
                    ->limit($count ?: config('content.posts.limit.by_type', 4))
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    // ----------------------------------------------------------------------- //
    //                          STATIC METHODS                                 //
    // ----------------------------------------------------------------------- //
    public static function getFeaturePosts($count = null): iterable
    {
        return Post::where('is_feature', 1)
                    ->limit($count ?: config('content.posts.limit.feature', 3))
                    ->get();
    }

    public static function getPinnedPosts($count = null): iterable
    {
        return Post::where('is_pinned', 1)
                    ->limit($count ?: config('content.posts.limit.feature', 3))
                    ->get();
    }

    public static function getPopularPosts($count = null): iterable
    {
        return Post::where('is_feature', '!=', 1)
                    ->limit($count ?: config('content.posts.limit.popular', 5))
                    ->orderBy('views', 'desc')
                    ->get();
    }

    // get latest posts in number of $postsCount
    public static function getLatestPosts($count = null): iterable
    {
        return Post::where('is_feature', '!=', 1)
                    ->limit($count ?: config('content.posts.limit.latest', 3))
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    // get posts sorted by categories in number of $postsCount
    public static function getPostsSortedByCategories($count = null): array
    {
        $postsByCategories = [];

        foreach (PostCategory::getList() as $postCategory)
        {
            $postsByCategories[] = new Collection([
                'category' => $postCategory,
                'posts' => Post::where('post_category_id', $postCategory->id)
                    ->limit($count ?: config('content.posts.limit.by_category', 4))
                    ->get()
            ]);
        }

        return $postsByCategories;
    }

    // here we get an array of all the posts in count of $postsCount which are sorted by their type
    public static function getPostsArraySortedByType($postsCount = 50, $latestPostsCount = 15): array
    {
        $allPosts = Post::limit($postsCount)->orderBy('created_at', 'desc')->get();
        $sortedPosts = array_fill_keys(Post::getTypes(), []);  // an array of sorted posts

        // sort posts by their types
        foreach ($allPosts as $post)
        {
            if ($post->is_feature) continue;   // skip all the posts of "feature" type because we don't need to mix it with other types
            $sortedPosts[$post->type][] = $post;
        }

        $sortedPosts['feature'] = $allPosts->where('is_feature', 1)->all();    // also we need to have an access to feature posts
        $sortedPosts['latest'] = array_slice($allPosts->all(), 0, $latestPostsCount);   // get latest posts

        return $sortedPosts;
    }
}