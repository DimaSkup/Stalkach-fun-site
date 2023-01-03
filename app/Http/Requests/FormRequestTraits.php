<?php  ## FORM REQUEST TRAITS

namespace App\Http\Requests;

// contains some useful utils which we use in different FormRequest files
use Illuminate\Support\Facades\App;

trait FormRequestTraits
{
    // here we get translated messages about validation errors
    // translation is executing according to the current locale
    public function getTranslations(\Illuminate\Contracts\Validation\Validator $validator, $replaceParams = []): array
    {
        $errorMessagesBag = $validator->errors()->getMessages(); // get all the error messages
        $currentLocale = App::currentLocale();
        $translatedErrorMessages = [];          // an array of translated messages which we'll return

        // go through each error message and translate it
        foreach ($errorMessagesBag as $key => $messagesByKey) {
            foreach ($messagesByKey as $message) {
                $translatedMessage = __($message, $replaceParams, $currentLocale);   // translate an error message according to the current locale
                $translatedErrorMessages[$key][] = $translatedMessage;
            }
        }

        return $translatedErrorMessages;    // return all the translated messages
    }
}
