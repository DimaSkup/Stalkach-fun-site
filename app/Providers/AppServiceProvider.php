<?php

namespace App\Providers;

use App\Helpers\FileManager;
use App\Helpers\LocalFileManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FileManager::class, LocalFileManager::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(\Symfony\Component\HttpFoundation\Request  $request)
    {
        View::share('back_addr', $request->server->get('HTTP_REFERER'));


        // variables which we need to be able to change language
        view()->composer('includes.language_switcher', function($view)
        {
            $view->with('current_locale', App::currentLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
