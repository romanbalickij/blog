<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\UsersLoginRequest;
use App\Http\Requests\Auth\UsersRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function registerForm(){

        return view('auth.register');
    }

    public function register(UsersRegisterRequest $request){
       $user =  User::add($request->all());
       $user->generalPassword($request->get('password'));

       return redirect()->route('login.form');
    }

    public function loginForm(){

        return view('auth.login');
    }

    public function login(UsersLoginRequest $request){

      if(Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ])){
          return redirect('/');
      }
         return redirect()->back()->with('status','Invalid login or password ');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login.form');
    }
}
