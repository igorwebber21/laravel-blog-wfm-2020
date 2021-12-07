<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

       // dd($request->all());

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) // bcrypt($request->password)
        ]);

        session()->flash('success', 'Регистрация пройдена');

        Auth::login($user);
        return redirect()->home();

    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt([ 'email' => $request->email, 'password' => $request->password ])){
            session()->flash('success', 'You are logged');
            if(Auth::user()->is_admin){
                return redirect()->route('admin.index');
            }
            else{
                return redirect()->home();
            }
        }
        else{
            return redirect()->back()->with('error', 'Incorrect login or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('register.create');
    }

}
