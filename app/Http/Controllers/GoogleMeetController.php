<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoogleMeet;
use App\Models\joinChat;
use OpenTok\OpenTok;
use OpenTok\MediaMode;
use Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Models\Zoom;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerifyMail;




class GoogleMeetController extends Controller
{
    public function googlemeet(Request $request)
    {
        $valid = $request->validate([
            'meetingtime' => 'required|after_or_equal:now',
        ]);

        $time = $request->meetingtime;
        return view('googlemeet.meet', compact('time'));
    }

    public function googlechat(Request $request)
    {
        // initialze api using api key/secret
        $openTokAPI = new OpenTok(env('OPENTOK_API_KEY'), env('OPENTOK_API_SECRET'));

        $session_token = $openTokAPI->createSession(array('mediaMode' => MediaMode::ROUTED));
        $session = $session_token->getSessionId();

        //  now, that we have session token we generate opentok token
        $opentok_token = $openTokAPI->generateToken($session, [
            'exerciseireTime' => time() + 60,
            'data'       => "Some sample metadata to pass"
        ]);

        $createdBy = auth()->user()->id;
        $is_session_active = 0;
        $currenturl = env('GOOGLE_URL');
        // $currenturl = "http://localhost/laravel-common-platformaachuki/chatpage?room=";

        $randomLink = Str::random(10);
        $randomLinkWithHyphens = substr($randomLink, 0, 3) . '-' . substr($randomLink, 4, 4) . '-' . substr($randomLink, 7, 3);
        $meet_link = $currenturl . $randomLinkWithHyphens;
        $data = GoogleMeet::create([
            'session_id'         => $session ?? null,
            'token'              => $opentok_token ?? null,
            'created_by'         => $createdBy ?? null,
            'is_session_active'  => $is_session_active ?? null,
            'meet_link'          => $meet_link ?? null,
            'meetingtime'        => $request->meetingtime,
        ]);
        if (request()->isMethod('POST')) {
            return response()->json(['data' => $data]);
        } else {
            $data = new joinChat();
            $data->meet_link = $meet_link;
            $data->save();
            return Redirect::to(url('chatpage' . '?room=' . $randomLinkWithHyphens));
        }
    }

    public function chatpage(Request $request)
    {
        if (request()->isMethod('GET')) {
            return view('googlemeet.form');
        } elseif (request()->isMethod('POST')) {
            $user_name = joinChat::where('username', $request->username)->where('meet_link', $request->url)->first();

            if ($request->username != null) {
                // if ($user_name == null) {
                $data = new joinChat();
                $data->meet_link = $request->url;
                $data->username =  $request->username;
                $data->user_id = auth()->user()->id;
                $data->save();

                $data = GoogleMeet::where('meet_link', $request->url)->first();
                $session_token = $data->session_id;
                $opentok_token = $data->token;

                return view('googlemeet.chat', [
                    'session_token' => $session_token,
                    'opentok_token' => $opentok_token,
                    'username' => $request->username,
                    'meet_link' => $request->url,
                ]);
            } else {
                return redirect()->back();
            }
        }
    }

    public function meet()
    {
        $mytime = Carbon::now();
        $googleMeet = GoogleMeet::where('meetingtime', '>', $mytime)->orderBy('id', 'desc')->get();
        $previousgoogleMeet = GoogleMeet::where('meetingtime', '<', $mytime)->orderBy('id', 'desc')->get();
        $livegoogleMeet = GoogleMeet::where('meetingtime', '=', $mytime)->orderBy('id', 'desc')->get();

        return view('googlemeet.table', compact('googleMeet', 'previousgoogleMeet', 'livegoogleMeet'));
    }


    public function googleDeleteRecord($id)
    {
        $user = GoogleMeet::where('id', $id)->first();

        $users = array_filter(explode(',', $user->user_id));
        foreach ($users as $us) {
            $email = User::where('id', $us)->first();

            $dateTime = new DateTime($user->meetingtime);
            $dateTime->setTimeZone(new DateTimeZone('UTC'));
            $date = $dateTime->format('Y-m-d');
            $time = $dateTime->format('h:i A');

            $details = [
                "type" => 'delete',
                "id" => $user->id,
                "date" => $date,
                "time" => $time,
                "join_url" => $user->meet_link,
                "user" => ucfirst(Auth::user()->name)
            ];

            $view = "emails.Email";
            $subject = "Google Meeting Cancellation";

            Mail::to($email->email)->send(new EmailVerifyMail($details,  $view, $subject));
        }
        $record = $user->delete();
        return redirect()->back()->with('error', 'Meeting Deleted Successfully');
    }

    public function googleEditBlade(Request $request)
    {
        $data = GoogleMeet::where('id', $request->id)->first();
        $dateTime = new DateTime($data->meetingtime);
        $dateTime->setTimeZone(new DateTimeZone('UTC'));
        $date = $dateTime->format('d-m-Y h:i A');
        $data['date'] = $date;
        return [
            'data'    => $data,
        ];
    }

    public function updateGooglemeeting(Request $request)
    {
        $validated = $request->validate([
            'meetingtime' => 'required|after_or_equal:now',
        ]);

        $data = GoogleMeet::where('id', $request->id)->update(['meetingtime' => $validated['meetingtime']]);
        $data = GoogleMeet::where('id', $request->id)->first();
        $users = GoogleMeet::where('id', $request->id)->first();
        $users = array_filter(explode(',', $users->user_id));
        if (!empty($users)) {
            foreach ($users as $user) {
                $email = User::where('id', $user)->first();
                $dateTime = new DateTime($data['meetingtime']);
                $dateTime->setTimeZone(new DateTimeZone('UTC'));
                $date = $dateTime->format('Y-m-d');
                $time = $dateTime->format('h:i A');
                $details = [
                    "type" => 'edit',
                    "id" => $data['id'],
                    "date" => $date,
                    "time" => $time,
                    "join_url" => $data['meet_link'],
                    "user" => ucfirst(Auth::user()->name)
                ];

                $view = "emails.Email";
                $subject = "Google Meeting Update";
                $a = Mail::to($email->email)->send(new EmailVerifyMail($details, $view, $subject));
            }
        }
        return [
            'status' => 1,
            'data'    =>  $data
        ];
    }

    public function googleMeetinvitaion(Request $request)
    {
        $id = $request->id;
        $data = GoogleMeet::where('google_meets.id', $id)->first();
        $user = User::where('id', '!=', Auth::user()->id)->get();
        $user_data = array();

        foreach (explode(',', $data->user_id) as $d) {
            $userdata = User::where('id', $d)->first();
            array_push($user_data, $userdata);
        }
        $user_data = array_filter($user_data);

        return [
            'data'    => $data,
            'user'    => $user,
            'user_data' => $user_data
        ];
    }

    public function googleMeetaddinvit(Request $request)
    {
        $meetinglink = GoogleMeet::where('id', $request->meetingId)->first();
        $user = explode(',', $meetinglink->user_id);

        if (in_array($request->user, $user)) {
            return [
                'msg'    => 'Id Already Exists !',
                'data'   => '',
            ];
        } else {
            $user = $meetinglink->user_id . "," . $request->user;
            GoogleMeet::where('id', $request->meetingId)->update(['user_id' => $user]);

            $userdetail = User::where('id', $request->user)->first();
            $dateTime = new DateTime($request->time);
            $dateTime->setTimeZone(new DateTimeZone('UTC'));
            $date = $dateTime->format('Y-m-d');
            $time = $dateTime->format('h:i A');
            $details = [
                "type" => 'add',
                "date" => $date,
                "time" => $time,
                "join_url" => $request->join_url,
                "user" => ucfirst(Auth::user()->name)
            ];

            $view = "emails.Email";
            $subject = "Google Meeting Invitation";
            $a = Mail::to($userdetail->email)->send(new EmailVerifyMail($details, $view, $subject));

            return [
                'msg'    => 'New Data Added Succesfully !',
                'data'   => $userdetail,
            ];
        }
    }

    public function googleMeetDelmembers(Request $request)
    {
        $google = GoogleMeet::where('id', $request->zoomid)->first();
        $userdetail = User::where('id', $request->id)->first();
        $dateTime = new DateTime($google->meetingtime);
        $dateTime->setTimeZone(new DateTimeZone('UTC'));
        $date = $dateTime->format('Y-m-d');
        $time = $dateTime->format('h:i A');
        $details = [
            "type"  => 'delmember',
            "id"    => $request->zoomid,
            "date"  => $date,
            "time"  => $time,
            "join_url" => $google->meet_link,
            "user" => ucfirst(Auth::user()->name)
        ];

        $view = "emails.Email";
        $subject = "Google Meeting Canceled";
        $a = Mail::to($userdetail->email)->send(new EmailVerifyMail($details, $view, $subject));

        $user_id = explode(',', $google->user_id);
        $pos = array_search($request->id, $user_id);

        if ($pos !== false) {
            unset($user_id[$pos]);
            $user_id = implode(',', $user_id);
            $zoom = GoogleMeet::where('id', $request->zoomid)->update(['user_id' => $user_id]);
        }
        return redirect()->back()->with(['success' => 'Data Deleted Successfully.']);
    }
}
