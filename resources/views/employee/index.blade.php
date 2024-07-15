@extends('layout.main') @section('content')
@if($errors->has('name'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('name') }}
</div>
@endif
@if($errors->has('image'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('image') }}
</div>
@endif
@if($errors->has('email'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('email') }}
</div>
@endif
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section>
    @if(in_array("employees-add", $all_permission))
    <div class="container-fluid">
        <a href="{{route('employees.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{trans('file.Add Employee')}}</a>
    </div>
    @endif
    <div class="table-responsive">
        <table id="employee-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Image')}}</th>
                    <th>{{trans('file.name')}}</th>
                    <th>{{trans('file.Email')}}</th>
                    <th>{{trans('file.Phone Number')}}</th>
                    <th>{{trans('file.Department')}}</th>
                    <th>{{trans('Status')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_employee_all as $key=>$employee)
                @php $department = \App\Department::find($employee->department_id); @endphp
                <tr data-id="{{$employee->id}}">
                    <td>{{$key}}</td>
                    @if($employee->image)
                    <td> <img src="{{url('public/images/employee',$employee->image)}}" height="80" width="80">
                    </td>
                    @else
                    <td>No Image</td>
                    @endif
                    <td>{{ $employee->employee_name }}</td>
                    <td>{{ $employee->email}}</td>
                    <td>{{ $employee->phone_number}}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a href="{{route('employee.inactive',$employee->id)}}">
                            @if($employee->is_active)
                            <button type="button" class="btn btn-success">Active</button>

                            @else

                            <button type="button" class="btn btn-danger">Inactive</button>

                            @endif
                        </a>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                @if(in_array("employees-edit", $all_permission))
                                <li>
                                    {{-- <button type="button" data-id="{{$employee->id}}" data-name="{{$employee->name}}" data-email="{{$employee->email}}" data-phone_number="{{$employee->phone_number}}" data-department_id="{{$employee->department_id}}" data-address="{{$employee->address}}" data-city="{{$employee->city}}" data-country="{{$employee->country}}" class="edit-btn btn btn-link" data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</button> --}}
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-link"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</a>
                                </li>
                                @endif
                                <li class="divider"></li>
                                @if(in_array("employees-delete", $all_permission))
                                {{ Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'DELETE'] ) }}
                                <li>
                                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button>
                                </li>
                                {{ Form::close() }}
                                @endif
                                <li class="divider"></li>
                                @if(in_array("employees-edit", $all_permission))
                                <li>
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-link"><i class="fa fa-eye"></i> {{trans('View')}}</a>
                                </li>
                                @endif

                            </ul>
                        </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</section>

<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Employee')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => ['employees.update', 1], 'method' => 'put', 'files' => true]) !!}
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="background:#05e6bd; text-align: center">Employee</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{trans('file.Company Name')}} *</strong> </label>
                            <select class="form-control selectpicker" name="company_name" required>
                                <option value="">Select</option>
                                <option value="wtl">Wardan Tech Ltd</option>
                                <option value="wts">Wardan Ship Service Ltd</option>
                            </select>
                            @if($errors->has('company_name'))
                            <span>
                                <strong>{{ $errors->first('company_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.name')}} *</strong> </label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{trans('Division or Branch')}} </strong> </label>
                            <select class="form-control selectpicker" name="division_branch">
                                <option value="">Select</option>
                                <option value="mirpur">Mirpur</option>
                                <option value="uttara">Uttara</option>
                            </select>
                            @if($errors->has('division_branch'))
                            <span>
                                <strong>{{ $errors->first('division_branch') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.Department')}} *</label>
                            <select class="form-control selectpicker" name="department_id" required>
                                @foreach($lims_department_list as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{trans('Employee Code')}}</label>
                            <input type="number" name="employee_code" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{trans('Date of Birth')}} *</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" required class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('Gender')}} *</label>
                            <select class="form-control selectpicker" name="gender" required>
                                <option value="">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="transgender">Trangender</option>
                                <option value="other">Other</option>
                            </select>
                            @if($errors->has('gender'))
                            <span>
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{trans('Father Name')}} *</label>
                            <input type="text" name="father_name" required class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('Mother Name')}} *</label>
                            <input type="text" name="mother_name" required class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('National ID')}} *</label>
                            <input type="number" name="national_id" required class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('Marital Status')}} *</label>
                            <select class="form-control selectpicker" name="marital_status" required>
                                <option value="">Select</option>
                                <option value="married">Married</option>
                                <option value="unmarried">Unmarried</option>
                                <option value="widow">Widow</option>
                            </select>
                            @if($errors->has('marital_status'))
                            <span>
                                <strong>{{ $errors->first('marital_status') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('Religion')}} *</label>
                            <select class="form-control selectpicker" name="religion" id="religion" required>
                                <option value="">Select</option>
                                <option value="islam">Islam</option>
                                <option value="hindu">Hindu</option>
                                <option value="buddhist">Buddhist</option>
                                <option value="christian">Christian</option>
                            </select>
                            @if($errors->has('religion'))
                            <span>
                                <strong>{{ $errors->first('religion') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('Blood Group')}} *</label>
                            <select class="form-control selectpicker" name="blood_group" id="blood_group">
                                <option value="">Select</option>
                                <option value="a+">A (+) Positive</option>
                                <option value="a-">A (-) Negative</option>
                                <option value="ab+">AB (+) Positive</option>
                                <option value="ab-">AB (-) Negative</option>
                                <option value="b+">B (+) Positive</option>
                                <option value="b-">B (-) Negative</option>
                                <option value="o+">O (+) Positive</option>
                                <option value="o-">O (-) Negative</option>
                            </select>
                            @if($errors->has('blood_group'))
                            <span>
                                <strong>{{ $errors->first('blood_group') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('Nationality')}} *</label>
                            <input type="text" name="nationality" id="nationality" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{trans('file.Image')}}</label>
                            <input type="file" name="image" class="form-control">
                            @if($errors->has('image'))
                            <span>
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                        </div>
                        {{-- <div class="form-group mt-4">
                            <label>{{trans('file.Add User')}}</label>
                        <input type="checkbox" name="user" checked value="1" readonly />
                    </div>
                    <div id="user-input" class="mt-4">
                        <div class="form-group">
                            <label>{{trans('file.UserName')}} *</label>
                            <input type="text" name="name" required class="form-control">
                            @if($errors->has('name'))
                            <span>
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.Password')}} *</label>
                            <input required type="text" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.Role')}} *</label>
                            <select name="role_id" class="selectpicker form-control">
                                @foreach($lims_role_list as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="warehouse">
                            <label>{{trans('file.Warehouse')}} *</label>
                            <select name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                                @foreach($lims_warehouse_list as $warehouse)
                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="biller">
                            <label>{{trans('file.Biller')}} *</label>
                            <select name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                @foreach($lims_biller_list as $biller)
                                <option value="{{$biller->id}}">{{$biller->name}} ({{$biller->company_name}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 style="background:#05e6bd; text-align: center">Present Address</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('Address Details')}} *</label>
                        <textarea rows="4" name="present_address" placeholder="Describe address here..." class="form-control" required></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('City')}} *</label>
                        <select class="form-control selectpicker" name="present_city" required>
                            <option value="">Select</option>
                            <option value="Dhaka North">Dhaka North</option>
                            <option value="Dhaka South">Dhaka South</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Mymensingh">Mymensingh</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Gazipur">Gazipur </option>
                            <option value="Narayanganj">Narayanganj</option>
                        </select>
                        @if($errors->has('present_city'))
                        <span>
                            <strong>{{ $errors->first('present_city') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('District')}} *</label>
                        <select class="form-control selectpicker" name="present_district" required>
                            <option value="">Select</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Gazipur">Gazipur</option>
                            <option value="Chittagong ">Chittagong </option>
                            <option value="Rangpur ">Rangpur </option>
                            <option value="Rajshahi ">Rajshahi </option>
                        </select>
                        @if($errors->has('present_district'))
                        <span>
                            <strong>{{ $errors->first('present_district') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 style="background:#05e6bd; text-align: center">Permanent Address</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('Address Details')}} *</label>
                        <textarea rows="4" name="permanent_address" placeholder="Describe address here..." class="form-control" required></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('City')}} *</label>
                        <select class="form-control selectpicker" name="permanent_city" required>
                            <option value="">Select</option>
                            <option value="Dhaka North">Dhaka North</option>
                            <option value="Dhaka South">Dhaka South</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Mymensingh">Mymensingh</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Gazipur">Gazipur </option>
                            <option value="Narayanganj">Narayanganj</option>
                        </select>
                        @if($errors->has('permanent_city'))
                        <span>
                            <strong>{{ $errors->first('permanent_city') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('District')}} *</label>
                        <select class="form-control selectpicker" name="permanent_district" required>
                            <option value="">Select</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Gazipur">Gazipur</option>
                            <option value="Chittagong ">Chittagong </option>
                            <option value="Rangpur ">Rangpur </option>
                            <option value="Rajshahi ">Rajshahi </option>
                        </select>
                        @if($errors->has('permanent_district'))
                        <span>
                            <strong>{{ $errors->first('permanent_district') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 style="background:#05e6bd; text-align: center">Contact</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('file.Email')}} </label>
                        <input type="email" name="email" placeholder="example@example.com" required class="form-control">
                        @if($errors->has('email'))
                        <span>
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('file.Phone Number')}} *</label>
                        <input type="number" name="phone_number" required class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{trans('Office Phone Number')}} </label>
                        <input type="number" name="office_phone_number" required class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('Emergency Contact 1')}} *</label>
                        <input type="number" name="emergency_contact1" required class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{trans('Emergency Contact 2')}} </label>
                        <input type="number" name="emergency_contact2" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>{{trans('Relationship')}} *</label>
                        <input type="text" name="relationship" required class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 style="background:#05e6bd; text-align: center">Job</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('Joining Date')}} *</label>
                        <input type="date" name="joining_date" placeholder="Joining Date" required class="form-control" required>
                        @if($errors->has('joining_date'))
                        <span>
                            <strong>{{ $errors->first('joining_date') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('Position')}} *</label>
                        <select class="form-control selectpicker" name="position" required>
                            <option value="">Select</option>
                            <option value="sr">Senior</option>
                            <option value="jr">Junior</option>
                        </select>
                        @if($errors->has('position'))
                        <span>
                            <strong>{{ $errors->first('position') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('Grade')}} *</label>
                        <select class="form-control selectpicker" name="grade" required>
                            <option value="">Select</option>
                            <option value="Staf">Staf</option>
                            <option value="Officer">Officer</option>
                            <option value="Executive">Executive</option>
                            <option value="Manager">Manager</option>
                        </select>
                        @if($errors->has('grade'))
                        <span>
                            <strong>{{ $errors->first('grade') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('Qualification')}} *</label>
                        <select class="form-control selectpicker" name="qualification" required>
                            <option value="">Select</option>
                            <option value="post_raduation">Post Graduation</option>
                            <option value="graduation">Graduation</option>
                            <option value="HSC">HSC</option>
                            <option value="SSC">SSC</option>
                            <option value="JSC">JSC</option>
                        </select>
                        @if($errors->has('qualification'))
                        <span>
                            <strong>{{ $errors->first('qualification') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('Type of Employee')}} *</label>
                        <select class="form-control selectpicker" name="type_of_employee" required>
                            <option value="">Select</option>
                            <option value="permanent">Permanent</option>
                            <option value="contractual">Contractual</option>
                        </select>
                        @if($errors->has('type_of_employee'))
                        <span>
                            <strong>{{ $errors->first('type_of_employee') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('Overtime Count')}} *</label>
                        <select class="form-control selectpicker" name="overtime_count" id="overtime_count" required>
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        @if($errors->has('overtime_count'))
                        <span>
                            <strong>{{ $errors->first('overtime_count') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('Effective Date')}} *</label>
                        <input type="date" name="effective_date" required class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{trans('Shift')}} *</label>
                        <select class="form-control selectpicker" name="shift">
                            <option value="">Select</option>
                            <option value="Day">Day</option>
                            <option value="Night">Night</option>
                        </select>
                        @if($errors->has('shift'))
                        <span>
                            <strong>{{ $errors->first('shift') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('Present Salary')}} </label>
                        <input type="number" name="present_salary" id="present_salary" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>{{trans('Attendance Required')}} *</label>
                        <select class="form-control selectpicker" name="attendance_required" id="attendance_required">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        @if($errors->has('attendance_required'))
                        <span>
                            <strong>{{ $errors->first('attendance_required') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('Work Starting Time')}} *</label>
                        <input type="time" name="work_starting_time" id="work_starting_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{trans('Work Ending Time')}} *</label>
                        <input type="time" name="work_ending_time" id="work_ending_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{trans('late Count Time')}} *</label>
                        <input type="time" name="late_count" id="late_count" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{trans('Early Count Time')}} *</label>
                        <input type="time" name="early_count" id="early_count" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{trans('logout Required')}} *</label>
                        <select class="form-control selectpicker" name="logout_required" id="logout_required" required>
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        @if($errors->has('logout_required'))
                        <span>
                            <strong>{{ $errors->first('logout_required') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('Half Day Absent')}} *</label>
                        <select class="form-control selectpicker" name="half_day_absent" id="half_day_absent" required>
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        @if($errors->has('half_day_absent'))
                        <span>
                            <strong>{{ $errors->first('half_day_absent') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4 style="background:#05e6bd; text-align: center">Employee Weekly Holiday</h4>
                </div>
                <div class="col-md-6">
                    <h4 style="background:#05e6bd; text-align: center">Employee Yearly Leave</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('Weekly Holiday')}} *</label>
                        <select class="form-control selectpicker" name="weekly_holiday" id="weekly_holiday" required>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                        </select>
                        @if($errors->has('weekly_holiday'))
                        <span>
                            <strong>{{ $errors->first('weekly_holiday') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('Total Leave')}} *</label>
                        <input type="hidden" name="employee_id" id="employee_id">
                        <input type="text" name="total_leave" id="total_leave" required class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mt-4">

                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $("ul#hrm").siblings('a').attr('aria-expanded', 'true');
    $("ul#hrm").addClass("show");
    $("ul#hrm #employee-menu").addClass("active");

    var employee_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

    $('.edit-btn').on('click', function() {
        $("#editModal select[name='company_name']").val($(this).data('company_name'));
        $("#editModal input[name='employee_id']").val($(this).data('id'));
        $("#editModal input[name='name']").val($(this).data('name'));
        $("#editModal input[name='father_name']").val($(this).data('father_name'));
        $("#editModal input[name='mother_name']").val($(this).data('mother_name'));
        $("#editModal select[name='division_branch']").val($(this).data('division_branch'));
        $("#editModal input[name='national_id']").val($(this).data('national_id'));
        $("#editModal select[name='department_id']").val($(this).data('department_id'));
        $("#editModal select[name='marital_status']").val($(this).data('marital_status'));
        $("#editModal input[name='employee_code']").val($(this).data('employee_code'));
        $("#editModal select[name='religion']").val($(this).data('religion'));
        $("#editModal input[name='date_of_birth']").val($(this).data('date_of_birth'));
        $("#editModal select[name='blood_group']").val($(this).data('blood_group'));
        $("#editModal select[name='gender']").val($(this).data('gender'));
        $("#editModal input[name='nationality']").val($(this).data('nationality'));
        $("#editModal textarea[name='present_address']").val($(this).data('present_address'));
        $("#editModal select[name='present_city']").val($(this).data('present_city'));
        $("#editModal select[name='present_district']").val($(this).data('present_district'));
        $("#editModal textarea[name='permanent_address']").val($(this).data('permanent_address'));
        $("#editModal select[name='permanent_city']").val($(this).data('permanent_city'));
        $("#editModal select[name='permanent_district']").val($(this).data('permanent_district'));
        $("#editModal input[name='office_phone_number']").val($(this).data('office_phone_number'));
        $("#editModal input[name='emergency_contact1']").val($(this).data('emergency_contact1'));
        $("#editModal input[name='emergency_contact2']").val($(this).data('emergency_contact2'));
        $("#editModal input[name='relationship']").val($(this).data('relationship'));
        $("#editModal input[name='joining_date']").val($(this).data('joining_date'));
        $("#editModal input[name='present_salary']").val($(this).data('present_salary'));
        $("#editModal select[name='position']").val($(this).data('position'));
        $("#editModal select[name='attendance_required']").val($(this).data('attendance_required'));
        $("#editModal input[name='work_starting_time']").val($(this).data('work_starting_time'));
        $("#editModal input[name='work_ending_time']").val($(this).data('work_ending_time'));
        $("#editModal input[name='late_count']").val($(this).data('late_count'));
        $("#editModal input[name='early_count']").val($(this).data('early_count'));
        $("#editModal select[name='logout_required']").val($(this).data('logout_required'));
        $("#editModal select[name='shift']").val($(this).data('shift'));
        $("#editModal select[name='half_day_absent']").val($(this).data('half_day_absent'));
        $("#editModal select[name='grade']").val($(this).data('grade'));
        $("#editModal select[name='qualification']").val($(this).data('qualification'));
        $("#editModal select[name='type_of_employee']").val($(this).data('type_of_employee'));
        $("#editModal select[name='overtime_count']").val($(this).data('overtime_count'));
        $("#editModal input[name='effective_date']").val($(this).data('effective_date'));
        $("#editModal select[name='weekly_holiday']").val($(this).data('weekly_holiday'));
        $("#editModal input[name='total_leave']").val($(this).data('total_leave'));
        $("#editModal input[name='email']").val($(this).data('email'));
        $("#editModal input[name='phone_number']").val($(this).data('phone_number'));
        $("#editModal input[name='address']").val($(this).data('address'));
        $("#editModal input[name='city']").val($(this).data('city'));
        $("#editModal input[name='country']").val($(this).data('country'));
        $('.selectpicker').selectpicker('refresh');
        console.log($(this).data('id'))
    });

    $('#employee-table').DataTable({
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
            "info": '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search": '{{trans("file.Search")}}',
            'paginate': {
                'previous': '<i class="dripicons-chevron-left"></i>',
                'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [{
                "orderable": false,
                'targets': [0, 1, 6]
            },
            {
                'render': function(data, type, row, meta) {
                    if (type === 'display') {
                        data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }

                    return data;
                },
                'checkboxes': {
                    'selectRow': true,
                    'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                },
                'targets': [0]
            }
        ],
        'select': {
            style: 'multi',
            selector: 'td:first-child'
        },
        'lengthMenu': [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: '<"row"lfB>rtip',
        buttons: [{
                extend: 'pdf',
                text: '{{trans("file.PDF")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                },
                customize: function(doc) {
                    for (var i = 1; i < doc.content[1].table.body.length; i++) {
                        if (doc.content[1].table.body[i][0].text.indexOf('<img src=') !== -1) {
                            var imagehtml = doc.content[1].table.body[i][0].text;
                            var regex = /<img.*?src=['"](.*?)['"]/;
                            var src = regex.exec(imagehtml)[1];
                            var tempImage = new Image();
                            tempImage.src = src;
                            var canvas = document.createElement("canvas");
                            canvas.width = tempImage.width;
                            canvas.height = tempImage.height;
                            var ctx = canvas.getContext("2d");
                            ctx.drawImage(tempImage, 0, 0);
                            var imagedata = canvas.toDataURL("image/png");
                            delete doc.content[1].table.body[i][0].text;
                            doc.content[1].table.body[i][0].image = imagedata;
                            doc.content[1].table.body[i][0].fit = [30, 30];
                        }
                    }
                },
            },
            {
                extend: 'csv',
                text: '{{trans("file.CSV")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    format: {
                        body: function(data, row, column, node) {
                            if (column === 0 && (data.indexOf('<img src=') != -1)) {
                                var regex = /<img.*?src=['"](.*?)['"]/;
                                data = regex.exec(data)[1];
                            }
                            return data;
                        }
                    }
                },
            },
            {
                extend: 'print',
                text: '{{trans("file.Print")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                },
            },
            {
                text: '{{trans("file.delete")}}',
                className: 'buttons-delete',
                action: function(e, dt, node, config) {
                    // if (user_verified == '1') {
                        employee_id.length = 0;
                        $(':checkbox:checked').each(function(i) {
                            if (i) {
                                employee_id[i - 1] = $(this).closest('tr').data('id');
                            }
                        });
                        if (employee_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type: 'POST',
                                url: 'employees/deletebyselection',
                                data: {
                                    employeeIdArray: employee_id
                                },
                                success: function(data) {
                                    alert(data);
                                }
                            });
                            dt.rows({
                                page: 'current',
                                selected: true
                            }).remove().draw(false);
                        } else if (!employee_id.length)
                            alert('No employee is selected!');
                    // } else
                    //     alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '{{trans("file.Column visibility")}}',
                columns: ':gt(0)'
            },
        ],
    });
</script>
@endsection
