@extends('layouts.user_type.auth')

<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

@section('content')
<style>
    .leave_application li
    {
        list-style-type: none;
    }
    .leave_application
    {
        padding: 1rem;
    }
    .bg-orange{
        background-color: #ff9933;
    }
    .bg-success, .btn-success
    {
        background-color: #009933;
    }
    .bg-danger, .btn-danger
    {
        background-color: #cc0000;
    }
    .bg-warning, .btn-warning
    {
        background-color: #ffcc00;
    }
</style>   
<div>
    <!-- Approve Modal -->
  @foreach($leaves as $leave)
  <div class="modal fade" id="leave{{$leave->id}}" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Leave Application</h4>
          <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">
                <ul class="leave_application">
                    <li><strong class="text-lg">Start Date</strong></li>{{$leave->start_date}}
                    <li><strong class="text-lg">End Date</strong></li>{{$leave->end_date}}
                    <li><strong class="text-lg">Leave Type</strong></li>{{$leave->leave_type}}
                    <li><strong class="text-lg">Reason for leave</li></strong>{{$leave->reason}}
                </ul>
            @if($leave->status == 0)
                <a href="{{url('approve/'.$leave->id.'/1')}}"><button type="button" class="btn btn-success">Approve</button></a>
                <a href="{{url('approve/'.$leave->id.'/2')}}"><button type="button" class="btn btn-danger">Reject</button></a>
            @endif
            @if($leave->status == 1)
                <a href="{{url('approve/'.$leave->id.'/3')}}"><button type="button" class="btn btn-warning">Cancel</button></a>
            @endif            
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> --}}
      </div>
    </div>
  </div>
  @endforeach

    {{-- Leave Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Leave Record</h5>
                        </div>
                        @if(Auth::user()->role != 1)
                            <a href="{{route('leave.create')}}" class="btn join btn-sm mb-2" type="button">Apply for leave</a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3">
                        <table class="table table-bordered data-table ">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder">
                                        {{__('S.No.')}}
                                    </th>
                                    @if(Auth::user()->role == 1)
                                    <th class="text-center text-uppercase text-xs font-weight-bolder">
                                        {{__('User Name')}}
                                    </th>
                                    @endif
                                    <th class="text-center text-uppercase text-xs font-weight-bolder">
                                        {{__('Reason')}}
                                    </th>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder">
                                        {{__('Start Date')}}
                                    </th>
                                    <th class="text-center text-uppercase text-uppercase text-xs font-weight-bolder">
                                        {{__('End Date')}}
                                    </th>
                                    <th class="text-center text-uppercase text-uppercase text-xs font-weight-bolder">
                                        {{__('Leave Type')}}
                                    </th>
                                    <th class="text-center text-uppercase text-uppercase text-xs font-weight-bolder">
                                        {{__('Status')}}
                                    </th>
                                    @if(Auth::user()->role == 1)
                                    <th class="text-center text-uppercase text-xs font-weight-bolder">
                                        {{__('Action')}}
                                    </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                {{-- @forelse($leaves as $leave)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$loop->iteration}}</p>
                                        </td>
                                        @if(Auth::user()->role == 1)
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$leave->name}}</p>
                                        </td>
                                        @endif
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$leave->reason}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$leave->start_date}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$leave->end_date}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$leave->leave_type}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                <div class="badge {{($leave->status == 0?'bg-orange':($leave->status == 1?'bg-success':($leave->status == 2?'bg-danger':($leave->status == 3?'bg-warning':''))))}}">
                                                    {{($leave->status == 0?'Pending':($leave->status == 1?'Approved':($leave->status == 2?'Rejected':($leave->status == 3?'Cancelled':''))))}}
                                                </div>
                                            </p>
                                        </td>
                                        @if(Auth::user()->role == 1)
                                        <td>
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#leave{{$leave->id}}"><i  class="cursor-pointer fas fa-eye text-secondary" ></i></button>
                                        </td>
                                        @endif
                                    </tr>
                                @empty --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        if ( $.fn.dataTable.isDataTable( '.data-table' ) ) {
                table = $('.data-table').DataTable();
        }
        else {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            // searchDelay: 500,
            ajax: "{{ route('get.leave') }}",
            columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            @if (auth()->user()->role == 1)
            {data: 'name', name: 'name'},
            @endif
            {data: 'reason', name: 'reason'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'leave_type', name: 'leave_type'}, 
            {data: 'status', name: 'status'},
            @if (auth()->user()->role == 1)
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
            @endif

        ]
        });
        if ( $.fn.dataTable.isDataTable( '.data-table' ) ) {
                table = $('.data-table').DataTable();
        }
    }               
    });
</script>
@endpush

 {{-- @endsection --}}
