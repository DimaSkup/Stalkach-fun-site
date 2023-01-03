<?php

namespace App\Http\Requests\Mod;

use App\Models\Mods;
use Illuminate\Validation\Rule;

class UpdateRequest extends StoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currentMod = $this->getCurrentModification();

        return array_merge(parent::rules(), [
            'name' =>
                [
                    "required", "string",
                    "min:{$this::PARAMS['nameMinSize']}|",
                    "max:{$this::PARAMS['nameMaxSize']}",
                    Rule::unique(Mods::class, "name")->ignore($currentMod)
                ],
            'main_image'    =>
                [
                    "mimes:jpg,jpeg,png,bmp,gif,svg,webp",
                    "max:{$this::PARAMS['imageMaxSize']}",
                    Rule::requiredIf(function() {
                        return array_key_exists('main_image', $this->files->all());
                    }),
                ],
            'video_id' =>
                [
                    "string",
                    Rule::unique(Mods::class, "video_id")->ignore($currentMod)
                ],
        ]);
    } // rules()

    // validates only screenshots because we get an array of screenshots from the form
    // doesn't validate a main image because it will be validated later using rules
    public function validateImages(): string
    {
        $images = $this->files->all();   // get an array of screenshots images

        // we'll return this array as a result of images validation
        $errorMessage = "modification.create.images.both.error.common";

        // we need to get from the form both main_image and some screenshots
        if (is_array($images))
        {
            // validation of the main image is absent here because this image
            // will be validated later using validation rules (see the rules() function)
            // ...

            // validation of the screenshots
            if (array_key_exists('screenshots', $images))
            {
                foreach ($images['screenshots'] as $screenshot)
                {
                    // we need to validate each screenshot image separately because we
                    // get an array of images from the form
                    if (!$this->validateSingleImage($screenshot, $errorMessage, 'screenshot'))
                    {
                        return $errorMessage;
                    }
                }
            }
            // if everything is ok
            $errorMessage = "";
        }

        return $errorMessage;
    } // validateImages


}
