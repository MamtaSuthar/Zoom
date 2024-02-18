@extends('layouts.user_type.auth')

@section('content')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <style>
        #icon_button {
            border: none;
            background-color: transparent;
        }

        .panel {
            /* color:#88c136; */
            color: #cc0c9f;
        }

        .tabs-body {
            width: calc(100% - 200px);
            float: left;
            padding: 30px;
            border-left: 1px solid #ddd;
            background: #fff;
        }

        .tabs-body {
            width: calc(100% - 200px);
            float: left;
            padding: 30px;
            border-left: 1px solid #ddd;
            background: #fff;
        }

        .card .card-header {
            padding: 20px 30px;
            background-color: #ffffff;
            font-size: 18px;
            font-weight: 600;
        }

        ul.tabs-nav {
            list-style-type: none;
            width: 200px;
            float: left;
        }

        .tabs-area {
            background-color: #f9f9f9;
        }

        ul.tabs-nav li a {
            padding: 15px 15px;
            display: block;
            color: #686868;
        }

        ul {
            margin: 0px;
            padding: 0px;
        }


        ul.tabs-nav li {
            border-bottom: 1px solid #ddd;
            border-left: none;
            position: relative;
        }

        ul.tabs-nav li a:hover,
        ul.tabs-nav li a.active {
            background-color: #ffffff;
            width: 101%;
            left: 0;
            right: 0;
        }

        ul.tabs-nav li a:hover,
        ul.tabs-nav li a.active {
            background-color: #ffffff;
            width: 101%;
            left: 0;
            right: 0;
        }

        ul.tabs-nav li a i.fa {
            margin-right: 10px;
        }

        .dropdown-menu {
            min-width: 6rem !important;
            text-align: center
                /* background-color: #f9f9f9; */
        }

        #dropdownMenuButton {
            text-align: center
        }



        /* .text-secondary {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                color: #2b2f52!important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            .font-weight-bolder {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                color: white!important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } */

        #prevtable {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #prevtable td,
        #prevtable th {
            border: 1px solid #ddd;
            padding: 8px;
            background-color: white !important;
        }

        #prevtable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #prevtable tr:hover {
            background-color: #ddd;
        }

        #prevtable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: white !important;
            color: #7a8184;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Google Meeting</h5>

                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-7">
                                <a class="btn join  panel UpcomingMeeting" id="tabId-1" style="color:#fff"
                                onclick="onFormPanel('UpcomingMeeting')">
                                Upcoming Meeting
                            </a>
                            <a class="btn join  panel PreviousMeeting" id="tabId-2" style="color:#fff"
                                onclick="onFormPanelform('PreviousMeeting')">
                                Previous Meeting
                            </a>
                            
                            <a class="btn join  panel LiveMeeting" id="tabId-3" style="color:#fff"
                                onclick="onFormPanelform('LiveMeeting')">
                                Live Meeting
                            </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body tabs-area p-0">

                        <div class="row" style="margin-left:20px">
                            <div id="dateTimeForm">
                                <form method="post" action="{{ route('googlemeet') }}" data-validate="parsley">
                                    @csrf
                                    {{-- <div class="row"> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="meetingtime"> Meeting Date Time</label>
                                                <input type="text" name="meetingtime" id="meetingtime"
                                                    class="form-control parsley-validated" data-required="true"
                                                    value="{{ now()->format('Y-m-d\TH:i') }}"
                                                    placeholder="Select Date and Time To Create A Meeting">
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="margin-top:30px;">
                                            <button type="submit" class="btn join mr-10">Meeting</button>

                                        </div>
                                    {{-- </div> --}}
                                </form>
                            </div>

                            <!--Upcoming Meeting-->
                            <div id="UpcomingMeeting" class="d-none">

                                <!--Upcoming Table-->
                                <div id="list-panel" class="mt-20">
                                    <div class="row" style="margin:auto;">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <p class="pt-3"><strong>Upcoming Meeting List</strong></p>
                                                </div>
                                                <div class="col-md-2 mt-2">
                                                    <a href="{{ route('meet') }}" class="btn join btn-sm"><i
                                                            class="fas fa-arrow-left" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered dataTable no-footer"
                                                    id="prevtable">
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Meeting Link</th>
                                                        <th>Date Time</th>
                                                        <th>Invite User</th>
                                                        <th>join Meeting</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    @if (!empty($googleMeet))
                                                        @foreach ($googleMeet as $gm)
                                                            <tr>
                                                                {{-- <td>{{$zoomdata->id}}</td> --}}
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $gm->meet_link }}</td>
                                                                <td>{{ $gm->meetingtime }}</td>
                                                                {{-- <td><button type="button"
                                                                        class="btn join">Invitation</button>
                                                                </td> --}}
                                                                <td><button type="button" class="btn join "
                                                                        onclick="invitionmodel({{ $gm->id }})">Invitation</button>
                                                                </td>
                                                                <td><a href="{{ $gm->meet_link }}" class="btn join">join</a>
                                                                </td>
                                                                {{-- <td>
                                                                    <a href="javascript:;" class="edit btn join join" --}}
                                                                {{-- <td>
                                                                {{-- <td><button type="button" class="btn join"
                                                                        onclick="invitionmodel({{ $zoomdata->id }})">Invitation</button>
                                                                </td> --}}
                                                                {{-- <td>
                                                                    <a style="text-decoration:none !important;"
                                                                        class="join join"
                                                                        href="{{ json_decode($zoomdata->data)->join_url }}"
                                                                        target="_blank"><button type="button"
                                                                            class="btn join">join Meeting</button></a>
                                                                </td> --}}
                                                                <td>
                                                                    <a href="javascript:;" class="edit btn btn-blue join"
                                                                        id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">View</a>
                                                                    <ul class="dropdown-menu  dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuButton">
                                                                        <li class="mb-2 li_itemx">
                                                                            <button id="icon_button"
                                                                                onclick="editmeeting({{ $gm->id }})"><i
                                                                                    class="fas fa-edit text-secondary"
                                                                                    aria-hidden="true"></i></button>
                                                                        </li>
                                                                        <li class="mb-2 li_itemx">
                                                                            <form method="Post"
                                                                                id="revi{{ $gm->id }}"
                                                                                action="{{ route('googleDeleteRecord', $gm->id) }}">
                                                                                <input type="hidden" name="_token"
                                                                                    value="{{ csrf_token() }}">
                                                                                <input type="hidden" name="_method"
                                                                                    value="DELETE">
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $gm->id }}">
                                                                            </form>
                                                                            <button type="button"
                                                                                onclick="del({{ $gm->id }})"
                                                                                id="icon_button"><i
                                                                                    class="cursor-pointer fas fa-trash text-secondary"
                                                                                    aria-hidden="true"></i></button>
                                                                        </li>

                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-center">No Data Found</td>
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Upcoming Form-->
                                <div id="form-panel" class="d-none">
                                    <div class="row" style="margin:auto;">
                                        <div class="col-lg-12">
                                            <form method="post" action="{{ route('zoom.store') }}"
                                                data-validate="parsley">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="meeting_topic"> Meeting Topic</label>
                                                            <input type="text" name="topic" id="meeting_topic"
                                                                class="form-control parsley-validated"
                                                                data-required="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="meeting_date"> Meeting Date</label>
                                                            <input type="datetime-local" name="meeting_date"
                                                                id="meeting_date" class="form-control parsley-validated"
                                                                data-required="true" placeholder="yyyy-mm-ddThh:ii:ss">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="meeting_duration"> Duration</label>
                                                            <input type="number" name="duration" id="meeting_duration"
                                                                min="1" class="form-control parsley-validated"
                                                                data-required="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="timezone_id"> Time Zone</label>
                                                            <select id="timezone" name="timezone"
                                                                class="selectpicker form-control edit"
                                                                data-live-search="true" style="width:500%" required
                                                                disabled>
                                                                <option selected value="Asia/Kolkata">Asia/Kolkata</option>
                                                            </select>
                                                            <input name="timezone" type="hidden" value="Asia/Kolkata">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Video Settings</label>
                                                            <div class="tw_checkbox checkbox_group">
                                                                <input id="host_video" name="host_video" type="checkbox">
                                                                <label for="host_video">Host Video On/Off</label>
                                                                <span></span>
                                                            </div>
                                                            <div class="tw_checkbox checkbox_group">
                                                                <input id="participant_video" name="participant_video"
                                                                    type="checkbox">
                                                                <label for="participant_video">Participant Video
                                                                    On/Off</label>
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Meeting Options</label>
                                                            <div class="tw_checkbox checkbox_group">
                                                                <input id="enable_join_before_host"
                                                                    name="enable_join_before_host" type="checkbox">
                                                                <label for="enable_join_before_host">Enable join before
                                                                    host</label>
                                                                <span></span>
                                                            </div>
                                                            <div class="tw_checkbox checkbox_group">
                                                                <input id="mute_participants_upon_entry"
                                                                    name="mute_participants_upon_entry" type="checkbox">
                                                                <label for="mute_participants_upon_entry">Mute participants
                                                                    upon entry</label>
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <input type="text" name="MeetingId" id="MeetingId" class="d-none"> --}}

                                                <div class="row tabs-footer mt-15">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn join mr-10">Save</button>
                                                        <button onclick="onListPanel()"
                                                            class="btn btn-danger">Cancel</button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Upcoming Meeting-->


                            <!--Previous Meeting-->
                            <div id="PreviousMeeting" class="d-none">
                                <div class="row" style="margin:auto;">
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-10">
                                                <p class="pt-3"><strong>Previous Meeting List</strong></p>
                                            </div>
                                            <div class="col-md-2 mt-2">
                                                <a href="{{ route('meet') }}" class="btn join btn-sm"><i
                                                        class="fas fa-arrow-left" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered dataTable no-footer "
                                                id="prevtable">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Meeting Link</th>
                                                    <th>Date Time</th>
                                                    <th>Invite User</th>
                                                    <th>join Meeting</th>
                                                    <th>Action</th>
                                                </tr>

                                                @if (!empty($previousgoogleMeet))
                                                    @foreach ($previousgoogleMeet as $prevgm)
                                                        <tr>
                                                            {{-- <td>{{$zoomdata->id}}</td> --}}
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $prevgm->meet_link }}</td>
                                                            <td>{{ $prevgm->meetingtime }}</td>
                                                            <td><button type="button" class="btn join"
                                                                    disabled>Invitation</button>
                                                            </td>
                                                            <td><button type="button" class="btn join"
                                                                    disabled>Join</button>
                                                                {{-- <td><a href="{{ $prevgm->meet_link }}"
                                                                    class="btn join">join</a>
                                                            </td> --}}
                                                                {{-- <td>
                                                                {{-- <td><button type="button" class="btn join"
                                                                        onclick="invitionmodel({{ $zoomdata->id }})">Invitation</button>
                                                                </td> --}}
                                                                {{-- <td>
                                                                    <a style="text-decoration:none !important;"
                                                                        class="join join"
                                                                        href="{{ json_decode($zoomdata->data)->join_url }}"
                                                                        target="_blank"><button type="button"
                                                                            class="btn join">join Meeting</button></a>
                                                                </td> --}}
                                                            <td>
                                                                {{-- <button id="icon_button"><i
                                                                        class="fas fa-edit text-secondary"
                                                                        aria-hidden="true"></i></button> --}}
                                                                <button id="icon_button"><i
                                                                        class="fas fa-trash text-secondary"
                                                                        aria-hidden="true"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">No Data Found</td>
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Previous Meeting-->

                            <!--live Meeting-->
                            <div id="LiveMeeting" class="d-none">
                                <div class="row" style="margin:auto;">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <p class="pt-3"><strong>Live Meeting List</strong></p>
                                            </div>
                                            <div class="col-md-2 mt-2">
                                                <a href="{{ route('meet') }}" class="btn join btn-sm"><i
                                                        class="fas fa-arrow-left" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered dataTable no-footer "
                                                id="prevtable">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Meeting Link</th>
                                                    <th>Date Time</th>
                                                    <th>Invite User</th>
                                                    <th>join Meeting</th>
                                                    <th>Action</th>
                                                </tr>

                                                @if (!empty($livegoogleMeet))
                                                    @foreach ($livegoogleMeet as $livegm)
                                                        <tr>
                                                            {{-- <td>{{$zoomdata->id}}</td> --}}
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $livegm->meet_link }}</td>
                                                            <td>{{ $livegm->meetingtime }}</td>
                                                            <td><button type="button"
                                                                    class="btn join">Invitation</button>
                                                            </td>
                                                            <td>{{ $gm->meetingtime }}</td>
                                                            {{-- <td>
                                                                {{-- <td><button type="button" class="btn join"
                                                                        onclick="invitionmodel({{ $zoomdata->id }})">Invitation</button>
                                                                </td> --}}
                                                            {{-- <td>
                                                                    <a style="text-decoration:none !important;"
                                                                        class="join join"
                                                                        href="{{ json_decode($zoomdata->data)->join_url }}"
                                                                        target="_blank"><button type="button"
                                                                            class="btn join">join Meeting</button></a>
                                                                </td> --}}
                                                            <td>
                                                                <button id="icon_button"><i
                                                                        class="fas fa-edit text-secondary"
                                                                        aria-hidden="true"></i></button>
                                                                <button id="icon_button"><i
                                                                        class="fas fa-trash text-secondary"
                                                                        aria-hidden="true"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">No Data Found</td>
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--live Meeting-->

                            <!--zoom setting-->
                            <div id="zoomsetting" class="d-none">
                                <div class="row">
                                    {{-- <div class="col-lg-8">
                                        <form method="post" action="{{ route('googlemeet') }}" data-validate="parsley">
                                            @csrf
                                            <div class="form-group">
                                                <label for="meetingtime"> Meeting time</label>
                                                <input type="datetime-local" name="meetingtime" id="meetingtime"
                                                    class="form-control parsley-validated" data-required="true"
                                                    value="" placeholder="Enter time here">
                                            </div>
                                            <button type="submit" class="btn join mr-10">Save</button>
                                        </form>
                                    </div> --}}
                                    <div class="col-lg-8 mt-2">
                                        <table class="table table-bordered data-table">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Meeting Link</th>
                                                    <th>Date Time</th>
                                                    <th>join Meeting</th>
                                                    <th>Invite Users</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--zoom setting-->
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!--Upcoming Model-->
        <div class="modal" id="Meeting_upcoming" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Zoom Meeting Edit</h4>
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                    </div>
                    <!-- Modal body -->
                    <div class="row mt-2 mb-2 ms-2 me-2">
                        <div class="col-lg-12">
                            <form data-validate="parsley">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="meeting_date"> Meeting Date Time</label>
                                            <input type="datetime-local" name="meeting_date_edit" id="meeting_date_edit"
                                                class="form-control parsley-validated" data-required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="row tabs-footer mt-15">
                                    <div class="col-lg-12">
                                        <a id="submit-form" href="javascript:void(0);" class="btn join mr-10">Save</a>
                                        <a href="javascript:void(0);" class="btn btn-warning close">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Upcoming Model-->

        <!--Invitaion Model-->
        <div class="modal" id="Meeting_id" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-content">
                        <form id="MeetingInvitation_formId">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Meeting Invitation</h4>
                                <button type="button" class="btn btn-secondary close"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body" style="overflow: auto; m-1">
                                {{-- <div class="row" style="margin:auto;">
                                    <div class="col-md-12" id="CopyInvitation">
                                        <p class="mb-2" id="mtopic"></p>
                                        <p class="mb-2" id="mdatetime"></p>
                                        <p class="mb-2" id="mzoom"></p>
                                    </div>
                                </div>  --}}
                                <div class="form-group">
                                    <label for="StaffClient_id"> Staff/Client</label>
                                    <select name="StaffClient_id" id="StaffClient_id"
                                        class="chosen-select form-control selectpicker">
                                        <option value="">Select staff/client</option>
                                    </select>
                                </div>

                                {{-- <input type="text" name="Invitation_Meeting_Topic" id="Invitation_Meeting_Topic"
                                    class="d-none"> --}}
                                <input type="text" name="idzoom" id="idzoom" class="d-none">
                                <input type="text" name="Invitation_Time" id="Invitation_Time" class="d-none">
                                <input type="text" name="Invitation_Timezone" id="Invitation_Timezone"
                                    class="d-none"><input type="text" name="Invitation_join_url"
                                    id="Invitation_join_url" class="d-none">
                                {{-- <input type="text" name="Invitation_Meeting_id" id="Invitation_Meeting_id"
                                    class="d-none"> --}}
                                {{--  <input type="text" name="Invitation_password" id="Invitation_password"
                                    class="d-none"> --}}
                                <center>
                                    <a href="javascript:void(0);" onclick="onAddMeetingInvitation();"
                                        class="btn join mr-10">Invitation</a>
                                    <a href="javascript:void(0);" class="btn btn-danger close"
                                        data-dismiss="modal">Cancel</a>
                                </center>
                            </div>
                        </form>

                        <!-- Modal body -->
                        <!-- Table showing in model -->
                        <div class="modal-body">
                            <h5>Staff/Client List</h5>
                            <div class="table-responsive-md">
                                {{-- <input class="form-control mb-1" id="staff_client_search_id" type="text" placeholder="Search.."> --}}
                                <table class="table table-bordered " width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="10%">Photo</th>
                                            <th scope="col" width="80%">Staff/Client</th>
                                            <th scope="col" width="10%" class="text-center">Delete</th>
                                        </tr>
                                    <tbody class="invitstaff">
                                    </tbody>
                                    </thead>
                                    <tbody id="staff_client_list_id">
                                        <tr>
                                            <td colspan="3">
                                                <div class="alert join text-center" role="alert">No data
                                                    available</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--End of  Table showing in model -->
                    </div>
                </div>
            </div>
        </div>
        <!--Invitaion Model-->

        <!--Api Model-->
        <div class="modal" id="Meeting_api" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Meeting Api</h4>
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                    </div>
                    <!-- Modal body -->
                    <div class="row mt-2 mb-2 ms-2 me-2">

                        <div class="col-lg-12">
                            <form method="post" action="{{ route('zoom.editapi') }}" data-validate="parsley">
                                @csrf
                                <div class="form-group">
                                    <label for="zoomapikey_edit"> Zoom API Key</label>
                                    <input type="password" name="zoomapikey_edit" id="zoomapikey_edit"
                                        class="form-control parsley-validated" data-required="true" value="">
                                </div>
                                <div class="form-group">
                                    <label for="zoomapisecret_edit"> Zoom API Secret</label>
                                    <input type="password" name="zoomapisecret_edit" id="zoomapisecret_edit"
                                        class="form-control parsley-validated" data-required="true" value="">
                                    <small class="form-text text-muted"><a target="_blank"
                                            href="https://www.teamwork-laravel.themeposh.xyz/documentation/#zoommeeting">Zoom
                                            Meeting Documentation</a></small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn join" style="margin:auto;">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Api Model-->

    </div>
@endsection

@push('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



    <script>
        function onFormPanel(id) {
            $("#dateTimeForm").addClass('d-none');
            $('.panel').removeClass('active');
            $('.' + id).addClass('active');
            $("#new").removeClass('d-none');
            $("#back").addClass('d-none');
            if (id == 'new') {
                $("#dateTimeForm").addClass('d-none');
                $("#list-panel").addClass('d-none');
                $("#form-panel").removeClass('d-none');
                $("#LiveMeeting").addClass('d-none');
                $("#UpcomingMeeting").removeClass('d-none');
                $("#PreviousMeeting").addClass('d-none');
                $("#new").addClass('d-none');
                $("#back").removeClass('d-none');
            } else if (id == 'back' || id == 'UpcomingMeeting') {
                $("#dateTimeForm").addClass('d-none');
                $("#zoomsetting").addClass('d-none');
                $("#form-panel").addClass('d-none');
                $("#list-panel").removeClass('d-none');
                $("#LiveMeeting").addClass('d-none');
                $("#UpcomingMeeting").removeClass('d-none');
                $("#PreviousMeeting").addClass('d-none');
                $("#new").removeClass('d-none');
                $("#back").addClass('d-none');
            }
        }

        function onFormPanelform(id) {
            $("#dateTimeForm").addClass('d-none');
            $('.panel').removeClass('active');
            $('.' + id).addClass('active');
            if (id == 'PreviousMeeting') {
                $("#LiveMeeting").addClass('d-none');
                $("#UpcomingMeeting").addClass('d-none');
                $("#PreviousMeeting").removeClass('d-none');
                $("#zoomsetting").addClass('d-none');
                $("#new").addClass('d-none');
                $("#back").addClass('d-none');
                prevdata();
            } else if (id == 'LiveMeeting') {
                $("#LiveMeeting").removeClass('d-none');
                $("#UpcomingMeeting").addClass('d-none');
                $("#PreviousMeeting").addClass('d-none');
                $("#zoomsetting").addClass('d-none');
                $("#new").addClass('d-none');
                $("#back").addClass('d-none');
                livedata();
            } else {
                $("#LiveMeeting").addClass('d-none');
                $("#UpcomingMeeting").addClass('d-none');
                $("#PreviousMeeting").addClass('d-none');
                $("#zoomsetting").removeClass('d-none');
                $("#new").addClass('d-none');
                $("#back").addClass('d-none');
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('zoom.zoomsetting') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        // {data: 'api_key', api_key: 'api_key'},4
                        {
                            data: 'api_key',
                            name: 'api_key',
                            render: function(data, type, full, meta) {
                                if (data.length > 5) {
                                    return data.substring(0, 5) + '...';
                                } else {
                                    return data;
                                }
                            }
                        },
                        {
                            data: 'api_secret',
                            name: 'api_secret',
                            render: function(data, type, full, meta) {
                                if (data.length > 5) {
                                    return data.substring(0, 5) + '...';
                                } else {
                                    return data;
                                }
                            }
                        },
                        // {data: 'api_secret', api_secret: 'api_secret'},
                        {
                            data: 'st',
                            st: 'st'
                        },
                        {
                            data: 'actived',
                            actived: 'actived'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },

                    ],
                    createdRow: function(row, data, index) {
                        // data.substr(0, 1) 
                        $('td', row).eq(4).addClass(data['active']);

                        $(row).find("td:eq(4).0").css("color", "red");
                        $(row).find("td:eq(4).1").css("color", "green");

                        if (data['status'] = 0) {
                            $('td', row).eq(4).addClass(` activatedclass activestatus${data['id']}`);
                        } else {
                            $('td', row).eq(4).addClass(` activatedclass activestatus${data['id']}`);
                        }
                    }
                });
            }
        }

        $(".close").click(function() {
            $('#Meeting_id').hide();
            $('#Meeting_api').hide();
            $('#Meeting_upcoming').hide();
        })

        //   Previous Meeting 
        function prevdata() {
            $('.prevdata').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('zoom.prevdata') }}",
                type: "post",

                success: function(data) {
                    $('.prevdata').html("");
                    if (data == '') {
                        $('.prevdata').append(
                            `<tr><td></td><td></td><td class="text-center">No Data Found</td><td></td><td></td><tr>`
                        );
                    } else {
                        $.each(data, function(key, val) {
                            var vdata = JSON.parse(val['data']);
                            var routeUrl = "'{{ route('zoom.destroy', "+val['id']+") }}'";

                            $('.prevdata').append('<tr pretable><td>' + (key + 1) + '</td>' +
                                '<td>' + vdata['topic'] + '</td>' +
                                '<td><button type="button" class="btn join" onclick="invitionmodel(' +
                                val['id'] + ')" disabled>Invitation</button></td>' +
                                '<td><button type="button" class="btn join" disabled>join Meeting</button>' +
                                '</td><td>' +
                                '<form method="Post" id="revi' + val['id'] + '" action="' +
                                routeUrl + '">' +
                                '<input type="hidden" name="_method" value="DELETE">' +
                                '<input type="hidden" name="id" value="' + val['id'] + '">' +
                                '<input type="hidden" name="zoom_id" value="' + vdata['id'] + '">' +
                                '</form>' +
                                '<button id="icon_button" type="button" onclick="del(' + val['id'] +
                                ')" ><i class="cursor-pointer fas fa-trash text-secondary" aria-hidden="true"></i></button>' +
                                '</td><tr> pretable');
                        });
                    }
                }
            });

        }

        // Live Meeting
        function livedata() {
            $('.livedatatr').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('zoom.livedata') }}",
                type: "post",

                success: function(data) {
                    // console.log(data);
                    $('.livedatatr').html("");
                    if (data == '' || data.data == '') {
                        $('.livedatatr').append(
                            `<td></td><td></td><td class="text-center">No Data Found</td><td></td><td></td>`
                        );
                    } else {
                        $.each(data.data, function(key, val) {
                            var vdata = val['data'];
                            var routeUrl = "'{{ route('zoom.destroy', "+val['id']+") }}'";
                            $('.livedatatr').append('<tr><td>' + (key + 1) + '</td>' +
                                '<td>' + vdata['topic'] + '</td>' +
                                '<td><button type="button" class="btn join" onclick="invitionmodel(' +
                                val['id'] + ')">Invitation</button></td>' +
                                '<td><a style="text-decoration:none !important;" class="join" href="' +
                                vdata['join_url'] +
                                '" target="_blank"><button type="button" class="btn join" >join Meeting</button></a>' +
                                '</td><td>' +
                                '<form method="Post" id="revi' + val['id'] + '" action="' +
                                routeUrl + '">' +
                                '<input type="hidden" name="_method" value="DELETE">' +
                                '<input type="hidden" name="id" value="' + val['id'] + '">' +
                                '<input type="hidden" name="zoom_id" value="' + vdata['id'] + '">' +
                                '</form>' +
                                '<button id="icon_button" type="button" onclick="del(' + val['id'] +
                                ')" disabled><i class="cursor-pointer fas fa-trash text-secondary" aria-hidden="true"></i></button>' +
                                '</td><tr>');
                        });
                    }
                }
            });

        }

        // Invitation Model 
        function invitionmodel(id) {
            $("#Invitation_Time").val("");
            $("#Invitation_join_url").val("");
            $("#idzoom").val("");
            $(".invitstaff").html("");
            $("#StaffClient_id").html("");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('googleMeet/invitaion') }}",
                type: "post",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#Meeting_id').toggle();
                    $("#idzoom").val(id);
                    $("#Invitation_Time").val(data.data.meetingtime);
                    $("#Invitation_join_url").val(data.data.meet_link);

                    if ((data.user_data) != '') {
                        $.each(data.user_data, function(key, val) {

                            var routeUrl = "{{ route('googleMeetDelmembers') }}";

                            if(val.profile_pic!='' && val.profile_pic!=null){
                            var image = `{{asset('public/assets/profile_pic/${val.profile_pic}') }}`;
                            }else{
                                var image = `{{asset(env('AdMINPROFILE')) }}`;
                            }
                            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                            $('.invitstaff').append('<tr><td><img style="width:50%" src="' + image +
                                '"></td>' + '<td>' + val.name + '</td>' +
                                '<td>' +
                                '<form method="Post" id="member' + val.id + '" action="' +
                                routeUrl + '">' +
                                '<input type="hidden" name="_token" value="' + CSRF_TOKEN + '">' +
                                '<input type="hidden" name="_method" value="DELETE">' +
                                '<input type="hidden" name="id" value="' + val.id + '">' +
                                '<input type="hidden" name="zoomid" value="' + id + '">' +
                                '</form>' +
                                '<button type="button" onclick="delmember(' + val.id +
                                ')" id="icon_button"><i class="cursor-pointer fas fa-trash text-secondary" aria-hidden="true"></i></button>' +
                                '</td><tr>');

                        });
                        $("#staff_client_list_id").html("");
                    }

                    $.each(data.user, function(key, val) {
                        // console.log(data.user)
                        $("#StaffClient_id").append(`<option value="${val.id}">${val.name}</option>`);
                    });

                }
            });

        }

        // Add Invitation Members
        function onAddMeetingInvitation() {
            var time = $("#Invitation_Time").val();
            var join_url = $("#Invitation_join_url").val();
            var user = $("#StaffClient_id").val();
            var idzoom = $("#idzoom").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('googleMeet/addinvit') }}",
                type: "post",
                data: {
                    'meetingId': idzoom,
                    'time': time,
                    'join_url': join_url,
                    'user': user
                },
                success: function(data) {
                    toastr.success(msg => data.msg);
                    if (data.data != '') {
                        var val = data.data;
                        if(val.profile_pic!='' && val.profile_pic!=null){
                          var image = `{{asset('public/assets/profile_pic/${val.profile_pic}') }}`;
                        }else{
                            var image = `{{asset(env('AdMINPROFILE')) }}`;
                        }
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        var routeUrl = "{{ route('googleMeetDelmembers') }}";

                        $('.invitstaff').append('<tr><td><img style="width:50%" src="' + image + '"></td>' +
                            '<td>' + val.name + '</td>' +
                            '<td>' +
                            '<form method="Post" id="member' + val.id + '" action="' + routeUrl + '">' +
                            '<input type="hidden" name="_token" value="' + CSRF_TOKEN + '">' +
                            '<input type="hidden" name="_method" value="DELETE">' +
                            '<input type="hidden" name="id" value="' + val.id + '">' +
                            '<input type="hidden" name="zoomid" value="' + idzoom + '">' +
                            '</form>' +
                            '<button type="button" onclick="delmember(' + val.id +
                            ')" id="icon_button"><i class="cursor-pointer fas fa-trash text-secondary" aria-hidden="true"></i></button>' +
                            '</td><tr>');

                    }
                    if ((data.user_data) != '') {
                        $("#staff_client_list_id").html("");
                    } else {
                        $("#staff_client_list_id").html(
                            '<tr><td colspan="3"><div class="alert join text-center" role="alert">No data available</div></td></tr>'
                        );
                    }
                }
            });

        }

        // Zoom Meting Deletation
        function del(id) {

            swal({
                title: "Delete?",
                text: "Are you sure to delete?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function(e) {
                    if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $('#revi' + id).submit();
                    } else {
                        e.dismiss;
                    }
                },
                function(dismiss) {
                    return false;
                })
        }

        // Zoom Meting Member Deletation
        function delmember(id) {
            swal({
                title: "Delete?",
                text: "Are you sure to delete?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function(e) {
                    if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $('#member' + id).submit();
                    } else {
                        e.dismiss;
                    }
                },
                function(dismiss) {
                    return false;
                })
        }

        // Zoom Api Deletation
        function delsecret(id) {
            swal({
                title: "Delete?",
                text: "Are you sure to delete?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function(e) {
                    if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $('#apiseceret' + id).submit();
                    } else {
                        e.dismiss;
                    }
                },
                function(dismiss) {
                    return false;
                })
        }

        // Zoom Api Model
        function apimodel(id) {
            $("#Meeting_api").toggle();
            $('#zoomapikey_edit').val("");
            $('#zoomapisecret_edit').val("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('zoom.getapidata') }}",
                type: "post",
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    $('#zoomapikey_edit').val(data.data.api_key);
                    $('#zoomapisecret_edit').val(data.data.api_secret);
                }
            });
        }

        // Zoom Api Activation
        function apiactive(id) {
            $(".activestatus" + id).html("");
            $(".activatedclass").html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('zoom.activeapi') }}",
                type: "post",
                data: {
                    id: id
                },
                success: function(data) {
                    var active = $(".activatedclass").text();

                    if (data.data == 0) {
                        $(".activatedclass").append("Deactived");
                        $(".activatedclass").css("color", "red");
                        $(".activestatus" + id).html("");
                        $(".activestatus" + id).append("Activated");
                        $(".activestatus" + id).css("color", "green");
                    } else {
                        if (active == 'Activated') {
                            $(".activatedclass").append("Activated");
                            $(".activatedclass").css("color", "green");
                        } else {
                            $(".activatedclass").append("Deactivated");
                            $(".activatedclass").css("color", "red");
                        }
                        $(".activestatus" + id).html("");
                        $(".activestatus" + id).append("Deactivated");
                        $(".activestatus" + id).css("color", "red");
                    }

                    if ((data.default).length == 0) {
                        $(".0").html("");
                        $(".0").append("Activated");
                        $(".0").css("color", "green");
                    }

                }
            });
        }

        //Upcoming Zoom Model
        function editmeeting(id) {
            $("#Meeting_upcoming").toggle();
            $("#zoom_meeting_id").val();
            $("#submit-form").attr("onclick", "");
            $("#meeting_date_edit").val("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('googleEditBlade') }}",
                type: "post",
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);

                    let date = new Date(data.data.meetingtime);
                    let dateString = date.toISOString().slice(0, 16);

                    $("#zoom_meeting_id").val(data.data.id);
                    $("#submit-form").attr("onclick", `editid(${id})`);
                    $("#meeting_date_edit").val(dateString);

                }
            });
        }

        //Upcoming Zoom Model Edit
        function editid(id) {
            var start_time = $("#meeting_date_edit").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('updateGooglemeeting') }}",
                type: "post",
                data: {
                    id: id,
                    'meetingtime': start_time,
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == 0) {
                        toastr.error(msg => data.data);
                    } else {
                        toastr.success(msg => 'Zoom Meeting Updated successfully');
                    }
                    $("#Meeting_upcoming").hide();

                }
            });
        }
    </script>

    {{-- <script>
        function newmeet() {
            var meetingtime = $('#meetingtime').val();
            if (meetingtime == "") {
                toastr.error('Meeting time field is required');
            } else {
                $('#meetTime').val(meetingtime);

                $.ajax({
                    url: "{{ url('googlemeet') }}",
                    type: 'POST',
                    data: {
                        'time': meetingtime,
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        console.log(data);
                    },
                });

                window.location.href = "{{ url('/googlemeet') }}" + "/" + meetingtime
            }
        }
    </script> --}}




    <script>
        flatpickr("#meetingtime", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            // Add any additional options here
        });
    </script>
@endpush
