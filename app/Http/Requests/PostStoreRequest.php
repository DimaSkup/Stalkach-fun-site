<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Service\YouTubeVideoService;

use Doctrine\DBAL\Driver\Mysqli\Exception\UnknownType;
use Exception;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

use Illuminate\Contracts\Validation\Validator as MainValidator;
use Illuminate\Validation\Validator;
use Psy\Exception\TypeErrorException;

//use Illuminate\Support\Facades\Validator;

class PostStoreRequest extends FormRequest
{
    public const PARAMS = [
        // title params
        'titleMinSize' => 5,
        'titleMaxSize' => 100,

        // text params
        'textMinSize' => 10,
        'textMaxSize' => 1000,

        // description params
        'descMinSize' => 10,
        'descMaxSize' => 254,

        // avatar params
        'avatarMinWidth'    => 200,
        'avatarMinHeight'   => 100,

        // post image params
        'postImageMaxSize'  => 10000,
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    // here we prepare some data before using of our validation rules
    protected function prepareForValidation(): void
    {
        $videoId = null;

        // if there was passed a correct video link and a "video" type was chosen
        if ($this->input('type') === 'video' && $this->input('video_link') !== null)
        {
            $videoId = YouTubeVideoService::getIdByLink($this->input('video_link'));
        }

        $this->merge([
            'video_id' => $videoId,
        ]);
    }



    // 1.   According to the particular condition we add
    //      some validation hooks to this form request
    // 2.   This method receives the the fully constructed validator,
    //      allowing you to call any of its methods before the validation rules are
    //      actually evaluated
    public function withValidator(Validator $validator): void
    {
        $isTypeOrCategoryCorrect = $validator->errors()->hasAny(['type', 'category']);

        // this array has empty values if we create a new post
        // or has some post values if we want to edit the post
        $postDataBeforeEdit =
        [
            'title'         => $this->post,
            'image'         => $this->file(),
            'video_link'    => $this->video_link,
        ];

        if (!$isTypeOrCategoryCorrect)      // if there are no errors about type or category
        {
            // if we want to create or edit a usual post (not video post)
            if ($this->input('type') !== Post::TYPE_VIDEO)
            {
                $this->addAdditionalUsualPostValidationRules($validator, $postDataBeforeEdit);
            }
            else
            {
                $this->addAdditionalVideoPostValidationRules($validator, $postDataBeforeEdit);
            }
        }
    }


    // this function is called when the validation is passed successfully
    public function passedValidation()
    {
        $validator = $this->getValidatorInstance();
        //dd($validator);
        //dd("successful validation:", $validator->validated());
    }

    // this function is called when the validation is failed
    public function failedValidation(MainValidator $validator)
    {
        //return $validator->errors();
        //dd($validator);
        //dd("failed Validation:", $validator->errors());
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // input data validation parameters
        return [
            'type'          => 'in:'. implode(",", Post::getTypes()->all()),

            'video_link'    => 'exclude_unless:type,video|url',


            //'image'         => "exclude_if:type,video|mimes:jpeg,jpg,png,gif|max:{$this->params['postImageMaxSize']}",
            'avatar'        => "nullable|image|dimensions:".
                                "min_width={$this::PARAMS['avatarMinWidth']},".
                                "min_height={$this::PARAMS['avatarMinHeight']}",
            'tags'          => 'nullable|string',
        ];
    }

    // returns an array which contains translation keys of validation errors
    public function messages(): array
    {

        return [
            'required'              => "Please, provide a post :attribute",

            'title.min'             => "The title must consist of at least {$this::PARAMS['titleMinSize']} characters",
            'title.max'             => "The title cannot be longer than {$this::PARAMS['titleMaxSize']} characters",
            'title.unique'          => "There is a duplicated value in :attribute. Please, provide an another one",

            'text.min'              =>  "The text must consist of at least {$this::PARAMS['textMinSize']} characters",
            'text.max'              =>  "The text cannot be longer than {$this::PARAMS['textMaxSize']} characters",

            'video_link.exclude_unless'   => "Please, provide a video link",
            'video_link.url'        => "Please, provide a correct video link",
            'video_id.unique'       => "The post with such a video has already created. 
                                        Please, provide a different link",

            'image.required'        => "Please, provide an image",
            'image.image'           => "Please, provide a correct image",
            'image.max'             => "The image can't have size more than {$this::PARAMS['postImageMaxSize']}!",
        ];
    }






    // -----------------------------------
    //      PRIVATE METHODS
    // -----------------------------------
    private function addAdditionalUsualPostValidationRules(Validator $validator, array $postData): void
    {
        $typesArrayWithoutVideo = Post::getTypes()->all();
        unset($typesArrayWithoutVideo[Post::TYPE_VIDEO]);
        $isThereNotVideoType = array_key_exists($this->input('type'), $typesArrayWithoutVideo);

        $validator->sometimes(
            'title',
            "exclude_if:type,video|string|".
            "min:{$this::PARAMS['titleMinSize']}|max:{$this::PARAMS['titleMaxSize']}|"
            //"unique:App\models\Post,title|". Rule::unique('posts')->ignore($currentPostTitle, 'title')
            ,
            function ($isThereNotVideoType)  {
                return $isThereNotVideoType;
            }
        );
        $validator->sometimes(
            'text',
            "exclude_if:type,video|string|".
            "min:{$this::PARAMS['textMinSize']}|max:{$this::PARAMS['textMaxSize']}",
            function ($isThereNotVideoType)  {
                return $isThereNotVideoType;
            }
        );
        $validator->sometimes(
            'description',
            'nullable|string|'.
            "min:{$this::PARAMS['descMinSize']}|".
            "max:{$this::PARAMS['descMaxSize']}",
            function ($isThereNotVideoType)  {
                return $isThereNotVideoType;
            }
        );


        // 1. In case when we want to create a image or renew it
        // we add rules to validate an image which is passed from the form
        // 2. OR in case when we haven't any image from the form we don't add the rules to validate an image
        if ((!$postData['title']) || ($postData['image']))
        {
            $validator->sometimes(
                'image',
                "exclude_if:type,video|mimes:jpeg,jpg,png,gif|required|max:{$this::PARAMS['postImageMaxSize']}",
                function ($isThereNotVideoType)  {
                    return $isThereNotVideoType;
                }
            );

            // validation of the image
            $validator->after(function ($validator) use ($postData) {
                $image = $postData['image'];
                $imageValidStatus = $this->validateImageFile($image);

                if ($imageValidStatus['status'] === false) // if the image validation failed
                {
                    $validator->errors()->add('image', "There is a mime type error!");
                }
            });
        }
    }

    private function addAdditionalVideoPostValidationRules(Validator $validator, array $postData): void
    {
        $videoIdRuleString = 'exclude_unless:type,video';
        $isCreationVideoPost = $postData['video_link'];
        $videoIdRuleString .= ($isCreationVideoPost) ? "" : "|unique:App\Models\Posts,picture";


        $validator->sometimes(
            'video_id',
            $videoIdRuleString,
            function ($isThereNotVideoType)  {
                return $isThereNotVideoType;
            }
        );
    }

    // here we validate files which are passed as images from the creation/editing form
    private function validateImageFile($imageFile)
    {
        if ($imageFile)
        {
            $imageMimeType = $imageFile->getClientMimeType();
            $imageMimeTypeError = ($imageMimeType === "application/octet-stream" ||
                    $imageMimeType === "text/plain") ?? false;  // check if we have a mime-type error
            if ($imageMimeTypeError)
            {
                return ['status' => false, 'message' => "There is a mime type error!"];
            }

            $rules = ['image' => "mimes:jpeg,jpg,png,gif|max:{$this::PARAMS['postImageMaxSize']}"];
            $imageArray = ['image' => $imageFile];

            // validation of the file
            $validatorForImage = \Illuminate\Support\Facades\Validator::make($imageArray, $rules);

            // if we have some validation errors
            if ($validatorForImage->fails())
            {
                return ['status' => false, 'message' => $validatorForImage->errors()];
            }
        }

        return ['status' => true];
    }

}
