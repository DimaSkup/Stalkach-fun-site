<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Repository\SearchRepository;

// there is a controller for a searching system
class SearchController extends Controller
{
    private SearchRepository $searchControllerRepo;

    public function __construct()
    {
        $this->searchControllerRepo = new SearchRepository();
    }

    // return a view with the search form
    public function searchForm(Request $request)
    {
        $requestResults = $this->getResultsByRequest($request);  // handle the request and get results

         //dd($requestResults['content'], $requestResults['isPopularData']);
        // check if we have any results by this query/tag
        $isAnyResults = false;
        foreach ($requestResults['content'] as $contentType)
        {
            if ($contentType !== [] && $contentType !== null)
            {
                $isAnyResults = true;
                break;
            }
        }

        return view('search.form')
            ->with('isPopularData', $requestResults['isPopularData'])
            ->with('tags', $requestResults['tags'])
            ->with('content', $requestResults['content'])
            ->with('isAnyResults', $isAnyResults);
    }

    /**
     * Search for data by particular parameters from the search form
     * and return it
     *
     * There are 3 cases of queries:
     * 1. We've just come to the search page or sent empty query - return popular results
     * 2. Search for data by tag id - return related data and related tags
     * 3. Search for data by query string - return related data by query words
     *
     * @param Request $request
     * @return array
     */
    public function getResultsByRequest(Request $request, $maxResultsCount = 4): array
    {
        $isCached = false;
        $allQueryParameters = $request->query->all();   // get an array with queries
        $isPopularData = false;
        $content = [];
        $tags = [];

        // CASE 1: we have not some query from the search form
        // (we've just come to the search page or sent empty query)
        if ($allQueryParameters === [] || (!isset($allQueryParameters['query']) && !isset($allQueryParameters['tag_id'])))
        {
            $tags = $this->searchControllerRepo->getPopularTags();
            $content = $this->searchControllerRepo->getPopularContent();
            $isPopularData = true;
        }
        // CASE 2: we are looking for data by some tag id
        else if (isset($allQueryParameters['tag_id']))
        {
            $tagId = (int)$allQueryParameters['tag_id'];

            if ($tagId)
            {
                if ($isCached)  // this query has already been cached
                {
                    dd("Tag id: ", $tagId, "is cached");
                }
                else    // this query hasn't been cached yet
                {
                    $content['posts'] = $this->searchControllerRepo->getPostsByTag($tagId, $maxResultsCount);
                    $content['mods']  = $this->searchControllerRepo->getModsByTag($tagId);
                    //$content['memes'] = $this->searchControllerRepo->searchMemesByTag($tagId);
                    $tags = $this->searchControllerRepo->getRelatedTagsByTagId($tagId);
                }
            }
        }
        // CASE 3: we are looking for data by a query string from the search form
        else
        {
            $queryString = trim($allQueryParameters['query']);  // delete all spaces from the query string
            // ok, we have some data in the query string (but we don't know if it is correct), let's parse this data
            $parsedQueryWords = $this->parseQueryString($queryString);

            if ($parsedQueryWords)     // there is some correct data in the query string
            {
                if ($isCached)  // this query has already been cached
                {
                    dd("Query", $parsedQueryWords, "is cached");
                }
                else    // this query hasn't been cached yet
                {
                    // we randomly get only posts, or only mods, or only memes, etc. by these query words

                    $content = $this->searchControllerRepo->getRandomContentTypeByQuery($parsedQueryWords, $maxResultsCount);
                    // searching for tags by these query words
                    $tags = $this->searchControllerRepo->searchTagsByQuery($parsedQueryWords);
                }
            }
            else    // we got the query with incorrect data, so we just return popular data
            {
                $tags = $this->searchControllerRepo->getPopularTags();
                $content = $this->searchControllerRepo->getPopularContent();
                $isPopularData = true;
            }

        }


        // if there is no found tags
        $tags = ($tags === []) ? $this->searchControllerRepo->getPopularTags() : $tags;

        // create the proper data format for our view
        // and return this data
        return $this->getDataInProperFormat(
            $content,
            $tags,
            $isPopularData);
    }



    //
    // PRIVATE METHODS
    //

    // this function gets some query string and returns an array of separated words from this query string
    private function parseQueryString(string $query) : array
    {
        $delimiters = [" ", ",", ".", "\"", '|', ":", "#", "?", "-", "_"];

        $preparedString = str_replace($delimiters, $delimiters[0], $query);  // replace all the delimiters with a space
        $queryWordsRaw = explode($delimiters[0], $preparedString);           // explode the string by a space

        $queryWords = array_filter($queryWordsRaw, static function($val) {   // delete all the empty lines ("") from the array
            return $val !== "";
        });


        return array_values($queryWords);
    }

    private function getDataInProperFormat($content, $tags, $isPopularData) : array
    {
        return [
            'content'   => [
                'posts' => $content['posts'] ?? NULL,
                'mods'  => $content['mods'] ?? NULL,
                'memes' => $content['memes'] ?? NULL,
            ],
            'tags'      => $tags,
            'isPopularData' => $isPopularData,
        ];
    }



}
