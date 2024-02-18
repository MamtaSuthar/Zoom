<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{Leave, User};
use Auth;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            $auth=Auth::user();
            if($auth)
            {
                if(Auth::user()->role == 1)
                {
                    $leaves = DB::table('leaves')
                    ->join('users', 'leaves.applied_user_id', '=', 'users.id')
                    ->select('leaves.id','users.name','leaves.reason','leaves.start_date','leaves.end_date','leaves.leave_type', 'leaves.status','leaves.created_at','users.profile_pic')
                    ->where('status','=', '0')
                    ->get();

                    $view->with('leave_notifications',$leaves );
                }
                else
                {
                    $leaves= Leave::where('status','=', '1')->where('mark','=', '0')->where('applied_user_id','=', Auth::id())->orWhere('status','=', '2')->where('mark','=', '0')->where('applied_user_id','=', Auth::id())->orWhere('status','=', '3')->where('mark','=', '0')->where('applied_user_id','=', Auth::id())->get();
                    // view()->share('leaves',$leaves);
                    $view->with('leave_notifications',$leaves );
                }
            }
        });

    }
}
