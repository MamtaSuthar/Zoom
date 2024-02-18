<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use DB, Hash, Auth;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        
        // $request->validate([
        //     'token' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required|min:8|confirmed',
        // ]);
    
        // $status = Password::reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function ($user, $password) {
        //         $user->forceFill([
        //             'password' => Hash::make($password)
        //         ])->setRememberToken(Str::random(60));
    
        //         $user->save();
    
        //         event(new PasswordReset($user));
        //     }
        // );
    
        // return $status === Password::PASSWORD_RESET
        //             ? redirect('/login')->with('success', __($status))
        //             : back()->withErrors(['email' => [__($status)]]);

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if(DB::table('password_resets')->where('token','=',$request->input('token'))->exists())
        {
            $password= Hash::make($request->input('password'));
            $email= $request->input('email');
            $users= User::where(['email'=>$email])->update(['password'=> $password]);
            $password_resets= DB::table('password_resets')->where(['email'=>$email,'status'=>1])->delete();
            
            return redirect('/login')->with('success','Your password updated successfully');

        }
        else
        {
            Auth::logout();
            return redirect('/login')->with('error','Sorry, your token has been expired ');
        }
    }
}
