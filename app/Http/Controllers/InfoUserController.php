<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use File, Hash, DB;

class InfoUserController extends Controller
{

    public function create()
    {
        $countries= DB::table('countries')->get();
        
        $user=DB::table('users')
        ->leftJoin('countries','users.country','=','countries.id')
        ->leftJoin('states', 'users.state','=','states.id')
        ->leftJoin('cities', 'users.city','=','cities.id')
        ->where('users.id','=', Auth::user()->id)
        ->select('users.id','users.emp_id','users.name','users.email','users.phone',
                'users.dob','users.emp_id','users.location','users.country','users.state',
                'users.city','users.pin_code','users.blood_group','users.designation',
                'users.about_me','users.profile_pic','countries.name as country_name',
                'countries.id as country_id','states.name as state_name','states.id as state_id',
                'cities.city as city_name','cities.id as city_id')
        ->first();

        return view('user-profile',compact(['user','countries']));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        
        //Validating fields before updating them
        if(Auth::user()->role != 1)
        {
            $attributes = $request->validate([

            'name'=>'required|regex:/^[A-Za-z\s]*$/|max:100', //name field must be alphabets only 
            'dob' => 'required|date|before:'.now()->subYears(18)->toDateString(),
            'location'=>'max:100',
            'country'=>'',
            'state'=>'',
            'city'=>'',
            'pin_code'=>'',
            'designation'=>'max:100',
            'blood_group'=>'',
            'about_me'=>'max:500',
            'profile_pic'=>'mimes:jpeg,png,jpg|max:1024'
            
            ]);
        }
        if(Auth::user()->role == 1)
        {
            $request->validate([

                'name'=>'required|regex:/^[A-Za-z\s]*$/|max:100', //name field must be alphabets only 
                'email'=>'required|email|max:100|unique:users,email,'.auth()->id()

            ]);
            $attributes['email']=  ucfirst($request->input('email'));


        }

        /*Checking if password is not null or empty */
        if($request->input('password') != null || $request->input('password') != "" && $request->input('old_password') != null || $request->input('old_password') != "" )
        {
            $request->validate(['old_password' => 'required']);
            $request->validate(['password' => 'min:6|required_with:password_confirmation|same:password_confirmation|different:old_password']);

            #Match The Old Password
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("error", "Old Password Doesn't match!");
            }

            $attributes['password']= Hash::make($request->input('password'));

        }

        if($request->input('location') != null || $request->input('location') != "" )
        {
            $request->validate(['country'=>'required','state'=>'required','city'=>'required','pin_code'=>'required|digits:6']);
        }

        if($request->input('country') != null || $request->input('country') != "" )
        {
            $request->validate(['location'=>'required','state'=>'required','city'=>'required','pin_code'=>'required|digits:6']);
        }

        if($request->input('pin_code') != null || $request->input('pin_code') != "" )
        {
            $request->validate(['location'=>'required', 'country'=>'required']);
        }

        /* if Request has profile pic */
        if($request->has('profile_pic'))
        {
            /*Deleting old image from directory */
            $user =User::find(Auth::user()->id);
            $image_path = public_path() .'/assets/profile_pic/'.$user->profile_pic;
            File::delete($image_path);

            /* Storing new image into database and directory   */
            $file = $request->file('profile_pic');
            $name = $file->hashName(); // Generate a unique, random name...
            $file->move(public_path('assets/profile_pic'), $name);
            $attributes['profile_pic']= $name;
        }

        $attributes['name']=  ucfirst($request->input('name'));
        User::where('id',Auth::user()->id)->update($attributes);
        
        return redirect('/user-profile')->with('success','Profile updated successfully');
    }
}
