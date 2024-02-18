<?php

namespace App\Console\Commands;

use App\Mail\EmailVerifyMail;
use App\Models\User;
use App\Models\Zoom;
use App\Models\ZoomApi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ZoomInvitation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:zoom-invitation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
 
        $zoommeeting = Zoom::all();
        $mytime = Carbon::now();
        foreach($zoommeeting as $meeting){
            $data = json_decode($meeting->data);
            if($data->start_time>=$mytime){
                $startDate = Carbon::parse($mytime);
                $endDate = Carbon::parse($data->start_time);
                $diffInMinutes = $startDate->diffInMinutes($endDate);

                if($diffInMinutes==15){
                    $userid = explode(',',$meeting->user_id);
                    foreach($userid as $id){
                        $users = User::where('id',$id)->first();
                        $usersname = User::where('email',$data->host_email)->first();
                        $details = [
                            "id" =>$data->id,
                            "topic" => $data->topic,
                            "time" => $data->time,
                            "timezone" => $data->timezone,
                            "join_url" => $data->join_url,
                            "pass" => $data->pass,
                            "user" => $usersname->name
                        ];
                        Mail::to($users->email)->send(new EmailVerifyMail($details));
                    }
                  
                }

            }
        }

       
        // return 0;
    }
}
