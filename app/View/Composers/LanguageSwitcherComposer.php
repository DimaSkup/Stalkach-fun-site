<?php


namespace App\View\Composers;


use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class LanguageSwitcherComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('currentLocale', App::currentLocale());
        $view->with('availableLocales', config('app.available_locales'));
    }
}