<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use DemeterChain\C;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){
        $posts = Post::paginate(3);
        /*
        $popularPosts = Post::orderBy('views','desc')->take(3)->get();
        $featuredPosts = Post::where('is_featured',1)->take(3)->get();
        $recentPosts = Post::orderBy('date','desc')->take(3)->get();
        $categories = Category::all();
*/
        return view('pages.index')->with('posts',$posts);

    }

    public function show($slug){
        $post = Post::where('slug', $slug,'id')->firstOrFail();

        $previousPost = $post->where('id','<',$post->id)
            ->select('id','title','image','slug')
            ->orderby('id','desc')
            ->first();

        $nextPost = $post->where('id','>',$post->id)
            ->select('id','title','image','slug')
            ->first();
        return view('pages.show', compact('post','previousPost','nextPost'));
    }

    public function tag($slug){

        $tag = Tag:: where('slug',$slug)->firstOrFail();
        $posts = $tag->posts()->paginate(3);
        return view('pages.list',compact('tag','posts'));
    }

    public function category($slug){
        $category = Category::where('slug',$slug)->firstOrFail();
        $posts = $category->posts()->paginate(4);
        return view('pages.list',compact('category','posts'));
    }
}
