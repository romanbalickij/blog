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

    public function show($slug){

        $post = Post::where('slug', $slug,'id')->firstOrFail();
        $previousPost = $post->where('id', '<', $post->id)
            ->select('id', 'title', 'image', 'slug')
            ->orderby('id', 'desc')
            ->first();

        $nextPost = $post->where('id', '>' ,$post->id)
            ->select('id', 'title', 'image', 'slug')
            ->first();

        $post->increaseViews();

        $likesCount = Like::where('post_id','=',$post->id)
            ->select('like')
            ->sum('like');

        return view('pages.show', compact('post',
            'previousPost','nextPost','likesCount'));
    }

    public function likePost(Request $request){
        $likes = Like::all()
            ->where('user_id','=', Auth::user()->id)
            ->where('post_id', '=', $request->post_id )
            ->first();

        if($likes == null){
            $like = new Like();
            $like->user_id = Auth::user()->id;
            $like->post_id = $request->post_id;
            $like->like = $request->isLike;
            $like->save();
        }else{
            $likes->like = $request->isLike;
            $likes->save();
        }
    }

    public function tag($slug){

        $tag = Tag:: where('slug',$slug)->firstOrFail();
        $posts = $tag->posts()->paginate(2);
        return view('pages.list', compact('tag','posts'));
    }

    public function category($slug){
        $category = Category::where('slug' ,$slug)->firstOrFail();
        $posts = $category->posts()->paginate(4);
        return view('pages.list', compact('category','posts'));
    }
}
