<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        $remember_me = $request->has('remember_me') ? true : false;
        // dd($remember_me);

        // $check = $request->only('username', 'password');
        if(Auth::attempt($attributes, $remember_me))
        {
            session()->regenerate();
            return redirect('dashboard')->with(['success'=>'You are logged in Successfully.']);
        }
        else{

            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out Successfully .']);
    }
}
