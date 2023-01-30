<?php

use App\Http\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;

// ----------------------------------
//        Controllers routes
// ----------------------------------
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ModsController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\Auth\SocialGoogleController;

// AJAX-handlers
use App\Http\Controllers\AJAX\AJAXPostCategoryController;

// learning
use App\Http\Controllers\Patterns\PatternsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// -----------------------------------------
//          DEV ROUTES
// -----------------------------------------
Route::get('/grid', [IndexController::class, 'grid'])->name('grid');
Route::get('/component', [IndexController::class, 'components'])->name('components');
Route::get('/template/{tempKey}', [IndexController::class, 'template'])->name('template');
Route::get('error', [IndexController::class, 'error'])->name('error');

// -----------------------------------------
//          COMMON ROUTES
// -----------------------------------------
Route::get('/', [IndexController::class , 'index'])->name('home');
Route::get('/language/{locale}', [IndexController::class, 'language'])->name('language');
Route::get('search', [SearchController::class, 'searchForm'])->name('search');

// -----------------------------------------
//          POSTS ROUTES
// -----------------------------------------
Route::get('blog', [PostsController::class, 'index'])->name('blog'); // a next main page with the endless list

Route::group(['prefix' => 'post'], static function ($route) {
     Route::middleware('auth')->group(static function($route) {
        $route->get('create', [PostsController::class, 'create'])->name('posts.create');
        $route->get('store/', [PostsController::class, 'store'])->name('posts.store');
        $route->get('edit/{post:slug}', [PostsController::class, 'edit'])->name('posts.edit');
        $route->put('update/{post:slug}', [PostsController::class, 'update'])->name('posts.update');
        $route->get('delete/{post:slug}', [PostsController::class, 'delete'])->name('posts.destroy');
        $route->get('posts/my', [PostsController::class, 'myPosts'])->name('myPosts');  // posts by me
    });

    $route->get('category/loadmore/', [AJAXPostCategoryController::class, 'loadmore'])->name('post.category.loadmore');  // load more posts of this category
    $route->get('category/{post_category:slug}', [PostCategoryController::class, 'index'])->name('post.category');       // posts by particular category
    $route->get('{post:slug}', [PostsController::class, 'show'])->name('posts.show');                                    // a page of single post
});


// -----------------------------------------
//          MODS ROUTES
// -----------------------------------------
Route::get('mods/', [ModsController::class, 'index'])->name('mods');

Route::group(['prefix' => 'mod'], static function ($route) {
    Route::middleware(['auth'])->group(static function($route) {
        $route->get('create', [ModsController::class, 'create'])->name('mods.create');
        $route->post('/store/', [ModsController::class, 'store'])->name('mods.store');
        $route->get('/edit/{mod:slug}', [ModsController::class, 'edit'])->name('mods.edit');
        $route->put('/update/{mod:slug}', [ModsController::class, 'update'])->name('mods.update');
        $route->get('/delete/{mod:slug}', [ModsController::class, 'delete'])->name('mods.destroy');
    });

    $route->get('/{mod:slug}', [ModsController::class, 'show'])->name('mods.show');
});



Route::get('radio', [IndexController::class, 'radio'])->name('radio');

Route::get('contacts',  [InfoController::class, 'contacts'])->name('contacts');
Route::get('cookies',   [InfoController::class, 'cookies'])->name('cookies');
Route::get('privacy',   [InfoController::class, 'privacy'])->name('privacy');
Route::get('terms',     [InfoController::class, 'terms'])->name('terms');

// -----------------------------------------
//         AUTHENTICATION ROUTES
// -----------------------------------------
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

## OAUTH routes ##
Route::get('auth/google', [SocialGoogleController::class, 'redirectToProvider'])
        ->name('auth-google');
Route::get('auth/google/callback', [SocialGoogleController::class, 'handleProviderCallback']);


// -----------------------------------------
//          DOCUMENTATION
// -----------------------------------------
Route::get('documentation', [DocumentationController::class, 'index'])->name('documentation');
Route::get('documentation/{path}', [DocumentationController::class, 'show'])->name('documentation.show');

// -----------------------------------------
//  LEARNING (I CAN FORGET ABOUT THIS ROUTES)
// -----------------------------------------
Route::get('patterns/decorator', [PatternsController::class, 'decorator']);

