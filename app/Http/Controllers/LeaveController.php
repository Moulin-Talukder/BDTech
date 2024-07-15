<?php

namespace App\Http\Controllers;

use App\Leave;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use DB;
use Carbon\Carbon;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('attendance')){
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))
                $all_permission[] = 'dummy text';
        $leaves=Leave::where('user_id',Auth::id())->get();
            return view('leave.create',compact('leaves','all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');

    }

    //Admin Leave index Section

    public function indexForAdmin()
    {

        $leaves=Leave::where('status',1)->get();
            return view('leave.admin_index',compact('leaves'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'leave_type' => 'required|string',
            'reason' => 'required|string',
            'num_of_days' => 'required|numeric',
        ]);
        $current_date = Carbon::now('Asia/Dhaka');
        $user_id = Auth::id();
        $employee=Employee::where('user_id',$user_id)->first();
        Leave::create([
            "date" => $current_date,
            "user_id" => $user_id,
            "employee_id" => $employee->id,
            'from_date'=>$request->from_date,
            'to_date'=>$request->to_date,
            'num_of_days'=>$request->num_of_days,
            'type'=>$request->leave_type,
            'reason'=>$request->reason,
            'status'=>1, // Status 1 = Pending
            'created_by' => Auth::id(),
        ]);
        return redirect('leave')->with('message', 'Leave application submitted inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Leave $leave)
    // {
    //     //
    // }
    public function update(Request $request, $id)
    {
        $leave=Leave::where('employee_id',$request->employee_id)->where('id',$request->leave_id)->first();
        $current_date = Carbon::now('Asia/Dhaka');
        $this->validate($request, [
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'leave_type' => 'required|string',
            'reason' => 'required|string',
            'num_of_days' => 'required|numeric',
        ]);

        $leave->update([
            "date" => $current_date,
            'from_date'=>$request->from_date,
            'to_date'=>$request->to_date,
            'num_of_days'=>$request->num_of_days,
            'type'=>$request->leave_type,
            'reason'=>$request->reason,
            'status'=>1, // Status 1 = Pending
            'updated_by' => Auth::id(),
        ]);
        return redirect()->back()->with('message', "Leave application updated successfully");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Leave::find($id)->delete();
        return redirect()->back()->with('not_prmitted', "Holiday deleted successfully");
    }

    // 
    public function approveLeave($id)
    {
        $leave=Leave::findOrfail($id);
        $leave->update([
            'status'=> 2,
            "updated_by"=> Auth::id()
        ]);
        return redirect()->back()->with('message', "Leave application approved !");
    }

    public function cancelLeave($id)
    {
        $leave=Leave::findOrfail($id);
        $leave->update([
            'status'=> 3,
            "updated_by"=> Auth::id()
        ]);
        return redirect()->back()->with('message', "Leave application Cancelled !");
    }
}
