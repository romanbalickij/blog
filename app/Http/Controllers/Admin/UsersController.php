<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\User\UsersCreateRequest;
use App\Http\Requests\User\UsersUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Monolog\Handler\SyslogUdp\UdpSocket;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = User::all();
       return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersCreateRequest $request)
    {
        $user  = User::create($request->all());
        $user->generalPassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name'     => 'required|min:3',
            'avatar'   => 'nullable|image',
            'email'    => [
               'required',
               'email',
               Rule::unique('users')->ignore($user->id),
            ],
       ]);

        $user->edit($request->all());
        $user->generalPassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete("uploads/$user->avatar");
        $user->delete();
        return back();
    }
}

