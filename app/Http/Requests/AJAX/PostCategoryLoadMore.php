<?php

namespace App\Http\Requests\AJAX;

use App\Http\Requests\FormRequestTraits;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Validation\Validator;

class PostCategoryLoadMore extends FormRequest
{
    use FormRequestTraits;  // use different utils for this FormRequest

    public static $defaultParams = [
        'type'    => "all",
        'orderBy' => "created_at",
    ];

    // Determine if the user is authorized to make this request.
    public function authorize(): bool
    {
        return true;
    }

    // here we get translated messages about validation errors;
    // the translation process is executing according to the current locale
    public function getTranslatedErrors(): array
    {
        // use the translation function from the FormRequestTraits trait
        return $this->getTranslations($this->validator);
    }

    // the state before a validation
    protected function prepareForValidation(): void
    {
        //dd(__METHOD__, $this->input()); // get all the input params before the validation
        $inputParams = new Collection($this->input());

        // if there is some empty parameter we set it to the default value
        $inputParams['type'] = $inputParams->get('type') ?: self::$defaultParams['type'];
        $inputParams['orderBy'] = $inputParams->get('orderBy') ?? self::$defaultParams['orderBy'];

        $this->merge($inputParams->all());   // set up input params
    }

    // this function is called when the validation is successful
    public function passedValidation()
    {
        //$validator = $this->getValidatorInstance();
        //dd($validator->validated());   // get all the validated params
    }

    // this function is called when the validation is failed
    public function failedValidation(Validator $validator)
    {
        //dd(__METHOD__, $validator->errors());     // get all the validation errors messages
        return $validator->errors();
    }

    public function getValidator(): Validator
    {
        return $this->getValidatorInstance();
    }

    // Get the validation rules that apply to the request.
    public function rules(): array
    {
        // prepare filters for parsing the input params
        $acceptableTypes = Post::getTypes()->push("all")->all();  // get an array of all the posts types + the special "all" type
        $acceptableOrdersBy = ["created_at", "views"];

        return [
            'page'            => "required|int|min:1|",
            'type'            => "nullable|in:" . implode(",", $acceptableTypes),
            'orderBy'         => "nullable|in:" . implode(",", $acceptableOrdersBy),
        ];
    }

    // returns an array which contains translation keys of validation errors
    public function messages(): array
    {
        return [
            'page.required' => "ui.post.category.loadmore.errors.page.required",
            'page.int'      => "ui.post.category.loadmore.errors.page.int",
            'page.min'      => "ui.post.category.loadmore.errors.page.min",

            'type.in'         => "ui.post.category.loadmore.errors.type.in",
            'orderBy.in'      => "ui.post.category.loadmore.errors.orderBy.in",
        ];
    }
}
