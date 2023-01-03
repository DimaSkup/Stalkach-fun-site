<?php

namespace App\Providers;

use App\View\Composers\ConfigComposer;
use App\View\Composers\HotNewsComposer;
use App\View\Composers\LanguageSwitcherComposer;
use App\View\Composers\NavComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Request;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Request $request): void
    {
        View::share('back_addr', $request->server->get('HTTP_REFERER'));

        // variables which we need to be able to change language
        View::composer('includes.language-switcher', LanguageSwitcherComposer::class);
        // variables which we need to be able to js scripts
        View::composer('includes.config-data', ConfigComposer::class);
        // variables for navigation panel
        View::composer('includes.aside', NavComposer::class);

        //
        View::composer('posts.blocks._suggestion-posts-sidebar', HotNewsComposer::class);
    }
}
