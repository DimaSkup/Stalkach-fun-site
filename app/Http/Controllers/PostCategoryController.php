<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index(PostCategory $postCategory)
    {
        return view("posts.category.show")->with([
            'category' => $postCategory,
            'categories' => PostCategory::getList(),
            'categoriesNames' => PostCategory::getCategoriesNames(),
            'posts' => $postCategory->posts()->limit(25)->get(),
            'pinnedPosts' => $postCategory->posts()->where('is_pinned', true)->get()
        ]);
    }
}
