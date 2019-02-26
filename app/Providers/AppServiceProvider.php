<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('pages.sidebar', function ($view) {
            $view->with('popularPosts', Post::getPopularPost());
            $view->with('featuredPosts', Post::featuredPosts());
            $view->with('recentPosts', Post:: recentPosts());
            $view->with('categories', Category::all());

        });
        view()->composer('admin.layout', function ($view) {
            $view->with('newCommentsCount', Comment::newCommentsCount());
            $view->with('newUsersCont', User::newUsersCont());
            $view->with('PostsCount', Post::PostsCount());
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
