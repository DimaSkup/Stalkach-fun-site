<?php

namespace App\Http\Requests\Mod;

use App\Helpers\Utils;
use App\Http\Requests\FormRequestTraits;
use App\Models\Mod;
use App\Service\YouTubeVideoService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use \Illuminate\Support\Facades\Validator as FacadesValidator;
use Symfony\Component\HttpFoundation\JsonResponse;

class StoreRequest extends FormRequest
{
    use FormRequestTraits;  // use different utils for this FormRequest

    public const PARAMS = [
        // name params
        'nameMinSize' => 5,
        'nameMaxSize' => 100,

        // description params
        'descMinSize' => 10,
        'descMaxSize' => 254,

        // images params
        'imageMaxSize'      => 10000,
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    // here we get translated messages about validation errors
    // translation is executing according to the current locale
    public function getTranslatedErrors(): array
    {
        // use the translation function from the FormRequestTraits trait
        return $this->getTranslations($this->validator, self::PARAMS);
    }

    // here we prepare some data before using of our validation rules
    protected function prepareForValidation(): void
    {
       // Utils::dd($this->input());
    }

    // additional validation of some data
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator)
        {
            $videoIdOk = true;
            $downloadLinksOk = true;
            $imagesValidationResults = true;

            // set errors messages
            if (!$videoIdOk) { $validator->errors()->add('video_link', "modification.create.video_link.error.get_id"); }
            if (!$downloadLinksOk) { $validator->errors()->add('download_links', "modification.create.download_links.error.common.empty"); }
            //if ($imagesValidationResults) { $validator->errors()->add('images', $imagesValidationResults); }
        });
    }


    public function passedValidation()
    {
        return new JsonResponse(['kek' => 'GOOD']);
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return $validator->errors();
    }

    public function getValidator(): \Illuminate\Contracts\Validation\Validator
    {
        return $this->getValidatorInstance();
    }


    // Get the validation rules that apply to the request.
    public function rules(): array
    {
        $rules = [
            // text fields validation rules
            'name'          => "required|".
                               "string|".
                               "min:{$this::PARAMS['nameMinSize']}|".
                               "max:{$this::PARAMS['nameMaxSize']}".
                               "unique:App\Models\Mods,name|",
            'description'   => "required|".
                               "string|".
                               "min:{$this::PARAMS['descMinSize']}|".
                               "max:{$this::PARAMS['descMaxSize']}",
            'presentation'  => "required|".
                               "string|".
                               "min:{$this::PARAMS['descMinSize']}|".
                               "max:{$this::PARAMS['descMaxSize']}",
            'tags'          => "nullable|string",

            // images validation rules
            'main_image'    => "mimes:jpg,jpeg,png,bmp,gif,svg,webp|".
                               "max:{$this::PARAMS['imageMaxSize']}",
            'screenshots'   => "array|between:3,10",

            // validation rules for video links
            'trailer_video'    => "nullable|url",
            'review_video'     => "nullable|url",

            // validation rules for other links
            'custom_links'     => "string",
            'society_links'    => 'array|between:1,10',

            // selectors validation rules
            'game'           => "in:" . implode(",", array_keys(Mod::GAME)),
        ];

        // for each type of download source we add validation rules
        foreach (Mod::DOWNLOAD_SOURCES as $downloadSource)
        {
            $rules[$downloadSource] = "nullable|url";
        }

        return $rules;
    } // rules()

    // returns an array which contains translation keys of validation errors
    public function messages(): array
    {
        return [
            // name, description and tags messages
            "name.required"         => "modification.create.name.error.empty",
            "name.string"           => "modification.create.name.error.type",
            "name.min"              => "modification.create.name.error.min",
            "name.max"              => "modification.create.name.error.max",
            "name.unique"           => "modification.create.name.error.unique",

            "description.required"  => "modification.create.description.error.empty",
            "description.string"    => "modification.create.description.error.type",
            "description.min"       => "modification.create.description.error.min",
            "description.max"       => "modification.create.description.error.max",

            "tags"                  => "modification.create.tags.error.type",

            // images messages
            "images.mime"           => "modification.create.images.both.error.type",
            "main_image.mime"       => "modification.create.images.main_image.error.type",
            "main_image.max"        => "modification.create.images.main_image.error.max",
            "screenshots.mime"      => "modification.create.images.screenshots.error.type",
            "screenshots.max"       => "modification.create.images.screenshots.error.max",
            "screenshots.between"   => "modification.create.images.screenshots.error.range",

            // video link messages
            "video_link.url"        => "modification.create.video_link.error.invalid",
            "video_link.required"   => "modification.create.video_link.error.empty",
            "video_id.unique"       => "modification.create.video_link.error.unique",

            // game version
            "game.in"               => "modification.create.game_version.error.invalid",

            // download sources messages
            'google_drive_disk.url' => "modification.create.download_links.error.google.url",
            'yandex_disk.url'       => "modification.create.download_links.error.yandex.url",
            'cloud_mail_disk.url'   => "modification.create.download_links.error.mail.url",


        ];
    } // messages()


    // get an instance of the current modification
    public function getCurrentModification(): Mod
    {
        //dd(__METHOD__,Mod::where('slug', \Illuminate\Support\Str::slug($this->slug))->first());
        return Mod::where('slug', \Illuminate\Support\Str::slug($this->slug))->first();
    }
}
