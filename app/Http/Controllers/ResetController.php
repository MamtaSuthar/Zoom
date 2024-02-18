<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerifyMail;
use DB;
use Str;
use Carbon\Carbon;
use Auth;
// use View;


class ResetController extends Controller
{
    public function create()
    {
        return view('session/reset-password/sendEmail');
        
    }

    public function sendEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        if(User::where('email','=',$request->input('email'))->exists())
        {
            if(DB::table('password_resets')->where('email','=',$request->input('email'))->exists())
            {
                $password_resets= DB::table('password_resets')->update(['email'=> ucfirst($request->input('email')), 'token'=> Str::random(60),'status'=>1, 'created_at'=>now(), 'expired_at'=>now()->addHours(12)]);
                
            }
            else
            {
                $password_resets= DB::table('password_resets')->insert(['email'=> ucfirst($request->input('email')), 'token'=> Str::random(60),'status'=>1, 'created_at'=>now(), 'expired_at'=>now()->addHours(12)]);
            }

            
            $details=DB::table('users')
            ->join('password_resets','users.email','=','password_resets.email')
            ->where('password_resets.email','=',$request->input('email'))
            ->where('password_resets.status','=', 1)
            ->select('users.name','users.email','password_resets.token')
            ->first();

            // return view('emails.forget_password',compact('details'))->render();  
            Mail::to($details->email)->send(new EmailVerifyMail( $details,'emails.forget_password', 'Forget Password'));
            return redirect()->back()->with('success','We have send you a link for Reset Password');

        }
        else
        {
            return redirect()->back()->with('error','Your email address does not exists');
        }

        // dd($request->all());
        // if(env('IS_DEMO'))
        // {
        //     return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t recover your password.']);
        // }
        // else{
        //     $request->validate(['email' => 'required|email']);

        //     $status = Password::sendResetLink(
        //         $request->only('email')
        //     );

        //     return $status === Password::RESET_LINK_SENT
        //                 ? back()->with(['success' => __($status)])
        //                 : back()->withErrors(['email' => __($status)]);
        // }
    }

    public function resetPass($token)
    {
        // dd($token);
        // return view('session/reset-password/resetPassword', ['token' => $token]);
        if(DB::table('password_resets')->where('token','=',$token)->exists())
        {
            $user=DB::table('users')
            ->join('password_resets','users.email','=','password_resets.email')
            ->where('password_resets.token','=',$token)
            ->where('password_resets.status','=', 1)
            ->select('users.name','users.email','password_resets.token','password_resets.expired_at')
            ->first();

            if($user != null)
            {
                $email= $user->email;
                $expiresAt= Carbon::parse($user->expired_at);
            }
            else
            {
                Auth::logout();
                return redirect('/login')->with('error','Sorry, user not found'); 
            }

            if(!$expiresAt->isPast())
            {
                return view('session.reset-password.resetPassword', ['token' => $token, 'email'=> $email]);   
            }
            else
            {
                $password_resets= DB::table('password_resets')->where(['token'=>$token,'status'=>1])->delete();
                Auth::logout();
                return redirect('/login')->with('error','Sorry, your token has been expired ');
            }

        }  
        else
        {
            Auth::logout();
            return redirect('/login')->with('error','Sorry, your token has been expired'); 
        }
    }
}
