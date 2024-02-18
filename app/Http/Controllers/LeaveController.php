<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use DB;
use Auth;
use DataTables;
use Str;


class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role != 1)
        {
            $leaves = DB::table('leaves')
            ->join('users', 'leaves.authorizer_user_id', '=', 'users.id')
            ->select('leaves.id','users.name','leaves.reason','leaves.start_date','leaves.end_date','leaves.leave_type', 'leaves.status', 'leaves.created_at')
            ->where('leaves.applied_user_id','=', Auth::user()->id)
            ->get();
        }
        else
        {
            $leaves = DB::table('leaves')
            ->join('users', 'leaves.applied_user_id', '=', 'users.id')
            ->select('leaves.id','users.name','leaves.reason','leaves.start_date','leaves.end_date','leaves.leave_type', 'leaves.status','leaves.created_at')
            ->where('leaves.authorizer_user_id','=', Auth::user()->id)
            ->get();
        }
        return view('leave.leave_record',compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leave.leave_application');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $attributes=$request->validate([
            'reason'=>'required|max:200',
            'start_date'=>'required|date|after_or_equal:'.now()->toDateString(),
            'end_date'=>'required|date|after_or_equal:'.$request->input('start_date'),
            'leave_type'=>'required',
        ]);
        
        $leaves=Leave::where(function($query) use ($request){
            $query->whereBetween('start_date', [$request->input('start_date'), $request->input('end_date')])
            ->orWhereBetween('end_date', [$request->input('start_date'), $request->input('end_date')]);     
         })->where('status','=',0)->where('applied_user_id', Auth::id())

         ->orWhere(function($query) use ($request){
            $query->whereBetween('start_date', [$request->input('start_date'), $request->input('end_date')])
            ->orWhereBetween('end_date', [$request->input('start_date'), $request->input('end_date')]);     
         })->where('status','=',1)->where('applied_user_id', Auth::id())->get()->toArray();
         
        
        if(count($leaves) > 0)
        {
            return redirect()->back()->with('message','You have already apply for leave');
        }

        $attributes['applied_user_id']=Auth::user()->id;
        $attributes['authorizer_user_id']=1;
        $leave=Leave::create($attributes);

        return redirect('leave')->with('message','Your leave application is applied successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function approve($leave_id, $id)
    {
        if($id == 1)
        {
            $leave=Leave::where('id','=', $leave_id)->update(['status'=> 1]);
            return redirect()->back()->with('success','Application Approved');
        }
        if($id == 2)
        {
            $leave=Leave::where('id','=', $leave_id)->update(['status'=> 2]);
            return redirect()->back()->with('success','Application Rjected');
        }
        if($id == 3)
        {
            $leave=Leave::where('id','=', $leave_id)->update(['status'=> 3]);
            return redirect()->back()->with('success','Application Cancelled');
        }
        
    }

    public function unread($id)
    {
        $leave= Leave::find($id)->update(['mark'=>1]);
        return response()->json([
            'success'=> $leave
        ]);
    }

    public function getLeave(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::user()->role != 1)
            {
                $leaves = DB::table('leaves')
                ->join('users', 'leaves.authorizer_user_id', '=', 'users.id')
                ->select('leaves.id','users.name','leaves.reason','leaves.start_date','leaves.end_date','leaves.leave_type', 'leaves.status', 'leaves.created_at')
                ->where('leaves.applied_user_id','=', Auth::user()->id)
                ->get();
            }
            else
            {
                $leaves = DB::table('leaves')
                ->join('users', 'leaves.applied_user_id', '=', 'users.id')
                ->select('leaves.id','users.name','leaves.reason','leaves.start_date','leaves.end_date','leaves.leave_type', 'leaves.status','leaves.created_at')
                ->where('leaves.authorizer_user_id','=', Auth::user()->id)
                ->get();
            }
            $userRole = auth()->user()->role;
            $dataTable = DataTables::of($leaves);
            
            // return Datatables::of($leaves)

            $dataTable->addIndexColumn();
            $dataTable->editColumn('reason',function($row){

                $reason='<td>'.Str::limit($row->reason, 30).'</td>';
                return $reason;
            });
            $dataTable->editColumn('status', function ($row) {
                $status='
                <td>
                <p class="text-xs font-weight-bold mb-0">';
                    if($row->status == 0)
                    {  
                        $status.=' <div class="badge bg-orange">Pending</div>';
                    }
                    elseif($row->status == 1)
                    {  
                        $status.='<div class="badge bg-success">Approved</div>';
                    }
                    elseif($row->status == 2)
                    {  
                        $status.='<div class="badge bg-danger">Rejected</div>';
                    }
                    elseif($row->status == 3)
                    {  
                        $status.='<div class="badge bg-warning">Cancelled</div>';
                    } 
                    $status.='
                </p>
                </td>';
                return $status;
                });

                if (auth()->user()->role == 1) {
                $dataTable->addColumn('action', function($row){
                    $actionBtn = '<td>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#leave'.$row->id.'"><i  class="cursor-pointer fas fa-eye text-secondary" ></i></button>
                </td>';
                    return $actionBtn;
                });
                }
                
                $dataTable->rawColumns(['action', 'status','reason']);
                return $dataTable->make(true);
        }
    }

}
