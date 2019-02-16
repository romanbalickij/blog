<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ProfileUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function index(){
        $user =  Auth::user();
        return view('pages.profile', compact('user'));
    }

    public function store(ProfileUserRequest $request){
        $user = Auth::user();
        $user->edit($request->all());
        $user->generalPassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->back()->with('profile','Profile has been successfully update');
    }
}
