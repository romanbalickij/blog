<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscribe\SubsRequest;
use App\Mail\SubscribeEmail;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class SubsController extends Controller
{

    public function subscribe(SubsRequest $request)
    {
        $subs = Subscription::add($request->get('email'));
        $subs->generateToken();
        \Mail::to($subs)->send(new SubscribeEmail($subs));

       return redirect()->back()->with('status', 'Check your mail');

    }

    public function verify($token){
      $subs = Subscription::where('token', $token)->firstOrFail();
      $subs->token = null;
      $subs->save();

      return redirect('/')->with('status', 'Your mail has been verified');
    }
}
