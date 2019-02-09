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
        return view('pages.index', compact('posts'));
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
        $posts = $category->posts()->paginate(3);
        return view('pages.list',compact('category','posts'));
    }
}
