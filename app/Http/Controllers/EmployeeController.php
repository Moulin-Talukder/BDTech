<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use App\Thana;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Warehouse;
use App\Biller;
use App\Employee;
use App\User;
use App\Department;
use Auth;
use DB;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{

    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('employees-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if (empty($all_permission))
                $all_permission[] = 'dummy text';
            $lims_employee_all = Employee::get();
            $lims_department_list = Department::where('is_active', true)->get();
            // dd($all_permission);
            return view('employee.index', compact('lims_employee_all', 'lims_department_list', 'all_permission'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function create()
    {
        $employeeOld = request()->session()->get('employeeOldValue');
        //dd($serviceOld);
        request()->session()->forget('employeeOldValue');

        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('employees-add')) {
            $lims_role_list = Role::where('is_active', true)->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            $lims_biller_list = Biller::where('is_active', true)->get();
            $lims_department_list = Department::where('is_active', true)->get();
            $districts = District::all();
            $divisions = Division::all();
            $thanas = Thana::all();

            return view('employee.create', compact(
                'lims_role_list', 'lims_warehouse_list',
                'lims_biller_list', 'lims_department_list',
                'employeeOld','districts','divisions','thanas'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);


        $message = 'Employee created successfully';
        if (isset($data['user'])) {
            $this->validate($request, [
                'name' => [
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        return $query->where('is_deleted', false);
                    }),
                ],
                'email' => [
                    'email',
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        return $query->where('is_deleted', false);
                    }),
                ],
            ]);

            $data['is_active'] = true;
            $data['is_deleted'] = false;
            $data['password'] = bcrypt($data['password']);
            $data['phone'] = $data['phone_number'];
            $data['role_id'] = 5;
            User::create($data);
            $user = User::latest()->first();
            $data['user_id'] = $user->id;
            $message = 'Employee created successfully and added to user list';
        }


        //validation in employee table
        // $this->validate($request, [
        //     'email' => [
        //         'max:255',
        //         Rule::unique('employees')->where(function ($query) {
        //             return $query->where('is_active', true);
        //         }),
        //     ],
        //     'image' => 'image|mimes:jpg,jpeg,png,gif|max:100000',
        //     'division_branch' => 'string|required',
        //     'date_of_birth' => 'date|required',
        //     'gender' => 'string|required',
        //     'father_name' => 'string|required',
        //     'mother_name' => 'string|required',
        //     'national_id' => 'required',
        //     'marital_status' => 'string|required',
        //     'religion' => 'string|required',
        //     'nationality' => 'string|required',
        //     'name' => 'string|required',
        //     'present_address' => 'string|required',
        //     'present_city' => 'string|required',
        //     'present_district' => 'string|required',
        //     'permanent_address' => 'string|required',
        //     'permanent_city' => 'string|required',
        //     'present_district' => 'string|required',
        //     'email' => 'email|required',
        //     'office_phone_number' => 'required',
        //     'emergency_contact1' => 'required',
        //     'emergency_contact2' => 'required',
        //     'relationship' => 'string|required',
        //     'joining_date' => 'date|required',
        //     'grade' => 'string|required',
        //     'qualification' => 'string|required',
        //     'type_of_employee' => 'string|required',
        //     'overtime_count' => 'string|required',
        //     'effective_date' => 'date|required',
        //     'shift' => 'string|required',
        //     'present_salary' => 'integer|required',
        //     'late_count' => 'string|required',
        //     'early_count' => 'string|required',
        //     'logout_required' => 'string|required',
        //     'half_day_absent' => 'string|required',
        //     'weekly_holiday' => 'string|required',
        //     'total_leave' => 'string|required'
        // ]);

        $data['is_active'] = true;
        $image = $request->image;
        if ($image) {
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = preg_replace('/[^a-zA-Z0-9]/', '', $request['email']);
            $imageName = $imageName . '.' . $ext;
            $image->move('public/images/employee', $imageName);
            $data['image'] = $imageName;
        }

        $document = $request->document;
        if ($document) {
            $ext = pathinfo($document->getClientOriginalName(), PATHINFO_EXTENSION);
            $documentName = preg_replace('/[^a-zA-Z0-9]/', '', $request['employee_name']);
            $documentName = $documentName . '.' . $ext;
            // dd($documentName);
            $document->move('public/document/employee', $documentName);
            $data['document'] = $documentName;
        }
        Employee::create($data);


        return redirect('employees')->with('message', $message);
    }



    public function employeeInactive($id){

        $activeStatus = Employee::find($id);


        if ($activeStatus->is_active) {
            $activeStatus->update([
                'is_active' => 0
            ]);
        } else {
            $activeStatus->update([
                'is_active' => 1
            ]);
        }

        return redirect()->back();
    }


   public function show($id){

        $employee = Employee::findOrFail($id);

        return view('employee.show', compact('employee'));
   }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $lims_department_list = Department::where('is_active', true)->get();
        return view('employee.edit', compact('employee', 'lims_department_list'));
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        // $lims_employee_data = Employee::find($request['employee_id']);
        $lims_employee_data = Employee::findOrFail($id);
        if ($lims_employee_data->user_id) {
            $this->validate($request, [
                'name' => [
                    'max:255',
                    Rule::unique('users')->ignore($lims_employee_data->user_id)->where(function ($query) {
                        return $query->where('is_deleted', false);
                    }),
                ],
                'email' => [
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($lims_employee_data->user_id)->where(function ($query) {
                        return $query->where('is_deleted', false);
                    }),
                ],
            ]);
        }
        //validation in employee table
        $this->validate($request, [
            'email' => [
                'email',
                'max:255',
                Rule::unique('employees')->ignore($lims_employee_data->id)->where(function ($query) {
                    return $query->where('is_active', true);
                }),
            ],
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:100000',
        ]);

        $data = $request->except('image', 'document');
        $image = $request->image;
        $document = $request->document;
        if ($image) {
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = preg_replace('/[^a-zA-Z0-9]/', '', $request['email']);
            $imageName = $imageName . '.' . $ext;
            $image->move('public/images/employee', $imageName);
            $data['image'] = $imageName;
        }

        if ($document) {
            $ext = pathinfo($document->getClientOriginalName(), PATHINFO_EXTENSION);
            $documentName = preg_replace('/[^a-zA-Z0-9]/', '', $request['employee_name']);
            $documentName = $documentName . '.' . $ext;
            $document->move('public/document/employee', $documentName);
            $data['image'] = $documentName;
        }
        //
        // $this->validate($request, [
        //     'division_branch' => 'string|required',
        //     'date_of_birth' => 'date|required',
        //     'gender' => 'string|required',
        //     'father_name' => 'string|required',
        //     'mother_name' => 'string|required',
        //     'national_id' => 'required',
        //     'marital_status' => 'string|required',
        //     'religion' => 'string|required',
        //     'nationality' => 'string|required',
        //     'name' => 'string|required',
        //     'present_address' => 'string|required',
        //     'present_city' => 'string|required',
        //     'present_district' => 'string|required',
        //     'permanent_address' => 'string|required',
        //     'permanent_city' => 'string|required',
        //     'present_district' => 'string|required',
        //     'email' => 'email|required',
        //     'office_phone_number' => 'required',
        //     'emergency_contact1' => 'required',
        //     'emergency_contact2' => 'required',
        //     'relationship' => 'string|required',
        //     'joining_date' => 'date|required',
        //     'grade' => 'string|required',
        //     'qualification' => 'string|required',
        //     'type_of_employee' => 'string|required',
        //     'overtime_count' => 'string|required',
        //     'effective_date' => 'date|required',
        //     'shift' => 'string|required',
        //     'present_salary' => 'integer|required',
        //     'late_count' => 'string|required',
        //     'early_count' => 'string|required',
        //     'logout_required' => 'string|required',
        //     'half_day_absent' => 'string|required',
        //     'weekly_holiday' => 'string|required',
        //     'total_leave' => 'string|required'
        // ]);

        $lims_employee_data->update($data);
        return redirect('employees')->with('message', 'Employee updated successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $employee_id = $request['employeeIdArray'];
        foreach ($employee_id as $id) {
            $lims_employee_data = Employee::find($id);
            if ($lims_employee_data->user_id) {
                $lims_user_data = User::find($lims_employee_data->user_id);
                $lims_user_data->is_deleted = true;
                $lims_user_data->save();
            }
            $lims_employee_data->is_active = false;
            $lims_employee_data->save();
        }
        return 'Employee deleted successfully!';
    }
    public function destroy($id)
    {
        $lims_employee_data = Employee::find($id);
        if ($lims_employee_data->user_id) {
            $lims_user_data = User::find($lims_employee_data->user_id);
            $lims_user_data->is_deleted = true;
            $lims_user_data->save();
        }
        $lims_employee_data->is_active = false;
        $lims_employee_data->save();
        return redirect('employees')->with('not_permitted', 'Employee deleted successfully');
    }
    public function getThana(){

    }
    public function getDistrict($id){
        $districts=DB::table('districts')->where('districts.division_id', $id)->orderBy('name')->get();

        return response()->json($districts);
    }
}
