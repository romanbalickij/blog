<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Post\PostsRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::query()->select('title','id')->get();
        $tags = Tag::query()->select('title','id')->get();
        return view('admin.posts.create', compact('tags','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $post = Post::addPost($request->all());
        $post->uploadImage($request->file('image'));
        $post->addCategoryId($request->get('category_id'));
        $post->addTagsId($request->get('tags'));
        $post->status($request->get('status'));
        $post->toggleFeatured($request->get('is_featured'));

        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::query()->select('title','id')->get();
        $tags = Tag::query()->select('title','id')->get();
        $post->load('tags');

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostsRequest $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request,Post $post)
    {
        $post->edit($request->all());
        $post->uploadImage($request->file('image'));
        $post->addCategoryId($request->get('category_id'));
        $post->addTagsId($request->get('tags'));
        $post->status($request->get('status'));
        $post->toggleFeatured($request->get('is_featured'));
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->remove();

        return redirect()->route('posts.index');
    }
}
