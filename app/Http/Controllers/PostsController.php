<?php

namespace App\Http\Controllers;

use App\Http\Repository\SearchRepository;
use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Repository\PostRepository;
use App\Models\Tag;
use App\Service\ImageUploader;
use App\Service\YouTubeVideoService;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use \Illuminate\Support\Collection;

class PostsController extends Controller
{
    private SearchRepository $searchControllerRepo;
    public function __construct()
    {
        $this->searchControllerRepo = new SearchRepository();
    }

    // ----------------------------------------------------------------------- //
    //                         PUBLIC FUNCTIONS                                //
    // ----------------------------------------------------------------------- //

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return $this->indexActionHelper();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        return view('posts.create.create')->with(['request' => $request]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request, ImageUploader $imageUploader): JsonResponse
    {
        return $this->storeActionHelper($request, $imageUploader);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        return $this->showActionHelper($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return $this->editActionHelper($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostStoreRequest $request
     * @param  Post $post
     * @return JsonResponse
     */
    public function update(PostStoreRequest $request, Post $post)
    {
        return $this->updateActionHelper($request, $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        return $this->destroyActionHelper($post);
    }




    // ----------------------------------------------------------------------- //
    //                         PRIVATE FUNCTIONS                               //
    // ----------------------------------------------------------------------- //

    private function indexActionHelper(): View
    {
        //$sortedPosts = Post::getPostsArraySortedByType();     // an array of sorted posts by their types\
        $featuredPosts = PostRepository::getFeaturePosts();
        $latestPosts = PostRepository::getLatestPosts();
        $popularPosts = PostRepository::getPopularPosts();
        $galleryPosts = PostRepository::getPostsByType(Post::TYPE_GALLERY);
        $videoPosts = PostRepository::getPostsByType(Post::TYPE_VIDEO);
        $postsByCategories = PostRepository::getPostsSortedByCategories(4);
        $popularTags = $this->searchControllerRepo->getPopularTags();
        $linkToTrailer = 'https://www.youtube.com/watch?v=SjDMwsbaSd8';
        $trailerVideo = new YouTubeVideoService($linkToTrailer);
        $trailerVideoData = $trailerVideo->getVideoData();

        return view('posts.index')
            ->with([
                'featuredPosts' => $featuredPosts,
                'latestPosts' => $latestPosts,
                'popularPosts' => $popularPosts,
                'popularTags' => $popularTags,
                'galleryPosts' => $galleryPosts,

                'videoPosts' => $videoPosts,
                'postsByCategories' => $postsByCategories,
                'categories' => PostCategory::getList(),
                'trailerVideoData' => $trailerVideoData,
            ]);
    }

    private function showActionHelper(Post $post)
    {
        try
        {
            $relatedPosts = $post->getRelatedPosts();

            return $post->view->with([
                'post'          => $post,
                'relatedPosts'  => $relatedPosts,
            ]);
        }
        catch (\Exception $e)
        {
            dd(__METHOD__, "at the line ".__LINE__, $e->getMessage());
        }
    }

    private function editActionHelper($post)
    {
        if ($post)  // if we found such a post
        {
            $isUsualPost = $post->type !== Post::TYPE_VIDEO;  // what type of the post we want to edit?

            return view('posts.edit.edit')->with([
                'post'  => $post,
                'isUsualPost' => $isUsualPost,
            ]);
        }
    }

    private function storeActionHelper($request, ImageUploader $imageUploader)
    {
        $fakeFile = \Illuminate\Http\UploadedFile::fake()->image('fake_image.jpg', 1000, 1000);

        $uploadResult = $imageUploader->upload($fakeFile, Post::IMAGE_TYPE_MAIN, 'jpg');

        try
        {

            $validated = $request->validated();       // validated data
            $newPost = Post::createPost(new Collection($validated));  // try to create a new post and store it into the database

            if (!$newPost) {
                throw new \RuntimeException("can't create a new Post object");
            }

            $data = [
                'success' => true,
                //'idOfNewMod' => $newMod->id,
                'linkToThisPostPage' => $newPost->url,  // the route to go to after a post was created
                'message' => __('post.create.success_creation', [], App::currentLocale()),
            ];

            return response()->json($data, 200);
        }
        catch (ValidationException $e)
        {
            $translatedErrorMessages = $request->getTranslatedErrors(); // get translated messages about validation errors

            return response()->json([
                'success' => false,
                'errorMessages' => $translatedErrorMessages,
                'message' => __('post.create.submit.error_common', [], App::currentLocale()),
            ], 200);
        }
        catch (\RuntimeException $e)
        {

        }
    }


    private function updateActionHelper($request, $post)
    {
        try
        {
            $validatedData = $request->validated();     // validated data

            if (!$post->updatePost($validatedData))      // if the post wasn't successfully updated
            {
                throw new ValidationException($request->getValidator());
            }

            // or everything is ok
            $data = [
                'success' => true,
                'linkToThisModPage' => $post->url,  // the route to go to after a modification was updated
                'message' => __('modification.edit.success_updating', [], App::currentLocale()),
            ];

            return response()->json($data, 200);
        }
        catch (ValidationException $e)
        {
            $translatedErrorMessages = $request->getTranslatedErrors(); // get translated messages about validation errors

            return response()->json([
                'success' => false,
                'errorMessages' => $translatedErrorMessages,
                'message' => __('post.edit.failed_updating', [], App::currentLocale()),
            ], 200);
        }

        return redirect()->route('posts.show', ['post' => $post->slug]);
    }


    private function destroyActionHelper($post)
    {
        try // if there is a necessary post
        {
            $post->tags()->sync([]);    // delete all the relations between this post and related tags
            $post->delete();

            flash('The post has been deleted!')->success();

            return redirect()
                ->route("post.index");
        }
        catch (\Exception $e)
        {
            dd(__METHOD__, "at the line ".__LINE__, $e->getMessage());
        }
    }
}
