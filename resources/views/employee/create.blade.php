@extends('layout.main')

@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{trans('file.Add Employee')}}</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small
                                    style="color:red">{{trans('file.The field labels marked with * are required input fields')}}
                                    .</small></p>
                            {!! Form::open(['route' => 'employees.store', 'method' => 'post', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 style="background:#05e6bd; text-align: center">Employee</h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{trans('file.Company Name')}} *</strong> </label>
                                        <select class="form-control selectpicker" name="company_name" required>
                                            <option value="">Select</option>
                                            <option value="BD Tech Solution">BD Tech Solution</option>
                                        </select>
                                        @if($errors->has('company_name'))
                                            <span>
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('file.name')}} *</strong> </label>
                                        <input
                                            @isset($employeeOld['employee_name']) value="{{$employeeOld['employee_name']}}"
                                            @endisset type="text" name="employee_name" required class="form-control">
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
                                        <div class="input-group">
                                            <select class="form-control selectpicker sel" name="department_id"
                                                    id="department_id" required>
                                                @foreach($lims_department_list as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button id="" type="button" class="btn btn-sm" data-toggle="modal"
                                                        data-target="#deptModal" title=""><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <span class="validation-msg"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('Employee Code')}}</label>
                                        <input type="number" name="employee_code" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('Date of Birth')}} *</label>
                                        <input type="date" name="date_of_birth" required class="form-control" required>
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
                                    {{-- <div class="form-group">
                                        <label>{{trans('file.Email')}} *</label>
                                    <input type="email" name="email" placeholder="example@example.com" required class="form-control">
                                    @if($errors->has('email'))
                                    <span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif 
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.Phone Number')}} *</label>
                                    <input type="text" name="phone_number" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.Address')}}</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.City')}}</label>
                                    <input type="text" name="city" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.Country')}}</label>
                                    <input type="text" name="country" class="form-control">
                                </div> --}}
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
                                        <select class="form-control selectpicker" name="religion" required>
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
                                        <select class="form-control selectpicker" name="blood_group">
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
                                        <input type="text" name="nationality" required class="form-control" required>
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

                                    <div class="form-group">
                                        <label>{{trans('Document')}}</label>
                                        <input type="file" name="document" class="form-control">
                                        @if($errors->has('document'))
                                            <span>
                                    <strong>{{ $errors->first('document') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-4">
                                        <label>{{trans('file.Add User')}}</label>
                                        <input type="checkbox" name="user" checked value="1" readonly/>
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
                                            <input required type="password" name="password"
                                                   class="selectpicker form-control">
                                        </div>
                                        {{-- <div class="form-group">
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
                                    </div> --}}
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 style="background:#05e6bd; text-align: center">Present Address</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('Address Details')}} *</label>
                                        <textarea rows="4" name="present_address" placeholder="Describe address here..."
                                                  class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Division*</label>
                                    <select id="" data-live-search="true" data-live-search-style="brgain"
                                            name="present_ad_division" class="selectpicker form-control">
                                        <option value="">Select division</option>
                                        @foreach($divisions as $division)
                                            <option value="{{$division->id}}">{{$division->name}}</option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('permanent_city'))
                                        <span>
                                <strong>{{ $errors->first('permanent_city') }}</strong>
                            </span>
                                    @endif

                                    <div class="form-group">
                                        <label>{{trans('District')}} *</label>
                                        <select class="form-control selectpicker" data-live-search="true"
                                                data-live-search-style="brgain" name="present_ad_district" required>
                                            <option value="">Select</option>
                                            @foreach($districts as $district)
                                                <option value="{{$district->id}}">{{$district->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('permanent_district'))
                                            <span>
                                <strong>{{ $errors->first('permanent_district') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('Thana')}} *</label>
                                        <select class="form-control selectpicker" data-live-search="true"
                                                data-live-search-style="brgain" name="present_ad_thana" required>
                                            <option value="">Select</option>
                                            @foreach($thanas as $thana)
                                                <option value="{{$thana->id}}">{{$thana->name}}</option>
                                            @endforeach
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
                                    <h4 style="background:#05e6bd; text-align: center">Permanent Address</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('Address Details')}} *</label>
                                        <textarea rows="4" name="permanent_address"
                                                  placeholder="Describe address here..." class="form-control"
                                                  required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Division*</label>
                                    <select id="" data-live-search="true" data-live-search-style="brgain"
                                            name="permanent_ad_division" class="selectpicker form-control">
                                        <option value="">Select division</option>
                                        @foreach($divisions as $division)
                                            <option value="{{$division->id}}">{{$division->name}}</option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('permanent_city'))
                                        <span>
                                <strong>{{ $errors->first('permanent_city') }}</strong>
                            </span>
                                    @endif

                                    <div class="form-group">
                                        <label>{{trans('District')}} *</label>
                                        <select class="form-control selectpicker" data-live-search="true"
                                                data-live-search-style="begain" name="permanent_ad_district" required>
                                            <option value="">Select</option>
                                            @foreach($districts as $district)
                                                <option value="{{$district->id}}">{{$district->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('permanent_district'))
                                            <span>
                                <strong>{{ $errors->first('permanent_district') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('Thana')}} *</label>
                                        <select class="form-control selectpicker" data-live-search="true"
                                                data-live-search-style="brgain" name="permanent_ad_thana" required>
                                            <option value="">Select</option>
                                            @foreach($thanas as $thana)
                                                <option value="{{$thana->id}}">{{$thana->name}}</option>
                                            @endforeach
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
                                        <label>{{trans('file.Email')}} *</label>
                                        <input type="email" name="email" placeholder="example@example.com"
                                               class="form-control" required>
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

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('Office Phone Number')}} </label>
                                        <input type="number" name="office_phone_number" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h4 style="background:#05e6bd; text-align: center">Emergency Contact</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('Name')}} </label>
                                        <input type="text" name="relative_name" placeholder="example@example.com"
                                               class="form-control">
                                        @if($errors->has('relative_name'))
                                            <span>
                                <strong>{{ $errors->first('relative_name') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('Relationship')}} *</label>
                                        <input type="text" name="relationship" required class="form-control" required>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('Phone Number')}} </label>
                                        <input type="number" name="relative_phone_number" class="form-control">
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
                                        <input type="date" name="joining_date" placeholder="Joining Date" required
                                               class="form-control" required>
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
                                        <select class="form-control selectpicker" name="overtime_count" required>
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
                                        <input type="number" name="present_salary" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('Attendance Required')}} *</label>
                                        <select class="form-control selectpicker" name="attendance_required" required>
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
                                        <input type="time" name="work_starting_time" required class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('Work Ending Time')}} *</label>
                                        <input type="time" name="work_ending_time" required class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('late Count Time')}} *</label>
                                        <input type="time" name="late_count" required class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('Early Count Time')}} *</label>
                                        <input type="time" name="early_count" required class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('logout Required')}} *</label>
                                        <select class="form-control selectpicker" name="logout_required" required>
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
                                        <select class="form-control selectpicker" name="half_day_absent" required>
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
                                        <select class="form-control selectpicker" name="weekly_holiday" required>
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
                                        <input type="text" name="total_leave" required class="form-control">
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
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Create Modal -->
    <div id="deptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                {{--        {!! Form::open(['route' => 'departments.store', 'method' => 'post']) !!}--}}
                <form id="department-form">
                    <input type="hidden" name="departmentAdd" value="1">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Department')}}</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <p class="italic">
                            <small>{{trans('file.The field labels marked with * are required input fields')}}.</small>
                        </p>

                        <div class="form-group">
                            <label>{{trans('file.name')}} *</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <input type="hidden" name="returntoemployee" value="1">
                        <input type="hidden" name="old_value" id="employee_old_value">

                        <div class="form-group">
                            <input type="submit" id="addDepartmentBtn" value="{{trans('file.submit')}}"
                                   class="btn btn-primary">
                        </div>

                    </div>
                </form>
                {{--        {{ Form::close() }}--}}
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $("ul#hrm").siblings('a').attr('aria-expanded', 'true');
        $("ul#hrm").addClass("show");
        $("ul#hrm #employee-menu").addClass("active");

        $('#warehouse').hide();
        $('#biller').hide();

        $('input[name="user"]').on('change', function () {
            if ($(this).is(':checked')) {
                $('#user-input').show(400);
                $('input[name="name"]').prop('required', true);
                $('input[name="password"]').prop('required', true);
                $('select[name="role_id"]').prop('required', true);
            } else {
                $('#user-input').hide(400);
                $('input[name="name"]').prop('required', false);
                $('input[name="password"]').prop('required', false);
                $('select[name="role_id"]').prop('required', false);

            }
        });

        $('select[name="role_id"]').on('change', function () {
            if ($(this).val() > 2) {
                $('#warehouse').show(400);
                $('#biller').show(400);
                $('select[name="warehouse_id"]').prop('required', true);
                $('select[name="biller_id"]').prop('required', true);
            } else {
                $('#warehouse').hide(400);
                $('#biller').hide(400);
                $('select[name="warehouse_id"]').prop('required', false);
                $('select[name="biller_id"]').prop('required', false);
            }
        });

        $('#addDepartmentBtn').on("click", function (e) {
            //console.log($("#department-form").serialize());
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('departments.store')}}",
                data: $("#department-form").serialize(),
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                success: function (response) {
                    console.log(response);
                    //location.href = '../purchases/create';
                    $('#department_id').append($('<option>', {
                        value: response.id,
                        text: response.name
                    }));
                    $("#department_id").val(response.id).change();
                    $('.close').click();
                    $('#department-form').trigger("reset");
                },
                // error:function(response) {
                //     if(response.responseJSON.errors.name) {
                //         $("#name-error").text(response.responseJSON.errors.name);
                //     }
                //     else if(response.responseJSON.errors.code) {
                //         $("#code-error").text(response.responseJSON.errors.code);
                //     }
                // },
            });
        });
    </script>
@endsection
