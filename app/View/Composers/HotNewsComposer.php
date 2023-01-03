<?php


namespace App\View\Composers;


use App\Models\Repository\PostRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class HotNewsComposer
{
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('hotPosts', PostRepository::getPopularPosts());
    }
}