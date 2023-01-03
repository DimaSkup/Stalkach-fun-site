<?php

namespace App\Models;

use App\Helpers\Utils;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Tag extends Model
{

    protected $fillable = [
        "name",
        "tag_count",
    ];

    // ----------------------------------------------------------------------- //
    //                            RELATIONS                                    //
    // ----------------------------------------------------------------------- //

    // this model will belong to whatever model
    // is defined in the taggable_type field
    public function posts(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function mods(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Mod::class, 'taggable');
    }

    // a relation between two tags
    public function tags()
    {
        return $this->belongsToMany(__CLASS__,
            'tags_tags',
            'original_tag_id',
            'assigned_tag_id');
    }



    // ----------------------------------------------------------------------- //
    //                         PUBLIC METHODS                                  //
    // ----------------------------------------------------------------------- //

    // creates a relation between the model and tags which names is in input string
    public static function relateModelToTags(Model $model, string $tagsString): void
    {
        Utils::checkArguments($tagsString);  // check the arguments

        // get an array with tags which we'll relate to the post
        $newRelatedTags = self::getNewOrFindTagsByNames($tagsString ?? "");
        $prevRelatedTagsIds = $model->tags()->get()->all();

        self::handleTags($newRelatedTags, $prevRelatedTagsIds); // create tags and relations between it.
        $tagsIds = array_column($newRelatedTags, 'id');
        $model->tags()->sync($tagsIds);    // synchronize relations between model and tags
    }

    // generate and return a route to search page to do search by a tag id
    public function getRouteSearchByTagAttribute(): string
    {
        return route('search', ['tag_id' => $this->id]);
    }

    // creation of an array which will contain Tag objects;
    // we're looking for tags by some tag name or create such a new tag
    // if we couldn't find it
    /**
     * @param $tagsNames
     * @return array
     */
    public static function getNewOrFindTagsByNames($tagsNames) : array
    {
        // if we have no data to find tags
        if (!isset($tagsNames) || $tagsNames === "" || $tagsNames === [])
        {
            return [];
        }

        $tags = [];     // here we'll put all the new Tag objects

        // if we get a string as the function's parameter
        if (is_string($tagsNames) && $tagsNames !== "")
        {
            $tagsNames = explode(" ", $tagsNames);     // explode tags names
        }

        // go through each tag's name
        foreach ($tagsNames as $tagName)
        {
            $tags[] = self::getNewOrFindTagByName(trim($tagName));
        }

        return $tags;
    }


    public static function getNewOrFindTagByName(string $tagName) : self
    {
        // return this created/found tag object
        return self::firstOrNew(
            [
                'name' => $tagName, // looking for a tag object with such a name
            ]
        );
    }

    // pass an object which have relation with Tag and
    // get some data of all the related tags
    public static function getTagsByRelatedObject($obj) : Collection
    {
        $tagsArr = $obj->tags;  // get all the tags object
        $tagsData = new Collection();

        // go through each tag object
        foreach ($tagsArr as $tag)
        {
            $tagsData[] = [
                'id'    => $tag->id,
                'name'  => $tag->name,
            ];
        }

        return $tagsData;  // return a Collection with tags data
    }


    public static function getTagsByNames(array $tagNames)
    {
        // looking for tags
        $tagsQueryBuilder = Tag::where('name', 'like', "%$tagNames[0]%");
        for ($it = 1, $itMax = count($tagNames); $it !== $itMax; ++$it)
        {
            $tagsQueryBuilder->orWhere('name', 'like', "%$tagNames[$it]%");
        }

        return $tagsQueryBuilder->get()->all();   // an of tags by its names
    }


    /**
     * @param array $newRelatedTags     - new tags which will be related to the model
     * @param array $prevRelatedTags    - old tags which are already related to the model
     */
    // 1. recording of each tag from the $newRelatedTags array into the database, if it hasn't been yet
    // 2. creation of the relation between some tag and others from the array $newRelatedTags
    // 3. deletion of the old relations between each tag from $newRelatedTags and old tags which won't be used
    public static function handleTags(array $newRelatedTags, array $prevRelatedTags = []): void
    {
        // saving of each tag into the database
        foreach ($newRelatedTags as $tag)
        {
            if (!$tag->id)      // if such a tag isn't recorded to the database
            {
                $tag->save();
            }
        }

        $oldRelatedTagsIds = [];    // we'll put here ids of tags which won't have relations with the new tags
        // handling of the old related tags
        if ($prevRelatedTags !== [])
        {
            $newRelatedTagsIds = array_column($newRelatedTags, 'id');

            // get tags which won't have relations with new ones
            $oldRelatedTags = array_values(array_filter($prevRelatedTags, static function($value) use ($newRelatedTagsIds) {
                return !in_array($value->id, $newRelatedTagsIds, true);
            }));

            // if we have some tags which already won't be related to the model (posts, mods, memes, etc.)
            foreach ($oldRelatedTags as $oldRelatedTag)
            {
                $oldRelatedTagsIds[] = $oldRelatedTag->id;

                // deleting of the relations between this tag and new ones (if there were some)
                $oldRelatedTag->tags()->detach($newRelatedTagsIds);
            }
        }

        // create new relations between each tag
        // and detach tags ids which already don't have relation to these ones
        foreach ($newRelatedTags as $tag)
        {
            foreach ($newRelatedTags as $relatedTag)
            {
                if ($tag !== $relatedTag && !$tag->tags->contains($relatedTag))
                {
                    $tag->tags()->save($relatedTag);    // create the relations
                    $relatedTag->save();
                }
            }

            $tag->tags()->detach($oldRelatedTagsIds);     // detach the old relations
        }




        /*
         *  THE CODE FOR INSERTION MANY TAGS INTO THE DATABASE AS A SINGLE DATA ARRAY
         *
            $tagsData = [];
            $insertedTagsNames = [];

            foreach($tags as $index => $tag )
            {
                if (!$tag->id)     // if such a tag isn't recorded to the database
                {
                    $attrArray = $tag->attributesToArray();
                    $attrArray['created_at'] = new DateTime;
                    $attrArray['updated_at'] = $attrArray['created_at'];
                    $tagsData[] = $attrArray;
                    $insertedTagsNames[] = $attrArray['name'];
                    unset($tags[$index]);
                }
            }
            Tag::insert($tagsData);
            $insertedTags = Tag::whereIn('name', $insertedTagsNames)->get();
        */
    }


    // ------------------------------------
    //          PRIVATE FUNCTIONS
    // ------------------------------------

    private function getClassMethods(): array
    {
        $methodsArray = get_class_methods($this);
        sort($methodsArray);
        return $methodsArray;
    }

}
