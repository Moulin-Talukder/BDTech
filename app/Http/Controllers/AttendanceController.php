<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\HrmSetting;
use App\Attendance;
use Auth;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // public function All()
    // {
    //     $role = Role::find(Auth::user()->role_id);
    //     if($role->hasPermissionTo('attendance')) {
    //         $lims_employee_list = Employee::where('is_active', true)->get();
    //         $lims_hrm_setting_data = HrmSetting::latest()->first();
    //         $general_setting = DB::table('general_settings')->latest()->first();
    //         if(Auth::user()->role_id > 2 && $general_setting->staff_access == 'own')
    //             $lims_attendance_all = Attendance::orderBy('id', 'desc')->where('employee_id', Auth::id())->get();
    //         else
    //             $lims_attendance_all = Attendance::orderBy('id', 'desc')->get();
    //         return view('attendance.index', compact('lims_employee_list', 'lims_hrm_setting_data', 'lims_attendance_all'));
    //     }
    //     else
    //         return redriect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    // }

        //Admin View Attendance Dashboard
    public function index(Request $request){

            $today_date = Carbon::now('Asia/Dhaka')->format('Y-m-d');
            $all_employee=$employee=Employee::all();
            $role = Role::find(Auth::user()->role_id);
            $data=true;
            if($role->hasPermissionTo('attendance')) {
                $general_setting = DB::table('general_settings')->latest()->first();
                if(Auth::user()->role_id == 1 && $general_setting->staff_access == 'own')
                    $lims_attendance_all = Attendance::orderBy('id', 'desc')->where('date', $today_date)->get();
                else
                    $lims_attendance_all = Attendance::orderBy('id', 'desc')->where('date', $today_date)->get();
                return view('attendance.allemployeeattendance', compact('lims_attendance_all','all_employee','data'));
            }
            else
                return redriect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
        }

    //Employee Attendance
    public function employeeAttendance(){

        $date = Carbon::now('Asia/Dhaka');
        $attendance = Attendance::orderBy('id', 'desc')->where('employee_id', Auth::id())->get();
        $employee=Employee::where('user_id',Auth::id())->first();
        $joblength=$employee->joining_date;
        $job_duration=Carbon::parse($date)->diff($joblength);
        $user = Auth::user();
        return view('attendance.myattendance', compact('date', 'attendance', 'employee','job_duration','user'));
    }


    //
    public function dateWiseReportGet(){
        $data=true;
        $today_date = Carbon::now('Asia/Dhaka')->format('Y-m-d');
        $lims_attendance_all = Attendance::orderBy('id', 'desc')->where('date', $today_date)->get();
        $all_employee=$employee=Employee::all();
        return view('attendance.allemployeeattendance', compact('lims_attendance_all','all_employee','data'));
    }

    public function dateWiseReportPost(Request $request){
        $messages = array(
            'start_date.required' => 'Start date is Required.',
            'end_date.required' => 'End date is Required.',

        );
        // $this->validate($request, array(
        //     'start_date' => 'date',
        //     'end_date' => 'date',
        // ), $messages);
        $start_date =  date('Y-m-d', strtotime($request->start_date));
        $end_date =  date('Y-m-d', strtotime($request->end_date));
        if($request->employee && $end_date){
            $data=false;
            $date = Carbon::now('Asia/Dhaka');
            $all_employee=$employee=Employee::all();
            $employee=Employee::where('id',$request->employee)->first();
            $joblength=$employee->joining_date;
            $job_duration=Carbon::parse($date)->diff($joblength);
            $lims_attendance_all=Attendance::where('employee_id',$request->employee)->whereBetween('date', [$start_date, $end_date])->get();
            return view('attendance.allemployeeattendance', compact('lims_attendance_all','employee','all_employee','date','job_duration','data','start_date'));
        }
        $data=true;
        $all_employee=$employee=Employee::all();
        $lims_attendance_all=Attendance::whereBetween('date', [$start_date, $end_date])->get();
        return view('attendance.allemployeeattendance', compact('lims_attendance_all','all_employee','data'));
    }

    public function monthWiseReportGet(Request $request){
        $dates=null;

        return view('attendance.monthly_attendance',compact('dates'));
    }
    public function monthWiseReportPost(Request $request)
    {
        $today = \Carbon\Carbon::parse($request->month)->format('m');
        $dates = [];

        for($i=1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('F-d-Y');
        }


        return view('attendance.monthly_attendance');
    }
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $current_date = Carbon::now('Asia/Dhaka');
        $employee=Employee::where('user_id',Auth::user()->id)->first();
        $checkstatus=Attendance::where('employee_id',$employee->id)->whereDate('created_at', $current_date->toDateString())->first();
        $lims_hrm_setting_data = HrmSetting::latest()->first();

        if($checkstatus==null || $checkstatus->time == null){
            $attendance=new Attendance();
            $attendance->employee_id = $request->employee_id;
            $attendance->date = $request->date;
            $attendance->attendance_type = $request->attendance_type;
            $attendance->time = $current_date;
            $attendance->location = $request->location;
            $attendance->note = $request->note;

            if($request->attendance_type == 0 && $request->time <= $lims_hrm_setting_data->checkin){
                $attendance->status = 1; // Status 1 is ok.
            }
            elseif($request->attendance_type == 1 && $request->time >= $lims_hrm_setting_data->checkout){
                $attendance->status = 1;  // Status 1 is ok.
            }
            elseif($request->attendance_type == 0 && $request->time >= $lims_hrm_setting_data->checkin){
                $attendance->status = 2;  // Status 2 is for late.
            }
            elseif($request->attendance_type == 1 && $request->time <= $lims_hrm_setting_data->checkout){
                $attendance->status = 3;  // Status 3 is for early leave.
            }
            $attendance->save();
            return redirect()->back()->with('message', 'Checked in created successfully');
        }else{
                $checkstatus->checkout=$current_date;
                $checkstatus->save();
                return redirect()->back()->with('message', 'Checked Out created successfully');
        }

        // $attendance = new Attendance();

        // $attendance->employee_id = $request->employee_id;
        // $attendance->date = $request->date;
        // $attendance->attendance_type = $request->attendance_type;

        // if($request->attendance_type == 0){
        //     $attendance->time = $request->time;
        // }else{
        //     $attendance->checkout = $request->time;
        // }
        // $attendance->location = $request->location;
        // $attendance->note = $request->note;

        // if($request->attendance_type == 0 && $request->time <= $lims_hrm_setting_data->checkin){
        //     $attendance->status = 0; // Status 1 is ok.
        // }
        // elseif($request->attendance_type == 1 && $request->time >= $lims_hrm_setting_data->checkout){
        //     $attendance->status = 1;  // Status 1 is ok.
        // }
        // elseif($request->attendance_type == 0 && $request->time >= $lims_hrm_setting_data->checkin){
        //     $attendance->status = 2;  // Status 2 is for late.
        // }
        // elseif($request->attendance_type == 1 && $request->time <= $lims_hrm_setting_data->checkout){
        //     $attendance->status = 3;  // Status 3 is for early leave.
        // }

        // $attendance->save();
        // return redirect()->back()->with('message', 'Attendance created successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $attendance=Attendance::where('id', $id)->first();
        return view('attendance.editattendance', compact('attendance'));

    }


    public function update(Request $request, $id)
    {

        $attendance=Attendance::where('id', $id)->first();
        if($request->time!=null && $request->checkout!=null){
            $attendance->update([
                'time' => $request->time,
                'checkout'=> $request->checkout,
            ]);
        }elseif($request->time!=null){
            $attendance->update([
                'time' => $request->time,
                ]);
        }else{
            $attendance->update([
            'checkout'=> $request->checkout,
            ]);
        }
        return redirect('attendance')->with('message', 'Attendance Adjusted successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $attendance_id = $request['attendanceIdArray'];
        foreach ($attendance_id as $id) {
            $lims_attendance_data = Attendance::find($id);
            $lims_attendance_data->delete();
        }
        return 'Attendance deleted successfully!';
    }

    public function destroy($id)
    {
        $lims_attendance_data = Attendance::find($id);
        $lims_attendance_data->delete();
        return redirect()->back()->with('not_permitted', 'Attendance deleted successfully');
    }
}
