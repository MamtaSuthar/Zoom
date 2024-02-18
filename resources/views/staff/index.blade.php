@extends('layouts.user_type.auth')

@section('content')

<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    .btn-form1{
        background-color: transparent; 
    }
    .btn-class{
    border: none;
    background-color: transparent;
    }

    .edit
    {
        box-shadow:none;
    }

    .drpdwn-menu {
        min-width: 6rem !important;
        text-align: center
    }
    
    .li_itemx:hover{
        background-color: #f2f2f2 
    }
    
    #dropdownMenuButton{
        text-align: center
    }

</style>

<div>
  <!-- Staff View Modal -->
  @foreach($users as $user)
    <div class="modal" id="profile{{$user->id}}" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Staff Profile</h4>
                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @if($user->profile_pic == null)
                                <div class="profile_image card-img-top text-center" id="profile_image"><img src="{{asset(env('AdMINPROFILE'))}}" height="200"></div>
                            @else
                                <div class="profile_image card-img-top text-center" id="profile_image"><img src="{{asset('public/assets/profile_pic/'.$user->profile_pic)}}" height="200"></div>
                            @endif
                            <div id="profile_name" class="title mt-2 text-center h4">{{$user->name}}</div>
                            <p id="profile_design" class="text-center">{{$user->designation}}</p>
                        </div>
                    </div>
                </div>
                <ul class="profile_info list-unstyled p-3" id="profile_info">
                    <li><span class="con-icon"><i class="fa fa-envelope"></i></span><div class="con-desc"><a href="mailto:mozammelhoque@gmail.com">{{$user->email}}</a></div></li>
                    <li><span class="con-icon"><i class="fa fa-phone"></i></span><div class="con-desc">{{$user->phone}}</div></li>
                    <li><span class="con-icon"><i class="fa fa-map-marker"></i></span><div class="con-desc">{{$user->location}}</div></li>
                </ul>            
            </div>
            </div>
        </div>
    </div>
  @endforeach

    {{-- Staff Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Staff</h5>
                        </div>
                        <a href="{{url('staff/create')}}" class="btn join btn-sm mb-2" type="button">+&nbsp; New Staff</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3">
                        <table class="table table-bordered data-table">
                            {{-- @if(!empty($users->toArray())) --}}
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder ">
                                        {{__('S.No.')}}
                                    </th>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder ">
                                        {{__('Employee ID')}}
                                    </th>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder ">
                                        {{__('Name')}}
                                    </th>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder ">
                                        {{__('Email')}}
                                    </th>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder ">
                                        {{__('Phone')}}
                                    </th>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder ">
                                        {{__('role')}}
                                    </th>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder ">
                                        {{__('DOB')}}
                                    </th>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder ">
                                        {{__('Action')}}
                                    </th>
                                </tr>
                            </thead>
                            {{-- @endif --}}
                            <tbody class="text-center">
                                {{-- @forelse($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$loop->iteration}}</p>
                                    </td>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->emp_id}}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src={{$user->profile_pic == null?asset(env('AdMINPROFILE')):asset('public/assets/profile_pic/'.$user->profile_pic)}} class="avatar avatar-l me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ucfirst($user->name)}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ucfirst($user->email)}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->phone}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">staff</p>
                                    </td>                      
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$user->dob}}</span>
                                    </td>
                                    <td class="text-center">
                                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-list text-secondary"></i>
                                            </a>
                                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                                <div class="d-flex flex-row">
                                                    <div class="col">
                                                        <li class="mb-2">
                                                            <a href="{{route('staff.edit',$user->id)}}" class="link-primary" ><button class="btn-class"><i class="fas fa-user-edit text-secondary btn-hover"></i></button></a>
                                                        </li>
                                                    </div>
                                                    <div class="col">
                                                        <li class="mb-2">
                                                            <button id="delete-btn" class="btn-class" data-id="{{$user->id}}"><i  class="cursor-pointer fas fa-trash text-secondary btn-class" ></i></button>
                                                        </li>
                                                    </div>
                                                    <div class="col">
                                                        <li class="mb-2">
                                                            <button type="button" class="btn-class" data-bs-toggle="modal" data-bs-target="#profile{{$user->id}}"><i  class="cursor-pointer fas fa-eye text-secondary btn-class" ></i></button>
                                                        </li>
                                                    </div>
                                                    <div class="col">
                                                        @if($user->terminated == 0)
                                                        <li class="mb-2">
                                                            <a href="{{url('terminate/'.$user->id)}}"><button type="button" class="btn-class"><i  class="cursor-pointer fas fa-check text-secondary" ></i></button></a>
                                                        </li>
                                                        @else
                                                        <li class="mb-2">
                                                            <a href="{{url('terminate/'.$user->id)}}"><button type="button" class="btn-class"><i  class="cursor-pointer fas fa-window-close text-secondary" ></i></button></a>
                                                        </li>
                                                        @endif
                                                    </div>
                                                </div>
                                            </ul>
                                    </td>
                                </tr> --}}
                                {{-- @empty --}}
                                 {{-- <div class="col-lg-12 mt-2 p-2"><div class="alert alert-warning" role="alert">No data Found</div></div> --}}
                                {{-- @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 @endsection

@push('custom-scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $.fn.dataTable.ext.errMode = 'throw';
            if ( $.fn.dataTable.isDataTable( '.data-table' ) ) {
                    table = $('.data-table').DataTable();
            }

            else 
            {
                var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('get.data') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'emp_id', name: 'emp_id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'role', name: 'role'}, 
                {data: 'dob', name: 'dob'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
                ]

                });
            }

                $(document).on('click','#delete-btn',function(){
                    var id= $(this).data('id');
                    console.log(id)

                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) 
                        {
                            $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}" 
                            },
                            type: "DELETE",
                            url: "staff/"+id,
                            success: function (response) 
                        {
                            if(response.data)
                            window.location.reload()
                            toastr.success('Record has been successfully deleted')
                        }

                        });  
                    }
                })
            });
        });
    </script>
@endpush   

