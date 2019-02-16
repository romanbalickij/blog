<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{

    public function index(){

        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    public function toggle($id){

        $comment = Comment::findOrFail($id);
        $comment->status();
       return redirect()->back();
    }

    public function destroy($id){
       Comment::findOrFail($id)->remove();
       return redirect()->back();
    }
}
