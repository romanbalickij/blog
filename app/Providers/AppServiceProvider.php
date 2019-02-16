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

        view()->composer('pages.sidebar',function ($view){
            $view->with('popularPosts', Post::getPopularPost());
            $view->with('featuredPosts', Post::where('is_featured',1)->take(3)->get());
            $view->with('recentPosts', Post::orderBy('date','desc')->take(3)->get());
            $view->with('categories', Category::all());

        });

        view()->composer('admin.layout',function ($view){
            $view->with('newCommentsCount', Comment::where('status',0)->count());
            $view->with('newUsersCont', User::where('status',1)->count());
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
