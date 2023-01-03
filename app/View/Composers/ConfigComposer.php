<?php


namespace App\View\Composers;


use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class ConfigComposer
{
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('config', [
            'contentStrings' => [

            ]
        ]);
    }
}