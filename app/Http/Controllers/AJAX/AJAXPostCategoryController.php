<?php

namespace App\Http\Controllers\AJAX;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\AJAX\PostCategoryLoadMore;
use \Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

// this class is responsible for handling of
// AJAX-requests which are concern about Post model
class AJAXPostCategoryController extends Controller
{
    // takes params for loading more posts, prepares loaded posts data, and returns
    // it as a JsonResponse object
    public function loadmore(PostCategoryLoadMore $request): JsonResponse
    {
        try
        {
            $loadmoreParams = $request->validated();  // validate input params for filtration
            $loadedPosts = $this->loadMorePosts($loadmoreParams); // get loaded posts objects
            $postsRawData = $this->prepareData($loadedPosts); // prepare posts data for returning

            // prepare a response data structure
            $data = [
                'success' => true,
                'postsData' => $postsRawData,
            ];

            return response()->json($data, 200); // return a JsonResponse back to the page
        }
        catch (\Exception $e) // if there is some error during loading more posts
        {
            $data = [
                'success' => false,
                'error' => $request->getTranslatedErrors(),
            ];

            return response()->json($data, 200);
        }
    }


    // makes request to the db to load posts by particular input params;
    // returns an array with these posts data
    private function loadMorePosts(array $params): array
    {
        $loadPostsLimit = Utils::getConfig('content.post.limit.offset');  // how much posts we need to load
        $query = Post::orderBy($params['orderBy'], 'DESC');               // make a query builder

        if ($params['type'] !== PostCategoryLoadMore::$defaultParams['type'])   // if we want to load posts of some particular type
        {
            $query->where('type', $params['type']);
        }

        $paginator = $query->paginate($loadPostsLimit);

        return $paginator->items();   // return posts data
    } // loadPosts()


    // prepares posts data structure for returning
    private function prepareData(array $posts): array
    {
        $postsRawData = [];

        foreach($posts as $post)
        {
            $authorData = $post->author;

            $postsRawData[] = [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description,
                'mainImageAlbum' => $post->mainImageAlbum, // a post main image in the album format
                'url' => $post->url,
                'createdTime' => $post->createdTime,
                'author' => [
                    'title' => $authorData->get('title'),
                    'url'   => $authorData->get('url'),
                ],
            ];
        }

        return $postsRawData;
    } // prepareData()
}
