<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index(){

        $posts = Post::where('status',1)->paginate(3);

        return view('pages.index')->with('posts', $posts);

    }

    /**d
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {

        $post = Post::where('slug', $slug, 'id')->firstOrFail();

        $previousPost = $post->where('id', '<', $post->id)
            ->select('id', 'title', 'image', 'slug')
            ->orderby('id', 'desc')
            ->first();

        $nextPost = $post->where('id', '>', $post->id)
            ->select('id', 'title', 'image', 'slug')
            ->first();
        $post->increaseViews();

        return view('pages.show', compact('post',
            'previousPost', 'nextPost'));
    }

    public function tag($slug){

        $tag = Tag:: where('slug',$slug)->firstOrFail();
        $posts = $tag->posts()->paginate(2);
        return view('pages.list', compact('tag','posts'));
    }

    public function category($slug){
        $category = Category::where('slug' ,$slug)->firstOrFail();
        $posts = $category->posts()->paginate(2);
        return view('pages.list', compact('category','posts'));
    }
}








