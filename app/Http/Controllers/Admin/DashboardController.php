<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public  function index(){

        $usersCount = User::select('id')->count();
        $subscribersCount = Subscription::select('id')->count();
        $postsCount  = Post::select('id')->count();
        $comentCount = Comment::select('id')->count();
        return view('admin.dashboard',
            compact('usersCount','subscribersCount','postsCount','comentCount'));
    }
}
