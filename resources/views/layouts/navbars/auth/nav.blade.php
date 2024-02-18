<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <button type="button" class="closebtn ms-2" onclick="openNav()" style="border:none;background-color:transparent"><i class="fa fas fa-arrow-left side d-none"></i></button>
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark breadcrumb-item text-sm" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize ">{{ str_replace('-', ' ', Request::path()) }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar"> 
            <div class="ms-md-3 pe-md-3 d-flex align-items-center">
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li>
                    <span class="user_info">{{ucfirst(Auth::user()->name)}}<br>{{Auth::user()->email}}</span>
                    <div class="profile-img" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src={{Auth::user()->profile_pic==null?asset(asset(env('AdMINPROFILE'))):asset('public/assets/profile_pic/'.Auth::user()->profile_pic)}} >
                    </div>
                    <ul class="dropdown-menu sub-navbar dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li class="li_itemx">
                            <a href="{{ url('/user-profile')}}" class="nav-link text-body font-weight-bold">
                               Edit Profile
                            </a>
                        </li>
                        <li class="li_itemx">
                            <a href="{{ url('/logout')}}" class="nav-link text-body font-weight-bold">
                               Log Out
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex px-3 align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer position-relative" id="bell-icon">
                        @if($leave_notifications->count() > 0)
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                        @endif
                    </i>
                    </a>
                    <ul class="dropdown-menu  sub-navbar dropdown-menu-end px-2 py-3 me-sm-n4"  aria-labelledby="dropdownMenuButton">

                        @forelse($leave_notifications as $leave_notification)
                            <li class="mb-2 dropdown-item">
                                @if(\Auth::user()->role == 1)
                                    <a class= "border-radius-md" href="{{url('leave')}}" >
                                        <div class="d-flex flex-row">
                                            <img src={{$leave_notification->profile_pic != null?asset('public/assets/profile_pic/'.$leave_notification->profile_pic):asset(env('AdMINPROFILE'))}} width="40" height="40" class="rounded-circle mx-2 mt-1 shadow">
                                            
                                            <div class="mt-1">
                                                <b class="text-dark fw-bold">{{$leave_notification->name}}</b><b> Apply for leave</b>
                                                <div style="text-align:start">
                                                {{-- <small>{{Carbon\Carbon::parse($leave_notification->created_at)->diffForHumans()}}</small> --}}
                                                <div class="ttime_{{$leave_notification->id}}"></div>
                                                <input type="hidden" id="time_{{$leave_notification->id}}" value="{{$leave_notification->created_at}}">
                                                </div>
                                            </div>
                                        </div>
                                    </a>   
                                @elseif(\Auth::user()->role == 0)

                                    <a class= "border-radius-md leave-btn" data-id="{{$leave_notification->id}}">
                                        <img src={{($leave_notification->status == 1 ?asset('public/assets/img/approve.png'): ($leave_notification->status == 2 ?asset('public/assets/img/reject.png'): ($leave_notification->status == 3 ?asset('public/assets/img/cancel.png'):'') ) )}} width="40" height="40" class="mx-1">

                                        <b class="text-dark fw-bold"> {{($leave_notification->status == 1 ?'Application Approved': ($leave_notification->status == 2 ?'Application Rejected': ($leave_notification->status == 3 ?'Application Cancelled':'') ) )}} </b>
                                    </a>

                                @endif
                         @empty
                                <a class="dropdown-item border-radius-md" href="javascript:;">No Notification</a> 
                            </li>
                        @endforelse
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->