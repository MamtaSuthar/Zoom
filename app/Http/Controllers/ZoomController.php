<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ZoomMeetingTrait;
use App\Models\Zoom;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Mail\EmailVerifyMail;
use App\Models\ZoomApi;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use DataTables;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class ZoomController extends Controller
{
    use ZoomMeetingTrait;
    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user =  Auth::user();
        if ($user->role == 1) {
            $zoom = Zoom::all();
        } else {
            $zoom = Zoom::where('created_by', $user->id)->get();
        }

        $mytime = Carbon::now();
        $mytime->toDateTimeString();

        $data = array();
        foreach ($zoom as $z) {
            $a = json_decode($z->data);
            if ($a->start_time >= $mytime) {
                array_push($data, $z);
            }
        }

        return view('zoom', compact('data'));
    }

    public function show($id)
    {
        $meeting = $this->get($id);

        return view('zoom', compact('meeting'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'topic'        => 'required|alpha_num',
            'duration'     => 'required|min:1',
            'meeting_date' => 'required|after_or_equal:now',
        ]);

        $valid = $this->checkvaliditiy(1, '');

        if (isset($valid['code'])) {
            return redirect()->back()->with(['error' => $valid['message']]);
        }

        $this->create($request->all());

        return redirect()->back()->with(['success' => 'Data Added Successfully.']);
    }

    public function editmeeting(Request $request)
    {

        $data = Zoom::where('id', $request->id)->first();
        $dateTime = new DateTime($data->start_time);
        $dateTime->setTimeZone(new DateTimeZone('UTC'));
        $date = $dateTime->format('d-m-Y h:i A');
        $data = json_decode($data->data, true);
        $data['date'] = $date;
        return [
            'data'    => $data,
        ];
    }

    public function updatemeeting(Request $request)
    {
        $validated = $request->validate([
            'topic' => 'required|alpha_num',
            'duration' => 'required|min:1',
            'meeting_date' => 'required|after_or_equal:now',
        ]);

        $valid = $this->checkvaliditiy(1, '');

        if (isset($valid['code'])) {
            return [
                'status' => 0,
                'data'    =>  $valid['message']
            ];
        }

        $data = $this->update($request->zoom_meeting_id, $request->all());

        $users = Zoom::where('id', $request->id)->first();
        $users = array_filter(explode(',', $users->user_id));

        if (!empty($users)) {
            foreach ($users as $user) {
                $email = User::where('id', $user)->first();
                $dateTime = new DateTime($data['data']['start_time']);
                $dateTime->setTimeZone(new DateTimeZone('UTC'));
                $date = $dateTime->format('Y-m-d');
                $time = $dateTime->format('h:i A');
                $details = [
                    "type" => 'edit',
                    "id" => $data['data']['id'],
                    "topic" => $data['data']['topic'],
                    "date" => $date,
                    "time" => $time,
                    "timezone" => $data['data']['timezone'],
                    "join_url" => $data['data']['join_url'],
                    "pass" => $data['data']['password'],
                    "user" => ucfirst(Auth::user()->name)
                ];
                $view = "emails.Email";
                $subject = "Zoom Meeting Changed";

                $a = Mail::to($email->email)->send(new EmailVerifyMail($details, $view, $subject));
            }
        }
        return [
            'status' => 1,
            'data'    =>  $data
        ];
    }

    public function destroy(request $request)
    {
        $user = Zoom::where('id', $request->id)->first();
        $data = json_decode($user->data);
        $users = array_filter(explode(',', $user->user_id));
        foreach ($users as $us) {
            $email = User::where('id', $us)->first();

            $dateTime = new DateTime($data->start_time);
            $dateTime->setTimeZone(new DateTimeZone('UTC'));
            $date = $dateTime->format('Y-m-d');
            $time = $dateTime->format('h:i A');

            $details = [
                "type" => 'delete',
                "id" => $data->id,
                "topic" => $data->topic,
                "date" => $date,
                "time" => $time,
                "timezone" => $data->timezone,
                "join_url" => $data->join_url,
                "pass" => $data->password,
                "user" => ucfirst(Auth::user()->name)
            ];
            $view = "emails.Email";
            $subject = "Zoom Meeting Canceled";

            Mail::to($email->email)->send(new EmailVerifyMail($details, $view, $subject));
        }

        $this->delete($request->zoom_id);
        Zoom::where('id', $request->id)->delete();


        return redirect()->back()->with(['success' => 'Meeting deleted successfully.']);
    }

    public function invitaion(Request $request)
    {
        $id = $request->id;
        $data = Zoom::where('zooms.id', $id)->first();
        $user = User::where('id', '!=', Auth::user()->id)->get();
        $user_data = array();

        foreach (explode(',', $data->user_id) as $d) {
            $userdata = User::where('id', $d)->first();
            array_push($user_data, $userdata);
        }
        $user_data = array_filter($user_data);
        return [
            'data'    => json_decode($data->data, true),
            'user'    => $user,
            'user_data' => $user_data
        ];
    }

    public function livedata(Request $request)
    {
        $data = Zoom::all();
        $meeting = $this->get($data);
        return  $meeting;
    }

    public function prevdata(Request $request)
    {

        $zoom = Zoom::all();
        $mytime = Carbon::now();
        $mytime->toDateTimeString();

        $data = array();
        foreach ($zoom as $z) {
            $a = json_decode($z->data);
            if ($a->start_time < $mytime) {
                array_push($data, $z);
            }
        }
        return  $data;
    }

    public function zoomsetting(Request $request)
    {
        if ($request->ajax()) {
            $user =  Auth::user()->role;

            $zoomapi = ZoomApi::all();
            foreach ($zoomapi as $key => $zoom) {
                if ($zoom->status == 0) {
                    $zoomapi[$key]['st'] = 'default';
                } else {
                    $zoomapi[$key]['st'] = 'custome';
                }
                if ($zoom->active == 1) {
                    $zoomapi[$key]['actived'] = 'Activated';
                } else {
                    $zoomapi[$key]['actived'] = 'Deactivated';
                }
            }

            return FacadesDataTables::of($zoomapi)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                <a href="javascript:;" class="edit btn btn-primary btn-sm join" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">View</a>
                
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">';

                    if ($row->user_id != Auth::user()->id) {
                        // Hide the li elements if user_id is not equal to Auth user's id
                        $btn .= '';
                    } else {
                        $btn .= '
                    <li class="mb-2 li_itemx">
                        <button id="icon_button" onclick="apimodel(' . $row->id . ')">
                            <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                        </button>
                    </li>
                    <li class="mb-2 li_itemx">
                        <form method="POST" id="apiseceret' . $row->id . '"
                            action="' . route('zoom.delsecret') . '">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="id" value="' . $row->id . '">
                        </form>
                        <button type="button" onclick="delsecret(' . $row->id . ')" id="icon_button">
                            <i class="cursor-pointer fas fa-trash text-secondary" aria-hidden="true"></i>
                        </button>
                    </li>';
                    }

                    $btn .= ' <li class="mb-2 li_itemx">
                <button id="icon_button" onclick="apiactive(' . $row->id . ')">
                    <i class="fas fa-list text-secondary"></i>
                </button>
            </li></ul>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function addinvit(Request $request)
    {
        $zoom = Zoom::where('id', $request->idzoom)->first();
        $user = explode(',', $zoom->user_id);

        if (in_array($request->user, $user)) {
            return [
                'msg'    => 'Id Already Exists !',
                'data'   => '',
            ];
        } else {

            $user = $zoom->user_id . "," . $request->user;
            Zoom::where('id', $request->idzoom)->update(['user_id' => $user]);

            $user = $zoom->user_id . "," . $request->user;
            Zoom::where('id', $request->idzoom)->update(['user_id' => $user]);

            $userdetail = User::where('id', $request->user)->first();

            $dateTime = new DateTime($request->time);
            $dateTime->setTimeZone(new DateTimeZone('UTC'));
            $date = $dateTime->format('Y-m-d');
            $time = $dateTime->format('h:i A');
            $details = [
                "type" => 'add',
                "id" => $request->id,
                "topic" => $request->topic,
                "date" => $date,
                "time" => $time,
                "timezone" => $request->timezone,
                "join_url" => $request->join_url,
                "pass" => $request->pass,
                "user" => ucfirst(Auth::user()->name)
            ];
            $view = "emails.Email";
            $subject = "Zoom Meeting Invitation";

            $a = Mail::to($userdetail->email)->send(new EmailVerifyMail($details, $view, $subject));

            $dateTime = new DateTime($request->time);
            $dateTime->setTimeZone(new DateTimeZone('UTC'));
            $date = $dateTime->format('Y-m-d');
            $time = $dateTime->format('h:i A');
            $details = [
                "type" => 'add',
                "id" => $request->id,
                "topic" => $request->topic,
                "date" => $date,
                "time" => $time,
                "timezone" => $request->timezone,
                "join_url" => $request->join_url,
                "pass" => $request->pass,
                "user" => ucfirst(Auth::user()->name)
            ];

            $view = "emails.Email";
            $subject = "Zoom Meeting Canceled";

            $a = Mail::to($userdetail->email)->send(new EmailVerifyMail($details, $view, $subject));

            return [
                'msg'    => 'New Data Added Succesfully !',
                'data'   => $userdetail,
            ];
        }
    }

    public function delmembers(Request $request)
    {
        $zoom = Zoom::where('id', $request->zoomid)->first();
        $userdetail = User::where('id', $request->id)->first();

        $data = json_decode($zoom->data);
        $dateTime = new DateTime($data->start_time);
        $dateTime->setTimeZone(new DateTimeZone('UTC'));
        $date = $dateTime->format('Y-m-d');
        $time = $dateTime->format('h:i A');
        $details = [
            "type"  => 'delmember',
            "id"    => $request->zoomid,
            "topic" => $data->topic,
            "date"  => $date,
            "time"  => $time,
            "timezone" => $data->timezone,
            "join_url" => $data->join_url,
            "pass" => $data->password,
            "user" => ucfirst(Auth::user()->name)
        ];

        $view = "emails.Email";
        $subject = "Zoom Meeting Canceled";
        $a = Mail::to($userdetail->email)->send(new EmailVerifyMail($details, $view, $subject));

        $user_id = explode(',', $zoom->user_id);
        $pos = array_search($request->id, $user_id);

        if ($pos !== false) {
            unset($user_id[$pos]);
            $user_id = implode(',', $user_id);
            $zoom = Zoom::where('id', $request->zoomid)->update(['user_id' => $user_id]);
        }

        return redirect()->back()->with(['success' => 'Data Deleted Successfully.']);
    }

    public function envdata(Request $request)
    {

        $validated = $request->validate([
            'zoomapikey' => 'required|alpha_num',
            'zoomapisecret' => 'required|alpha_num',
        ]);

        $zoomapi = ZoomApi::where('status', 0)->first();
        if ($request->zoomapikey != $zoomapi->api_key || $request->zoomapisecret != $zoomapi->api_secret) {
            $user =  Auth::user()->id;
            $userexits =  ZoomApi::where('user_id', $user)->first();
            $details = [
                'user_id' => $user,
                'api_key' => $request->zoomapikey,
                'api_secret' => $request->zoomapisecret
            ];

            $valid = $this->checkvaliditiy(0, $details);

            if (isset($valid['code'])) {
                return redirect()->back()->with(['error' => $valid['message']]);
            }
            ZoomApi::insert($details);

            return redirect()->back()->with(['success' => 'API Details Added Successfully !']);
        } else {
            return redirect()->back()->with(['error' => 'API Details Already Exists !']);;
        }
    }

    public function delsecret(Request $request)
    {
        $datas = Zoom::where('api_uid', $request->id)->get('user_id');
        foreach ($datas as $data) {
            $user = array_filter(explode(',', $data->user_id));
            if (!empty($user)) {
                $userdetail = User::where('id', $user)->first();

                $dateTime = new DateTime($data->start_time);
                $dateTime->setTimeZone(new DateTimeZone('UTC'));
                $date = $dateTime->format('Y-m-d');
                $time = $dateTime->format('h:i A');

                $details = [
                    "type" => 'delete',
                    "id" => $data->id,
                    "topic" => $data->topic,
                    "date" => $date,
                    "time" => $time,
                    "timezone" => $data->timezone,
                    "join_url" => $data->join_url,
                    "pass" => $data->password,
                    "user" => ucfirst(Auth::user()->name)
                ];

                $view = "emails.Email";
                $subject = "Zoom Api Removed";

                Mail::to($userdetail->email)->send(new EmailVerifyMail($details, $view, $subject));
            }
        }
        ZoomApi::where('id', $request->id)->delete();
        return redirect()->back()->with(['success' => 'Data Deleted Successfully.']);
    }

    public function getapidata(Request $request)
    {
        $data = ZoomApi::where('id', $request->id)->first();
        return [
            'data'    =>  $data
        ];
    }

    public function editapi(Request $request)
    {
        $zoomapi = ZoomApi::where('id', $request->id)->first();
        $details = [
            'api_key' => $request->zoomapikey,
            'api_secret' => $request->zoomapisecret
        ];
        ZoomApi::where('id', $request->id)->update($details);
        return redirect()->back()->with(['success' => 'API Details Updated Successfully !']);
    }

    public function activeapi(Request $request)
    {
        $user =  Auth::user()->id;
        $zoomapi = ZoomApi::where('id', $request->id)->first();
        $default = ZoomApi::where('status', 0)->first();

        if ($request->id == $default->id) {
            $details = ['active' => 0];
            ZoomApi::where('active', 1)->where('status', '!=', 0)->update($details);
        } else {

            if ($zoomapi->active == 0) {
                $zoomapiexits = ZoomApi::where('id', '!=', $request->id)->where('status', '!=', 0)->first();
                if (!empty($zoomapiexits)) {
                    $details = [
                        'active' => 0,
                    ];
                    ZoomApi::where('id', '!=', $request->id)->where('status', '!=', 0)->update($details);
                }
                $details1 = [
                    'active' => 1,
                ];
                ZoomApi::where('id', $request->id)->update($details1);
            } else {
                $details1 = [
                    'active' => 0,
                ];
                ZoomApi::where('id', $request->id)->update($details1);
            }
        }

        $default = ZoomApi::where('user_id', $user)->where('active', 1)->where('status', '!=', 0)->get();

        return [
            'status'    =>  1,
            'data'      =>  $zoomapi->active,
            'default'   =>  $default
        ];
    }
}
