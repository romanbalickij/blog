<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Subscribe\SubsRequest;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subs = Subscription::all();
        return view('admin.subs.index',compact('subs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubsRequest $request)
    {
        Subscription::add($request->get('email'));
        return redirect()->route('subscribers.index');
    }


    public function destroy($id)
    {
        Subscription::findOrfail($id)->delete();
        return redirect()->route('subscribers.index');
    }
}

// статус  користувача
//  бан користучача и  разбан

