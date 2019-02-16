<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentsRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function store(CommentsRequest $request){

       Comment::create([
          'text'    => $request->get('text'),
          'user_id' => Auth::user()->id,
          'post_id' => $request->get('post_id')
      ]);
      return redirect()->back()->with('status','Ваший коментарій скоро буде добавлений ');
    }
}
