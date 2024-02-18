@extends('layouts.user_type.auth')

@section('content')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    #icon_button{
     border: none;
     background-color: transparent;
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
ul.tabs-nav li a:hover, ul.tabs-nav li a.active {
    background-color: #ffffff;
    width: 101%;
    left: 0;
    right: 0;
}
ul.tabs-nav li a:hover, ul.tabs-nav li a.active {
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

#dropdownMenuButton{
    text-align: center
}


#prevtable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#prevtable td, #prevtable th {
  border: 1px solid #ddd;
  padding: 8px;
  background-color:white !important;
}

#prevtable tr:nth-child(even){background-color: #f2f2f2;}

#prevtable tr:hover {background-color: #ddd;}

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
                <div class="card-header"><h5>Zoom Meeting</h5></div>
                  
                    <div class="card-body tabs-area p-0">
						<ul class="tabs-nav">
							<li>
                                <a class="panel active UpcomingMeeting" id="tabId-1" onclick="onFormPanel('UpcomingMeeting')" ><i class="fa fa-exchange zoomicon"></i>Upcoming Meeting</a>
                            </li>
							<li><a  class="panel PreviousMeeting" id="tabId-2" onclick="onFormPanelform('PreviousMeeting')" ><i class="fa fa-exchange zoomicon"></i>Previous Meeting</a></li>
							<li><a class="panel LiveMeeting" id="tabId-3" onclick="onFormPanelform('LiveMeeting')" ><i class="fa fa-exchange zoomicon"></i>Live Meeting</a></li>
							<li><a class="panel setting" id="tabId-4" onclick="onFormPanelform('setting')" ><i class="fa fa-cog zoomicon"></i>Zoom Settings</a></li>
						</ul>

						<div class="tabs-body">
                            <div class="float-right mb-2" style="text-align:right; margin-right:12px;">
                                <a onclick="onFormPanel('new')" id="new" href="javascript:void(0);" class="btn join  fl-right" ><i class="fa fa-plus"></i> New Meeting</a>
                                <a onclick="onFormPanel('back')" id="back"  href="javascript:void(0);" class="btn join btn-sm mb-3 btn-list fl-right d-none"><i class="fas fa-arrow-left" aria-hidden="true"></i></a>
                            </div>

							<!--Upcoming Meeting-->
                                <div id="UpcomingMeeting">
                                
                                    <!--Upcoming Table-->
                                    <div id="list-panel" class="mt-20">
                                        <div class="row" style="margin:auto;">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered dataTable no-footer" id="prevtable">
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Meeting</th>
                                                            <th>Invitation</th>
                                                            <th>join Meeting</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        @if(!empty($data))
                                                            @foreach($data as $zoomdata)
                                                            <tr>
                                                                {{-- <td>{{$zoomdata->id}}</td> --}}
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{ucfirst(json_decode($zoomdata->data)->topic)}}</td>
                                                                <td><button type="button" class="btn join " onclick="invitionmodel({{$zoomdata->id}})">Invitation</button></td>
                                                                <td>
                                                                    <a style="text-decoration:none !important;" class="join join " href="{{json_decode($zoomdata->data)->join_url}}" target="_blank"><button type="button" class="btn join " >join Meeting</button></a>
                                                                </td>
                                                                <td>
                                                                        <a href="javascript:;" class="edit btn btn-blue join" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">View</a>
                                                                        <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                                                        <li class="mb-2 li_itemx">
                                                                            <button id="icon_button"  onclick="editmeeting({{$zoomdata->id}})"><i class="fas fa-edit text-secondary" aria-hidden="true"></i></button>
                                                                        </li>
                                                                        <li class="mb-2 li_itemx">
                                                                            <form method="Post" id="revi{{$zoomdata->id}}"
                                                                                action="{{route('zoom.destroy', $zoomdata->id) }}">
                                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                <input type="hidden" name="_method" value="DELETE">
                                                                                <input type="hidden" name="id" value="{{$zoomdata->id}}">
                                                                                <input type="hidden" name="zoom_id" value="{{json_decode($zoomdata->data)->id}}">
                                                                            </form>
                                                                            <button type="button" onclick="del({{$zoomdata->id}})" id="icon_button" ><i class="cursor-pointer fas fa-trash text-secondary" aria-hidden="true"></i></button>
                                                                        </li>
                                                                    
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                                @endforeach
                                                        @else
                                                        <div class="alert join text-center" role="alert">No data Found</div>
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
                                                <form method="post" action="{{route('zoom.store')}}" data-validate="parsley" >
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="meeting_topic"> Meeting Topic</label>
                                                                <input type="text" name="topic" id="meeting_topic" class="form-control parsley-validated" data-required="true">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="meeting_date"> Meeting Date</label>
                                                                <input type="datetime-local" name="meeting_date" id="meeting_date" class="form-control parsley-validated" data-required="true" placeholder="yyyy-mm-ddThh:ii:ss">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="meeting_duration"> Duration</label>
                                                                <input type="number" name="duration" id="meeting_duration" min="1" class="form-control parsley-validated" data-required="true">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="timezone_id"> Time Zone</label>
                                                                <select id="timezone" name="timezone" class="selectpicker form-control edit" data-live-search="true" style="width:500%"  required disabled>
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
                                                                    <input id="participant_video" name="participant_video" type="checkbox">
                                                                    <label for="participant_video">Participant Video On/Off</label>
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
                                                                    <input id="enable_join_before_host" name="enable_join_before_host" type="checkbox">
                                                                    <label for="enable_join_before_host">Enable join before host</label>
                                                                    <span></span>
                                                                </div>
                                                                <div class="tw_checkbox checkbox_group">
                                                                    <input id="mute_participants_upon_entry" name="mute_participants_upon_entry" type="checkbox">
                                                                    <label for="mute_participants_upon_entry">Mute participants upon entry</label>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- <input type="text" name="MeetingId" id="MeetingId" class="d-none"> --}}

                                                    <div class="row tabs-footer mt-15">
                                                        <div class="col-lg-12">
                                                            <button type="submit" class="btn join e mr-10">Save</button>
                                                            <button onclick="onListPanel()" class="btn btn-danger">Cancel</button>
                                                            
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
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered dataTable no-footer " id="prevtable">
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Meeting</th>
                                                        <th>Invitation</th>
                                                        <th>join Meeting</th>
                                                        <th>Action</th>
                                                    </tr>
                                                
                                                    <tbody class="prevdata">
                                                    </tbody>
                                                    <div class="prevdatanot"></div>
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
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered dataTable no-footer" id="prevtable">
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Meeting</th>
                                                        <th>Invitation</th>
                                                        <th>join Meeting</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    <tbody class="livedatatr">
                                                    </tbody>
                                                    <div class="livedatatrnot"></div>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!--live Meeting-->
                            
                            <!--zoom setting-->
                                <div id="zoomsetting" class="d-none"> 
                                    <div class="row" style="margin:auto">
                                        <div class="col-lg-8">
                                            <form method="post" action="{{route('zoom.envdata')}}" data-validate="parsley" >
                                                @csrf
                                            <div class="form-group">
                                                <label for="zoomapikey"> Zoom API Key</label>
                                                <input type="password" name="zoomapikey" id="zoomapikey" class="form-control parsley-validated" data-required="true" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="zoomapisecret"> Zoom API Secret</label>
                                                <input type="password" name="zoomapisecret" id="zoomapisecret" class="form-control parsley-validated" data-required="true" value="">
                                                <small class="form-text text-muted"><a target="_blank" href="https://www.teamwork-laravel.themeposh.xyz/documentation/#zoommeeting">Zoom Meeting Documentation</a></small>
                                            </div>
                                            <button type="submit" class="btn join mr-10">Save</button>
                                            </form>
                                        </div>
                                        <div class="col-lg-8 mt-2">
                                            <table class="table table-bordered data-table">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Api Key</th>
                                                        <th>Api Secret</th>
                                                        <th>Status</th>
                                                        <th>Active</th>
                                                        <th>Active</th>
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
            <div class="row mt-2 mb-2 ms-2 me-2" >
                <div class="col-lg-12">
                    <form  data-validate="parsley" >
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="meeting_topic"> Meeting Topic</label>
                                    <input type="text" name="meeting_topic_edit" id="meeting_topic_edit" class="form-control parsley-validated" data-required="true">
                                    <input type="hidden" name="zoom_meeting_id" id="zoom_meeting_id" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="meeting_date"> Meeting Date</label>
                                    <input type="datetime-local" name="meeting_date_edit" id="meeting_date_edit" class="form-control parsley-validated" data-required="true" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="meeting_duration"> Duration</label>
                                    <input type="number" name="meeting_duration_edit" min="1" id="meeting_duration_edit" class="form-control parsley-validated" data-required="true">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="timezone_id"> Time Zone</label>
                                    <select name="timezone_id_edit" id="timezone_id_edit" class="chosen-select form-control parsley-validated" data-required="true" tabindex="-1" >
                                    </select>
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
                                        <input id="host_video_edit" name="host_video_edit" type="checkbox">
                                        <label for="host_video">Host Video On/Off</label>
                                        <span></span>
                                    </div>
                                    <div class="tw_checkbox checkbox_group">
                                        <input id="participant_video_edit" name="participant_video_edit" type="checkbox">
                                        <label for="participant_video">Participant Video On/Off</label>
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
                                        <input id="enable_join_before_host_edit" name="enable_join_before_host_edit" type="checkbox">
                                        <label for="enable_join_before_host">Enable join before host</label>
                                        <span></span>
                                    </div>
                                    <div class="tw_checkbox checkbox_group">
                                        <input id="mute_participants_upon_entry_edit" name="mute_participants_upon_entry_edit" type="checkbox">
                                        <label for="mute_participants_upon_entry">Mute participants upon entry</label>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row tabs-footer mt-15">
                            <div class="col-lg-12">
                                <a id="submit-form" href="javascript:void(0);" class="btn join mr-10">Save</a>
                                <a  href="javascript:void(0);" class="btn btn-warning close">Cancel</a>
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
                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body" style="overflow: auto; m-1">
                            <div class="row" style="margin:auto;">
                                <div class="col-md-12" id="CopyInvitation">
                                    <p class="mb-2" id="mtopic"></p>
                                    <p class="mb-2" id="mdatetime"></p>
                                    <p class="mb-2" id="mzoom"></p>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="StaffClient_id"> Staff/Client</label>
                                <select name="StaffClient_id" id="StaffClient_id" class="chosen-select form-control selectpicker" >
                                    <option value="">Select staff/client</option>
                                </select>
                            </div>
                            
                            <input type="text" name="Invitation_Meeting_Topic" id="Invitation_Meeting_Topic" class="d-none">
                            <input type="text" name="idzoom" id="idzoom" class="d-none">
                            <input type="text" name="Invitation_Time" id="Invitation_Time" class="d-none">
                            <input type="text" name="Invitation_Timezone" id="Invitation_Timezone" class="d-none">
                            <input type="text" name="Invitation_join_url" id="Invitation_join_url" class="d-none">
                            <input type="text" name="Invitation_Meeting_id" id="Invitation_Meeting_id" class="d-none">
                            <input type="text" name="Invitation_password" id="Invitation_password" class="d-none">
                            <center>
                                <a href="javascript:void(0);" onclick="onAddMeetingInvitation();" class="btn join mr-10">Invitation</a>
                                <a href="javascript:void(0);" class="btn btn-danger close" data-dismiss="modal">Cancel</a>
                            </center>
                        </div>
                    </form>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <h5>Staff/Client List</h5>
                        <div class="table-responsive-md">
                            {{-- <input class="form-control mb-1" id="staff_client_search_id" type="text" placeholder="Search.."> --}}
                            <table class="table table-bordered " width="100%">
                                <thead >
                                <tr>
                                    <th scope="col" width="10%">Photo</th>
                                    <th scope="col" width="80%">Staff/Client</th>
                                    <th scope="col" width="10%" class="text-center">Delete</th>
                                </tr>
                                <tbody class="invitstaff">
                                </tbody>
                                </thead>
                                <tbody id="staff_client_list_id"><tr><td colspan="3"><div class="alert join text-center" role="alert">No data available</div></td></tr></tbody>
                            </table>
                        </div>
                    </div>
                    
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
            <div class="row mt-2 mb-2 ms-2 me-2" >
              
                <div class="col-lg-12">
                <form method="post" action="{{route('zoom.editapi')}}" data-validate="parsley" >
                    @csrf
                <div class="form-group">
                    <label for="zoomapikey_edit"> Zoom API Key</label>
                    <input type="password" name="zoomapikey_edit" id="zoomapikey_edit" class="form-control parsley-validated" data-required="true" value="">
                </div>
                <div class="form-group">
                    <label for="zoomapisecret_edit"> Zoom API Secret</label>
                    <input type="password" name="zoomapisecret_edit" id="zoomapisecret_edit" class="form-control parsley-validated" data-required="true" value="">
                    <small class="form-text text-muted"><a target="_blank" href="https://www.teamwork-laravel.themeposh.xyz/documentation/#zoommeeting">Zoom Meeting Documentation</a></small>
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-blue" style="margin:auto;" >Save</button>
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


    <script>
        
        function onFormPanel(id){
            $('.panel').removeClass('active');
            $('.'+id).addClass('active');
            $("#new").removeClass('d-none');
            $("#back").addClass('d-none');
           if(id=='new' ){
            $("#list-panel").addClass('d-none');
            $("#form-panel").removeClass('d-none');
            $("#LiveMeeting").addClass('d-none');
            $("#UpcomingMeeting").removeClass('d-none');
            $("#PreviousMeeting").addClass('d-none');
            $("#new").addClass('d-none');
            $("#back").removeClass('d-none');
           }else if(id=='back' || id=='UpcomingMeeting'){
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

        function onFormPanelform(id){
            $('.panel').removeClass('active');
            $('.'+id).addClass('active');
           if(id=='PreviousMeeting' ){
            $("#LiveMeeting").addClass('d-none');
            $("#UpcomingMeeting").addClass('d-none');
            $("#PreviousMeeting").removeClass('d-none');
            $("#zoomsetting").addClass('d-none');
            $("#new").addClass('d-none');
            $("#back").addClass('d-none');
            prevdata();
           }else if(id=='LiveMeeting'){
            $("#LiveMeeting").removeClass('d-none');
            $("#UpcomingMeeting").addClass('d-none');
            $("#PreviousMeeting").addClass('d-none');
            $("#zoomsetting").addClass('d-none');
            $("#new").addClass('d-none');
            $("#back").addClass('d-none');
            livedata();
           }else{
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
                columns: [
                    {data: 'id', name: 'id'},
                    // {data: 'api_key', api_key: 'api_key'},4
                    { data: 'api_key', name: 'api_key', render: function(data, type, full, meta) {
                        if (data.length > 5) {
                        return data.substring(0, 5) + '...';
                        } else {
                        return data;
                        }
                    }},
                    { data: 'api_secret', name: 'api_secret', render: function(data, type, full, meta) {
                        if (data.length > 5) {
                        return data.substring(0, 5) + '...';
                        } else {
                        return data;
                        }
                    }},
                    // {data: 'api_secret', api_secret: 'api_secret'},
                    {data: 'st', st: 'st'},
                    {data: 'actived', actived: 'actived'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
               
                ],
                createdRow: function ( row, data, index ) {
                    // data.substr(0, 1) 
                    $('td', row).eq(4).addClass(data['active']);
                    
                    $(row).find("td:eq(4).0").css("color","red");
                    $(row).find("td:eq(4).1").css("color","green");

                    if (data['status'] = 0) {
                        $('td', row).eq(4).addClass(` activatedclass activestatus${data['id']}`);
                    } else {
                        $('td', row).eq(4).addClass(` activatedclass activestatus${data['id']}`);
                    }
                }
            });
           }
        }

        $(".close").click(function(){
                $('#Meeting_id').hide();
                $('#Meeting_api').hide();
                $('#Meeting_upcoming').hide();
        })

        //   Previous Meeting 
        function prevdata(){   
           
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('zoom.prevdata') }}",
                type: "post",
            
                success: function(data) {
                    $('.prevdata').html(""); 
                    $('.prevdatanot').html("");
                    if(data==''){
                        $('.prevdatanot').append(`<div class="alert join text-center" role="alert">No data Found</div>`);
                    }else{
                        $.each(data, function(key,val) {
                            var vdata = JSON.parse(val['data']);
                            // var routeUrl = "'{{route('zoom.destroy', "+val['id']+") }}'";
                            
                            var routeUrl = '{{ route("zoom.destroy", ":id") }}';
                            routeUrl = routeUrl.replace(':id', val['id']);
                            
                            $('.prevdata').append('<tr pretable><td>'+(key+1)+'</td>'+
                            '<td>'+vdata['topic']+'</td>'+
                            '<td><button type="button" class="btn join " onclick="invitionmodel('+val['id']+')" disabled>Invitation</button></td>'+
                            '<td><button type="button" class="btn join " disabled>join Meeting</button>'+
                            '</td><td>'+'<a href="javascript:;" class="edit btn btn-blue join" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">View</a><ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuButton"><li class="mb-2 li_itemx">'+
                                '<form method="Post" id="revi'+val['id']+'" action="'+routeUrl+'">'+
                                '<input type="hidden" name="_method" value="DELETE">'+
                                '<input type="hidden" name="id" value="'+val['id']+'">'+
                                '<input type="hidden" name="zoom_id" value="'+vdata['id']+'">'+
                            '</form>'+
                            '<button id="icon_button" style="cursor:none;" type="button" disabled ><i class="cursor-pointer fas fa-trash text-secondary" aria-hidden="true"></i></button>'+
                                '</li></ul>'+
                        '</td></tr>');
                        }); 
                    }
                }
            });

        }

        // Live Meeting
        function livedata(){     
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('zoom.livedata') }}",
                type: "post",
            
                success: function(data) {
                    $('.livedatatr').html(""); 
                    $('.livedatatrnot').html("");
                    if(data=='' || data.data==''){
                        $('.livedatatrnot').append(`<div class="alert join text-center" role="alert">No data Found</div>`);
                    }else{
                        $.each(data.data, function(key,val) {
                            console.log(val);
                            var vdata = val['data'];
                            // var routeUrl = "'{{route('zoom.destroy', "+val['id']+") }}'";
                            
                            var routeUrl = '{{ route("zoom.destroy", ":id") }}';
                            routeUrl = routeUrl.replace(':id', val['id']);

                            $('.livedatatr').append('<tr><td>'+(key+1)+'</td>'+
                            '<td>'+vdata['topic']+'</td>'+
                            '<td><button type="button" class="btn join " onclick="invitionmodel('+val['id']+')">Invitation</button></td>'+
                            '<td><a style="text-decoration:none !important;" class="join" href="'+vdata['join_url']+'" target="_blank"><button type="button" class="btn join " >join Meeting</button></a>'+
                                '</td><td>'+'<a href="javascript:;" class="edit btn btn-blue join" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">View</a><ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuButton"><li class="mb-2 li_itemx">'+
                                '<form method="Post" id="revi'+val['id']+'" action="'+routeUrl+'">'+
                                '<input type="hidden" name="_method" value="DELETE">'+
                                '<input type="hidden" name="id" value="'+val['id']+'">'+
                                '<input type="hidden" name="zoom_id" value="'+vdata['id']+'">'+
                            '</form>'+
                            '<button id="icon_button" style="cursor:none;" type="button" disabled ><i class=" fas fa-trash text-secondary" aria-hidden="true"></i></button>'+
                                '</li></ul>'+
                        '</td></tr>');
                        }); 
                    }
                }
            });

        }

        // Invitation Model 
        function invitionmodel(id) {
                $("#mtopic").html("");
                $("#mdatetime").html("");
                $("#mzoom").html("");
                $("#Invitation_Meeting_Topic").val("");
                $("#Invitation_Time").val("");
                $("#Invitation_Timezone").val("");
                $("#Invitation_join_url").val("");
                $("#Invitation_Meeting_id").val("");
                $("#Invitation_password").val("");
                $("#idzoom").val("");
                $(".invitstaff").html("");
                $("#StaffClient_id").html("");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('zoom.invitaion') }}",
                type: "post",
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);
                $('#Meeting_id').toggle();
                $("#mtopic").append(`<b>Meeting Topic</b>: ${data.data.topic}`);
                $("#mdatetime").append(` <b>Time</b>:${data.data.start_time} ${data.data.timezone}`);
                $("#mzoom").append(`<b>join Zoom Meeting</b>:<a href="${data.data.start_url}" target="_blank">${data.data.start_url}</a></p><p class="mb-0"><b>Meeting ID</b>: ${data.data.id}</p><p><b>Passcode</b>: ${data.data.password}`);
                $("#idzoom").val(id);
                $("#Invitation_Meeting_Topic").val(data.data.topic);
                $("#Invitation_Time").val(data.data.start_time);
                $("#Invitation_Timezone").val(data.data.timezone);
                $("#Invitation_join_url").val(data.data.join_url);
                $("#Invitation_Meeting_id").val(data.data.id);
                $("#Invitation_password").val(data.data.password);

                if((data.user_data)!=''){
                    $.each(data.user_data, function(key,val) {
                        var routeUrl = "{{route('zoom.delmembers') }}";

                        if(val.profile_pic!='' && val.profile_pic!=null ){
                          var image = `{{asset('public/assets/profile_pic/${val.profile_pic}') }}`;
                        }else{
                            var image = `{{asset(env('AdMINPROFILE')) }}`;
                        }
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                            $('.invitstaff').append('<tr><td><img style="width:50%" src="'+image+'"></td>'+
                            '<td>'+val.name+'</td>'+
                            '<td>'+
                                '<form method="Post" id="member'+val.id+'" action="'+routeUrl+'">'+
                                    '<input type="hidden" name="_token" value="'+CSRF_TOKEN+'">'+
                                '<input type="hidden" name="_method" value="DELETE">'+
                                '<input type="hidden" name="id" value="'+val.id+'">'+
                                '<input type="hidden" name="zoomid" value="'+id+'">'+
                            '</form>'+
                            '<button type="button" onclick="delmember('+val.id+')" id="icon_button"><i class="cursor-pointer fas fa-trash text-secondary" aria-hidden="true"></i></button>'+
                        '</td><tr>');

                    });
                    $("#staff_client_list_id").html("");
                }
                
                $.each(data.user, function(key,val) {
                    $("#StaffClient_id").append(`<option value="${val.id}">${val.name}</option>`);
                });

                }
            });

        }

         // Add Invitation Members
        function onAddMeetingInvitation(){     
            var topic =  $("#Invitation_Meeting_Topic").val();
            var time =  $("#Invitation_Time").val();
            var timezone =  $("#Invitation_Timezone").val();
            var join_url =  $("#Invitation_join_url").val();
            var id =  $("#Invitation_Meeting_id").val();
            var pass =  $("#Invitation_password").val();
            var user =  $("#StaffClient_id").val();
            var idzoom =  $("#idzoom").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('zoom.addinvit') }}",
                type: "post",
                data: {
                    id: id,
                    'idzoom':idzoom,
                    'topic':topic,
                    'time':time,
                    'timezone':timezone,
                    'join_url':join_url, 
                    'pass':pass,
                    'user':user
                },
                success: function(data) {
                   toastr.success(msg =>data.msg);
                   if(data.data!=''){
                    var val = data.data;
                    if(val.profile_pic!='' && val.profile_pic!=null){
                          var image = `{{asset('public/assets/profile_pic/${val.profile_pic}') }}`;
                        }else{
                            var image = `{{asset(env('AdMINPROFILE')) }}`;
                        }
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    var routeUrl = "{{route('zoom.delmembers') }}";
                    
                            $('.invitstaff').append('<tr><td><img style="width:50%" src="'+image+'"></td>'+
                            '<td>'+val.name+'</td>'+
                            '<td>'+
                                '<form method="Post" id="member'+val.id+'" action="'+routeUrl+'">'+
                                    '<input type="hidden" name="_token" value="'+CSRF_TOKEN+'">'+
                                '<input type="hidden" name="_method" value="DELETE">'+
                                '<input type="hidden" name="id" value="'+val.id+'">'+
                                '<input type="hidden" name="zoomid" value="'+idzoom+'">'+
                            '</form>'+
                            '<button type="button" onclick="delmember('+val.id+')" id="icon_button"><i class="cursor-pointer fas fa-trash text-secondary" aria-hidden="true"></i></button>'+
                        '</td><tr>');

                    }
                    if((data.user_data)!=''){
                        $("#staff_client_list_id").html("");
                    }else{
                        $("#staff_client_list_id").html('<tr><div class="alert join text-center" role="alert">No data Found</div></tr>');
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
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $('#revi' + id).append('<input type="hidden" name="_token" value="' + CSRF_TOKEN + '">').submit();
                } else {
                    result.dismiss;
                }
            }, function(dismiss) {
                return false;
            });
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
                        $('#member' + id).append('<input type="hidden" name="_token" value="' + CSRF_TOKEN + '">').submit();
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
        function apimodel(id){
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
         function apiactive(id){
            $(".activestatus"+id).html("");
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
                    if(data.data==0){
                        $(".activatedclass").append("Deactived");
                        $(".activatedclass").css("color","red");
                        $(".activestatus"+id).html("");
                        $(".activestatus"+id).append("Activated");
                        $(".activestatus"+id).css("color","green");
                    }else{
                        if(active=='Activated'){
                            $(".activatedclass").append("Activated");
                            $(".activatedclass").css("color","green");
                        }else{
                            $(".activatedclass").append("Deactivated");
                            $(".activatedclass").css("color","red");
                        }
                        $(".activestatus"+id).html("");
                        $(".activestatus"+id).append("Deactivated");
                        $(".activestatus"+id).css("color","red");
                    }

                   if((data.default).length==0){
                        $(".1").html("");
                        $(".1").append("Activated");
                        $(".1").css("color","green");
                   }
             
                }
            });
        }

        //Upcoming Zoom Model
        function editmeeting(id){
            $("#Meeting_upcoming").toggle();
            $("#zoom_meeting_id").val();
            $("#submit-form").attr("onclick","");
            $("#meeting_topic_edit").val("");
            $("#meeting_date_edit").val("");
            $("#meeting_duration_edit").val("");
            $("#timezone_id_edit").val("");
            $("#host_video_edit").val("");
            $("#participant_video_edit").val("");
            $("#enable_join_before_host_edit").val("");
            $("#mute_participants_upon_entry_edit").val("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('zoom.editmeeting') }}",
                type: "post",
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);

                    let date = new Date(data.data.start_time);
                    let dateString =  date.toISOString().slice(0, 16);

                    $("#zoom_meeting_id").val(data.data.id);
                    $("#submit-form").attr("onclick",`editid(${id})`);
                    $("#meeting_topic_edit").val(data.data.topic);
                    $("#meeting_date_edit").val(dateString);
                    $("#meeting_duration_edit").val(data.data.duration);
                    $("#timezone_id_edit").append(`<option selected value="${data.data.timezone}">${data.data.timezone}</option>`);
                    $("#host_video_edit").attr("checked",data.data.settings.host_video);
                    $("#participant_video_edit").attr("checked",data.data.settings.participant_video);
                    $("#enable_join_before_host_edit").attr("checked",data.data.settings.join_before_host);
                    $("#mute_participants_upon_entry_edit").attr("checked",data.data.settings.mute_upon_entry);
                 
                }
            });
        }
        
        //Upcoming Zoom Model Edit
        function editid(id){
            var zoom_meeting_id= $("#zoom_meeting_id").val();
            var topic= $("#meeting_topic_edit").val();
            var start_time = $("#meeting_date_edit").val();
            var duration = $("#meeting_duration_edit").val();
            var timezone = $("#timezone_id_edit").val();
            var host_video = $("#host_video_edit").prop('checked');
            var participant_video = $("#participant_video_edit").prop('checked');
            var enable_join_before_host = $("#enable_join_before_host_edit").prop('checked');
            var mute_participants_upon_entry = $("#mute_participants_upon_entry_edit").prop('checked');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ url('zoom.updatemeeting') }}",
                type: "post",
                data: {
                    id: id,
                    zoom_meeting_id:zoom_meeting_id,
                    topic:topic,
                    start_time:start_time,
                    duration:duration,
                    timezone:timezone,
                    host_video:host_video,
                    participant_video:participant_video,
                    enable_join_before_host:enable_join_before_host,
                    mute_participants_upon_entry:mute_participants_upon_entry
                },
                success: function(data) {
                    console.log(data);
                    if(data.status==0){
                       toastr.error(msg =>data.data);
                    }else{
                       toastr.success(msg =>'Zoom Meeting Updated successfully');
                    }
                    $("#Meeting_upcoming").hide();

                }
            });
        }

    </script>
@endpush