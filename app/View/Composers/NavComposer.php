<?php


namespace App\View\Composers;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class NavComposer
{
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('menu', $this->menu());
        $view->with('services', $this->services());
    }

    protected function menu(): Collection
    {
        $collection = new Collection([
            'home' => [
                'url' => route('home'),
                'prefix' => null,
                'title' => 'Home',
                'icon' => 'home',
            ],
            'blog' => [
                'url' => route('blog'),
                'prefix' => '/post',
                'title' => 'Blog',
                'icon' => 'view_list',
            ],
            'mods' => [
                'url' => route('mods'),
                'prefix' => '/mod',
                'title' => 'Mods',
                'icon' => 'unarchive',
            ],
            'media' => [
                'url' => 'template/media.index',
                'prefix' => '/media',
                'title' => 'Media',
                'icon' => 'perm_media',
            ],
        ]);

        return $this->setActiveItem($collection);
    }

    protected function services(): Collection
    {
        return new Collection([
            'radio' => [
                'title' => 'Radio',
                'icon' => 'radio',
            ],
            'bar' => [
                'title' => '100 roentgen',
                'icon' => 'sports_bar',
            ],
        ]);
    }

    protected function setActiveItem($collection): Collection
    {
        $currentUrl = Request::url();
        $currentRoute = Request::route();

        return $collection->map(function ($item) use (&$currentUrl, $currentRoute) {
            $item['active'] = $currentUrl === $item['url'] || ($currentRoute && $currentRoute->getPrefix() === $item['prefix'] ?? false);
            return $item;
        });
    }
}