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

use Illuminate\Contracts\Validation\Validator as MainValidator;
use Illuminate\Validation\Validator;
use Psy\Exception\TypeErrorException;

//use Illuminate\Support\Facades\Validator;

class PostUpdateRequest extends FormRequest
{
    public array $params = [
        // title params
        'titleMinSize' => 5,
        'titleMaxSize' => 50,

        // text params
        'textMinSize' => 10,
        'textMaxSize' => 1000,

        // avatar params
        'avatarMinWidth'    => 100,
        'avatarMinHeight'   => 200,

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
    public function withValidator(MainValidator $validator)
    {
        $isTypeOrCategoryCorrect = $validator->errors()->hasAny(['type', 'category']);

        if (!$isTypeOrCategoryCorrect)      // if there are no errors about type or category
        {
            // if we chose some post type, but it is not a video type
            // we add some rules according to this condition
            $typesArrayWithoutVideo = Post::getTypes();
            unset($typesArrayWithoutVideo[Post::TYPE_VIDEO]);
            $isThereNotVideoType = array_key_exists($this->input('type'), $typesArrayWithoutVideo);

            $validator->sometimes(
                'title',
                "exclude_if:type,video|string|
                min:{$this->params['titleMinSize']}|max:{$this->params['titleMaxSize']}|
                unique:App\Models\Posts,title",
                function ($isThereNotVideoType)  {
                    return $isThereNotVideoType;
                }
            );
            $validator->sometimes(
                'text',
                "exclude_if:type,video|string|
                min:{$this->params['textMinSize']}|max:{$this->params['textMaxSize']}",
                function ($isThereNotVideoType)  {
                    return $isThereNotVideoType;
                }
            );
            $validator->sometimes(
                'description',
                'nullable|string',
                function ($isThereNotVideoType)  {
                    return $isThereNotVideoType;
                }
            );
             $validator->sometimes(
                 'image',
                 "exclude_if:type,video|mimes:jpeg,jpg,png,gif|required|max:{$this->params['postImageMaxSize']}",
                 function ($isThereNotVideoType)  {
                     return $isThereNotVideoType;
                 }
             );

            // validation of the image
             $validator->after(function ($validator) {
                 $image = $this->file('image');
                 $imageValidStatus = $this->validateImageFile($image);

                 if ($imageValidStatus['status'] === false) // if the image validation failed
                 {
                     $validator->errors()->add('image', "There is a mime type error!");
                 }
             });

        }
    }


    // this function is called when the validation is passed successfully
    public function passedValidation()
    {
        //$validator = $this->getValidatorInstance();
        //dd($validator);
        //dd("successful validation:", $validator->validated());
    }

    // this function is called when the validation is failed
    public function failedValidation(MainValidator $validator)
    {
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
            'type'          => 'in:'. implode(",", Post::getTypes()),

            'video_link'    => 'exclude_unless:type,video|url',
            'video_id'      => 'exclude_unless:type,video|unique:App\Models\Posts,picture',

            //'image'         => "exclude_if:type,video|mimes:jpeg,jpg,png,gif|max:{$this->params['postImageMaxSize']}",
            'avatar'        => "nullable|image|dimensions:
                                min_width={$this->params['avatarMinWidth']},
                                min_height={$this->params['avatarMinHeight']}",
            'tags'          => 'nullable|string',
        ];
    }

    public function messages(): array
    {

        return [
            'required'              => "Please, provide a post :attribute",

            'title.min'             => "The title must consist of at least {$this->params['titleMinSize']} characters",
            'title.max'             => "The title cannot be longer than {$this->params['titleMaxSize']} characters",
            'title.unique'          => "There is a duplicated value in :attribute. Please, provide an another one",

            'text.min'              =>  "The text must consist of at least {$this->params['textMinSize']} characters",
            'text.max'              =>  "The text cannot be longer than {$this->params['textMaxSize']} characters",

            'video_link.exclude_unless'   => "Please, provide a video link",
            'video_link.url'        => "Please, provide a correct video link",
            'video_id.unique'       => "The post with such a video has already created. 
                                        Please, provide a different link",

            'image.required'        => "Please, provide an image",
            'image.image'           => "Please, provide a correct image",
            'image.max'             => "The image can't have size more than {$this->params['postImageMaxSize']}!",
        ];
    }



    // here we validate a file which passed as image from the form
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

            $rules = ['image' => "mimes:jpeg,jpg,png,gif|max:{$this->params['postImageMaxSize']}"];
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
