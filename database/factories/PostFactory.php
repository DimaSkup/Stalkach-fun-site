<?php

namespace Database\Factories;

use App\Helpers\Utils;
use App\Models;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\User;
use App\Service\YouTubeVideoService;
use \Faker\Generator as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $faker;

     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        //$fakePostsImagesPath = config('filesystems.types.post_main_image.fake');
        $this->faker = \Faker\Factory::create();

        // prepare some data
        $title = $this->faker->title(40) . random_int(1, 10) . random_int(1, 10);
        $text = implode(PHP_EOL, $this->faker->paragraphs($this->faker->numberBetween(1, 3)));

        $defaultVideoLink = "https://www.youtube.com/watch?v=NRYuzTbSfmY&ab_channel=VANDELEY";

        $type = $this->faker->randomElement(Post::getTypes());
        $duration = (in_array($type, [Post::TYPE_CASUAL, Post::TYPE_VIDEO], true)) ? random_int(2, 10) : null;

        return [
            # content scope
            'title'             => $title,
            'description'       => $this->faker->sentence,
            'text'              => $text,
            'type'              => $type,

            # author
            //'user_id'           => $user->id,
            'source_title'      => $this->faker->userName,
            'source_url'        => $this->faker->url,

            # other relations
            //'post_category_id'       => null,              // don't use because we have not a post's id

            # tracking
            'views'             => random_int(20, 3000),

            # parameters
            'is_pinned'         => random_int(0, 1),
            'is_feature'        => random_int(0, 1),
            'is_ad'             => random_int(0, 1),
            'is_approved'       => true,
            'duration'          => $duration,
            'settings'          => NULL,
        ];
    }

    // ---------------------------------------------------------------------------- //
    //                                 HELPERS                                      //
    // ---------------------------------------------------------------------------- //

    /**
     * Indicates that this post has a casual type
     * @return Factory
     */
    public function casual(Collection $data): Factory
    {
        return $this->state(function (array $attributes) use ($data) {
            $attributes['type'] = Post::TYPE_CASUAL;
            foreach ($data as $key => $value)
            {
                $attributes[$key] = $value;
            }

            return $attributes;
        });
    } // casual()

    /**
     * Indicates that this post has a video type
     * @return Factory
     */
    public function video(Collection $data): Factory
    {
        return $this->state(function (array $attributes) use ($data) {
            $attributes['type'] = Post::TYPE_VIDEO;

            foreach ($data as $key => $value)
            {
                $attributes[$key] = $value;
            }

            return $attributes;
        });
    } // video()

    /**
     * Indicates that this post has a gallery type
     * @return Factory
     */
    public function gallery(Collection $data): Factory
    {
        return $this->state(function (array $attributes) use ($data) {
            $attributes['type'] = Post::TYPE_GALLERY;

            foreach ($data as $key => $value)
            {
                $attributes[$key] = $value;
            }

            return $attributes;
        });
    } // gallery()



    // ---------------------------------------------------------------------------- //
    //                           MAKING RELATIONS                                   //
    // ---------------------------------------------------------------------------- //

    // returns an instance of Post with all the relations
    public function getModel(): Post
    {
        return $this->withPostCategory()
            		->withLocalAuthor()
            		->create();
    }

    // gets a PostCategory object and makes a relation with it or
    // creates new or get existing category from the database and makes relation with it
    public function withPostCategory($data = false): Factory
    {
        if ($data instanceof PostCategory) // if we have a PostCategory object
        {
            $postCategory = $data;
        }
        else // else we want to create new or get existing one
        {
            $postCategory = ($data === false) ? PostCategory::factory()->create() : PostCategory::inRandomOrder()->first();
        }

        return $this->state(function () use ($postCategory) {
            return [
                'post_category_id' => $postCategory->id,
            ];
        });
    } // withCategory()

    // set an author which is registered on our site
    public function withLocalAuthor(): Factory
    {
        $author = User::factory()->create();

        return $this->state(function () use ($author) {
            return [
                'user_id' => $author->id,
            ];
        });
    }

    // set an author which is remoted, and like he made the article on another site
    public function withRemoteAuthor(): Factory
    {

    }

    public function hasType(string $type): PostFactory
	{
		// check the input parameter
		if (!in_array($type, Post::getTypes()->all(), true))
		{
			throw new \InvalidArgumentException("there is no such a type in Post model");
		}

		return $this->state(function () use ($type) {
			return [
				'type' => $type,
			];
		});
	}



    // ---------------------------------------------------------------------------- //
    //                                 FOR TESTS                                    //
    // ---------------------------------------------------------------------------- //
    // correct raw modification data like we get it from the creation form
    public function getRawCorrectData(): array
    {

    }

    // wrong raw modification data like we get it from the creation form
    public function getRawWrongData($returnEmptyData = false): array
    {

    }
}

