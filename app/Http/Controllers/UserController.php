<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->where('type','user')->paginate(10);
        return view('user.index',compact('users'));
    }

    public function edit(User $user){
        return view('user.edit',compact('user'));
    }

    public function update(UserRequest $request , User $user){
        $validated = $request->validated();
        $user->update($validated);
        return redirect('/users');
    }

    public function unban(User $user){
        $user->is_ban = false;
        $user->save();
        return back();
    }

    public function ban(User $user){
        $user->is_ban = true;
        $user->save();
        return back();
    }
}
