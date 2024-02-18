<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Staff};
use App\Http\Requests\UserStoreRequest;
use App\Mail\EmailVerifyMail;
use Illuminate\Support\Facades\Mail;
use DataTables, File, Str, DB, Auth, Hash, Carbon\Carbon;
// use App\Rules\AdultValidationRule;

class StaffController extends Controller
{
 
    /* checking edit permission on edit route */
    public function __construct()
    {
        $this->middleware('CheckEditPermission')->only('edit');

    }
    /**
     * Display list of staff
     */
    public function index()
    {
        $users = User::where('role','=', '0')->get();
        return view('staff.index',compact('users'));
    }

    /**
     * Show the form for add new staff
     */
    public function create()
    {
        $countries= DB::table('countries')->get();
        return view('staff.add_staff',compact('countries'));
    }

    /**
     * Store a newly created staff in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $add_staff = $request->validated();

        $add_staff['name']=  ucfirst($request->input('name'));
        $add_staff['email']=  ucfirst($request->input('email'));
        $add_staff['password']= Hash::make($request->input('password'));
        $add_staff['uuid']= Str::uuid()->toString();
        ;

        
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

        if($request->has('profile_pic'))
        {
            $file = $request->file('profile_pic');
            $name = $file->hashName(); // Generate a unique, random name...
            $file->move(public_path('assets/profile_pic'), $name);
            $add_staff['profile_pic']= $name;
        }
        
        $users= User::create($add_staff);

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
        ->select('users.emp_id','users.name','users.email','users.phone','users.designation','users.location','password_resets.token')
        ->first();

        // return view('emails.account_created',compact('details'))->render();

        //sending mail to user 
        Mail::to($details->email)->send(new EmailVerifyMail( $details, 'emails.account_created', 'Welcome Mail'));

        return redirect('staff')->with('success','Record has been successfully inserted');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing specified staff
     */
    public function edit($id)
    {
        // dd($id);
        $countries= DB::table('countries')->get();

        $user=DB::table('users')
        ->leftJoin('countries','users.country','=','countries.id')
        ->leftJoin('states', 'users.state','=','states.id')
        ->leftJoin('cities', 'users.city','=','cities.id')
        ->where('users.role','=', '0')
        ->where('users.id','=', $id)
        ->select('users.id','users.emp_id','users.name','users.email','users.phone','users.dob','users.emp_id','users.location','users.country','users.state','users.city','users.pin_code','users.blood_group','users.designation','users.about_me','users.profile_pic','countries.name as country_name','countries.id as country_id','states.name as state_name','states.id as state_id','cities.city as city_name','cities.id as city_id')
        ->first();

        // dd($user);
        if($user->id == $id)
        {
            return view('staff.edit_staff',compact(['user','countries']));
        }
        else
        {
            return redirect('staff')->with('error','Record cannot be edited');
        }
    }

    /**
     * Update the specified staff in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $update_staff= $request->validate([
            'emp_id'=>'required|max:100|unique:users,emp_id,'.$id,
            'name'=>'required|regex:/^[A-Za-z\s]*$/|max:80', //name should only contains alphabets
            'email'=>'required|email|max:80|unique:users,email,'.$id, //email must be unique and in proper email format
            'phone'=>'required|digits:10', // phone number must be a number and in between 0-9 
            'location'=>'max:100',
            'country'=>'',
            'state'=>'',
            'city'=>'',
            'pin_code'=>'min:6|max:6',
            'dob' => 'required|date|before_or_equal:'.now()->subYears(18)->toDateString(),
            'designation'=>'max:100',
            'blood_group'=>'',
            'about_me'=>'max:300',
            'profile_pic'=>'mimes:jpeg,png,jpg|max:1024' //profile pic format can be jpeg, png, jpg and max size is 1MB
        ]);

        // dd($update_staff);
        
        $user =User::find($id);

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
            $request->validate(['location'=>'required','country'=>'required']);
        }

        /*Checking if password is not null or empty */
        if($request->input('password') != null || $request->input('password') != "" )
        {
            $request->validate(['password' => 'string|min:8' ]);
            $update_staff['password']= Hash::make($request->input('password'));
        }
        
        /* if Request has profile pic */
        if($request->has('profile_pic'))
        {
            /* Deleting old image from directory */
            $user =User::find($id);
            $image_path = public_path() .'/assets/profile_pic/'.$user->profile_pic;
            File::delete($image_path);

            /* Storing new image into database and directory   */
            $file = $request->file('profile_pic');
            $name = $file->hashName(); // Generate a unique, random name...
            $file->move(public_path('assets/profile_pic'), $name);
            $update_staff['profile_pic']= $name;
        }

        $update_staff['name']=  ucfirst($request->input('name'));
        $update_staff['email']=  ucfirst($request->input('email'));
        
        $users= User::find($id)->update($update_staff);

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
        ->select('users.emp_id','users.name','users.email','users.phone','users.designation','users.location','password_resets.token')
        ->first();

        // return view('emails.account_updated',compact('details'))->render();

        //sending mail to user
        Mail::to($details->email)->send(new EmailVerifyMail( $details, 'emails.account_updated', 'Account Updated')); 

        return redirect('staff')->with('success','Record has been successfully updated');
    }

    /**
     * Remove the specified staff from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $user =User::find($id);

        /* getting image path and checking if image path exists if it exists then delete image from path */
        $image_path= public_path() . '/assets/profile_pic/'.$user->profile_pic; 
        if(File::exists($image_path)) 
        {
            File::delete($image_path);
        }
        
        $users= User::destroy($id);
        return response()->json([
             'data'=>'success'
        ]);
        // return redirect('staff')->with('success','Record Deleted');
        
    }

    /**
     * Terminate Staff and Rejoin Staff
     */ 
    public function terminate($id)
    {

        $user= User::find($id);
        if($user->terminated == 0)
        {
            $user->terminated = 1;
            $user->update();
            return redirect('staff')->with('error','Staff Terminated');
        }
        else
        {
            $user->terminated = 0;
            $user->update();
            return redirect('staff')->with('success','Staff Rejoined'); 
        }
        
    }

    public function getData(Request $request)
    {
        // dd('hello');
        if ($request->ajax()) {
            $data = User::where('role','=', '0')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('role', function () {
                    return '<td>staff</td>';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<td>
                    <a href="javascript:;" class="edit btn join " id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">View</a>

                    <ul class="dropdown-menu dropdown-menu-end drpdwn-menu" aria-labelledby="dropdownMenuButton">
                        <div class="d-flex flex-row">
                            <div class="col">
                                 <li class="mb-2 li_itemx">
                                    <a href="staff/'.$row->id.'/edit" class="link-primary" ><button class="btn-class"><i class="fas fa-user-edit text-secondary btn-hover"></i></button></a>
                                </li>
                            </div>
                            <div class="col">
                                 <li class="mb-2 li_itemx">
                                    <button id="delete-btn" class="btn-class" data-id="'.$row->id.'"><i  class="cursor-pointer fas fa-trash text-secondary btn-class" ></i></button>
                                </li>
                            </div>
                            <div class="col">
                                 <li class="mb-2 li_itemx">
                                    <button type="button" class="btn-class" data-bs-toggle="modal" data-bs-target="#profile'.$row->id.'"><i  class="cursor-pointer fas fa-eye text-secondary btn-class" ></i></button>
                                </li>
                            </div>
                            <div class="col">';

                                if($row->terminated == 0)
                                {  $actionBtn.='
                                 <li class="mb-2 li_itemx">
                                    <a href="terminate/'.$row->id.'"><button type="button" class="btn-class"><i  class="cursor-pointer fas fa-check text-secondary" ></i></button></a>
                                </li>
                                ';
                                }else{ $actionBtn.='
                                 <li class="mb-2 li_itemx">
                                    <a href="terminate/'.$row->id.'"><button type="button" class="btn-class"><i  class="cursor-pointer fas fa-window-close text-secondary" ></i></button></a>
                                </li>
                                '; } $actionBtn.='
                            </div>
                        </div>
                    </ul>
            </td>';
                    return $actionBtn;
                })
                ->rawColumns(['action','role'])
                ->make(true);
        }
    }

    public function resetPass($token)
    {
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
                return view('staff.resetPassword', ['token' => $token, 'email'=> $email]);   
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

    public function changePassword(Request $request)
    {
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

            $user=User::where('email',$email)->first();
            Auth::login($user); 
            return redirect('/dashboard')->with('success','You are logged in.');

        }
        else
        {
            Auth::logout();
            return redirect('/login')->with('error','Sorry, your token has been expired ');
        }
 
    }

    public function getState($id)
    {
        // dd($id);
        $states = DB::table('states')->where('country_id', '=', $id)->get();

        return response()->json([
            'data'=> $states,
            'message'=>'List of States'
        ]);

    }

    public function getCity($id)
    {
        // dd($id);
        $cities = DB::table('cities')->where('state_id', '=', $id)->get();

        return response()->json([
            'data'=> $cities,
            'message'=>'List of Cities'
        ]);

    }
    
}
