@extends('layouts.user_type.auth')

@section('content')
@inject('carbon', 'Carbon\Carbon')
<div>

 <!-- Modal -->
 @foreach($users as $user)
    <div class="modal fade" id="example{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile_image card-img-top text-center border border-3" id="profile_image"><img src="{{asset('public/assets/profile_pic/'.$user->profile_pic)}}" height="200"></div>
                            <div id="profile_name" class="title mt-2 text-center h4">{{$user->name}}</div>
                            {{-- <p id="profile_desig">Programmer</p> --}}
                        </div>
                    </div>
                </div>
                <ul class="profile_info list-unstyled p-3" id="profile_info">
                    <li><span class="con-icon"><i class="fa fa-envelope"></i></span><div class="con-desc"><a href="mailto:mozammelhoque@gmail.com">{{$user->email}}</a></div></li>
                    <li><span class="con-icon"><i class="fa fa-phone"></i></span><div class="con-desc">{{$user->phone}}</div></li>
                    <li><span class="con-icon"><i class="fa fa-map-marker"></i></span><div class="con-desc">{{$user->location}}</div></li>
                </ul>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
 @endforeach
 
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Clients</h5>
                        </div>
                        {{-- <a href="{{url('client/create')}}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Client</a> --}}
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase  text-xs font-weight-bolder ">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase  text-xs font-weight-bolder ">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase  text-xs font-weight-bolder ">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase  text-xs font-weight-bolder ">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase  text-xs font-weight-bolder ">
                                        role
                                    </th>
                                    <th class="text-center text-uppercase  text-xs font-weight-bolder ">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase  text-xs font-weight-bolder ">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$loop->iteration}}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="{{('public/assets/img/team-2.jpg')}}" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->email}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Client</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$carbon::parse($user->created_at )->format('m/d/Y')}}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('staff.edit',$user->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <button class="btn" onclick="return confirm('Do you really want to edit this record?')"><i class="fas fa-user-edit text-secondary"></i></button>
                                        </a>
                                        <span>
                                            <form action="{{route('staff.destroy', $user->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn" onclick="return confirm('Do you really want to delete this record?')"><i  class="cursor-pointer fas fa-trash text-secondary" ></i></button>
                                            </form>
                                            
                                        </span>
                                        <span>
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#example{{$user->id}}"><i  class="cursor-pointer fas fa-eye text-secondary" ></i></button>
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert join text-center mt-2 mb-2 p-2" role="alert">No data Found</div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection