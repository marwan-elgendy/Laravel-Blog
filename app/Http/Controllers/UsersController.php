<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Http\Requests\Users\UpdateProfileRequest;

use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(){
        return view('users.index')->with('users',User::all());
    }

    public function makeAdmin(User $user){
        $user->role = 'admin';
        $user->save();
        session()->flash('success','User made admin successfully.');
        return redirect(route('users.index'));
    }

    public function edit(){
        return view('users.edit')->with('user', auth()->user());
    }

    public function update(UpdateProfileRequest $request){
        $user = auth()->user();

        $user->name = $request['name'];
        $user->about = $request['about'];

        $user->save();
        session()->flash('success','User Updated successfully.');
        return redirect()->back();
    }

    public function create(){
        return view('users.create');
    } 


    public function store(request $request){
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->role = $request['role'];
        $user->password = Hash::make($request['password']);

        $user->save();

        session()->flash('success','User Created successfully');

        return redirect(route('users.index'));
    }
}
