@extends('layout.main') @section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('Edit Employee')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small style="color:red">{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['employees.update', $employee->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <h4 style="background:#05e6bd; text-align: center">Employee</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Company Name')}} *</strong> </label>
                                    <select class="form-control selectpicker" name="company_name" required>
                                        <option value="">Select</option>
                                        <option value={{$employee->company_name}} @if( $employee->company_name == 'BD Tech Solution' )
                                            selected
                                            @endif>BD Tech Solution</option>
                                    </select>
                                    @if($errors->has('company_name'))
                                    <span>
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.name')}} *</strong> </label>
                                    <input type="text" name="employee_name" required class="form-control" value="{{$employee->employee_name}}">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('Division or Branch')}} </strong> </label>
                                    <select class="form-control selectpicker" name="division_branch">
                                        <option value="">Select</option>
                                        <option value={{$employee->division_branch}} @if( $employee->division_branch == 'mirpur' )
                                            selected
                                            @endif
                                            >Mirpur</option>
                                        <option value={{$employee->division_branch}} @if( $employee->division_branch == 'uttara' )
                                            selected
                                            @endif
                                            >Uttara</option>
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
                                        {{-- @foreach($lims_department_list as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach --}}
                                        <option value="">Select</option>
                                        @forelse($lims_department_list as $department)
                                        <option value="{{ $department->id }}" @if( $employee->department_id == $department->id )
                                            selected
                                            @endif
                                            >
                                            {{ $department->name }}
                                        </option>
                                        @empty
                                        <option value="">No Client Found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{trans('Employee Code')}}</label>
                                    <input type="number" name="employee_code" class="form-control" value="{{$employee->employee_code}}">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('Date of Birth')}} *</label>
                                    <input type="date" name="date_of_birth" required class="form-control" value="{{$employee->date_of_birth}}" required>
                                </div>
                                <div class="form-group">
                                    <label>{{trans('Gender')}} *</label>
                                    <select class="form-control selectpicker" name="gender" required>
                                        <option value="">Select</option>
                                        <option value={{$employee->gender }} @if( $employee->gender == 'male' )
                                            selected
                                            @endif
                                            >Male</option>
                                        <option value={{$employee->gender }} @if( $employee->gender == 'female' )
                                            selected
                                            @endif
                                            >Female</option>
                                        <option value={{$employee->gender }} @if( $employee->gender == 'transgender' )
                                            selected
                                            @endif
                                            >Trangender</option>
                                        <option value={{$employee->gender }} @if( $employee->gender == 'other' )
                                            selected
                                            @endif
                                            >Other</option>
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
                                <input type="text" name="father_name" required class="form-control" value="{{$employee->father_name}}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('Mother Name')}} *</label>
                                <input type="text" name="mother_name" required class="form-control" value="{{$employee->mother_name}}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('National ID')}} *</label>
                                <input type="number" name="national_id" required class="form-control" value="{{$employee->national_id}}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('Marital Status')}} *</label>
                                <select class="form-control selectpicker" name="marital_status" required>
                                    <option value="">Select</option>
                                    <option value={{$employee->marital_status }} @if( $employee->marital_status == 'married' )
                                        selected
                                        @endif
                                        >Married</option>
                                    <option value={{$employee->marital_status }} @if( $employee->marital_status == 'unmarried' )
                                        selected
                                        @endif
                                        >Unmarried</option>
                                    <option value={{$employee->marital_status }} @if( $employee->marital_status == 'widow' )
                                        selected
                                        @endif
                                        >Widow</option>
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
                                    <option value={{$employee->religion }} @if( $employee->religion == 'islam' )
                                        selected
                                        @endif
                                        >Islam</option>
                                    <option value={{$employee->religion }} @if( $employee->religion == 'hindu' )
                                        selected
                                        @endif
                                        >Hindu</option>
                                    <option value={{$employee->religion }} @if( $employee->religion == 'buddhist' )
                                        selected
                                        @endif
                                        >Buddhist</option>
                                    <option value={{$employee->religion }} @if( $employee->religion == 'christian' )
                                        selected
                                        @endif
                                        >Christian</option>
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
                                    <option value={{$employee->blood_group }} @if( $employee->blood_group == 'a+' )
                                        selected
                                        @endif
                                        >A (+) Positive</option>
                                    <option value={{$employee->blood_group }} @if( $employee->blood_group == 'a-' )
                                        selected
                                        @endif
                                        >A (-) Negative</option>
                                    <option value={{$employee->blood_group }} @if( $employee->blood_group == 'ab+' )
                                        selected
                                        @endif
                                        >AB (+) Positive</option>
                                    <option value={{$employee->blood_group }} @if( $employee->blood_group == 'ab-' )
                                        selected
                                        @endif
                                        >AB (-) Negative</option>
                                    <option value={{$employee->blood_group }} @if( $employee->blood_group == 'b+' )
                                        selected
                                        @endif
                                        >B (+) Positive</option>
                                    <option value={{$employee->blood_group }} @if( $employee->blood_group == 'b-' )
                                        selected
                                        @endif
                                        >B(-) Negative</option>
                                    <option value={{$employee->blood_group }} @if( $employee->blood_group == 'o+' )
                                        selected
                                        @endif
                                        >O (+) Positive</option>
                                    <option value={{$employee->blood_group }} @if( $employee->blood_group == 'o-' )
                                        selected
                                        @endif
                                        >O (-) Negative</option>
                                </select>
                                @if($errors->has('blood_group'))
                                <span>
                                    <strong>{{ $errors->first('blood_group') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{trans('Nationality')}} *</label>
                                <input type="text" name="nationality" required class="form-control" value="{{$employee->nationality}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.Image')}}</label>
                                <input type="file" name="image" class="form-control" value="{{$employee->image}}">
                                @if($errors->has('image'))
                                <span>
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                                @if($employee->image)
                                <img src="{{url('public/images/employee',$employee->image)}}" height="180" width="150">
                                @else
                                <h5>No Image</h5>
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

                            <input type="hidden" value="{{$employee->user_id}}">
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
                            <textarea rows="4" name="present_address" placeholder="Describe address here..." class="form-control" required>{{$employee->present_address}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('City')}} *</label>
                            <select class="form-control selectpicker" name="present_city" required>
                                <option value="">Select</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Dhaka North' )
                                    selected
                                    @endif
                                    >Dhaka North</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Dhaka South' )
                                    selected
                                    @endif
                                    >Dhaka South</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Chittagong' )
                                    selected
                                    @endif
                                    >Chittagong</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Khulna' )
                                    selected
                                    @endif
                                    >Khulna</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Rajshahi' )
                                    selected
                                    @endif
                                    >Rajshahi</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Mymensingh' )
                                    selected
                                    @endif
                                    >Mymensingh</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Sylhet' )
                                    selected
                                    @endif
                                    >Sylhet</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Barisal' )
                                    selected
                                    @endif
                                    >Barisal</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Rangpur' )
                                    selected
                                    @endif
                                    >Rangpur</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Gazipur' )
                                    selected
                                    @endif
                                    >Gazipur</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Narayanganj' )
                                    selected
                                    @endif
                                    >Narayanganj</option>
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
                                <option value={{$employee->present_district }} @if( $employee->present_district == 'Dhaka' )
                                    selected
                                    @endif
                                    >Dhaka</option>
                                <option value={{$employee->present_district }} @if( $employee->present_district == 'Gazipur' )
                                    selected
                                    @endif
                                    >Gazipur</option>
                                <option value={{$employee->present_district }} @if( $employee->present_district == 'Chittagong' )
                                    selected
                                    @endif
                                    >Chittagong</option>
                                <option value={{$employee->present_district }} @if( $employee->present_district == 'Rangpur' )
                                    selected
                                    @endif
                                    >Rangpur</option>
                                <option value={{$employee->present_district }} @if( $employee->present_district == 'Rajshahi' )
                                    selected
                                    @endif
                                    >Rajshahi</option>
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
                            <textarea rows="4" name="permanent_address" placeholder="Describe address here..." class="form-control" required>{{$employee->permanent_address}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('City')}} *</label>
                            <select class="form-control selectpicker" name="permanent_city" required>
                                <option value="">Select</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Dhaka North' )
                                    selected
                                    @endif
                                    >Dhaka North</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Dhaka South' )
                                    selected
                                    @endif
                                    >Dhaka South</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Chittagong' )
                                    selected
                                    @endif
                                    >Chittagong</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Khulna' )
                                    selected
                                    @endif
                                    >Khulna</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Rajshahi' )
                                    selected
                                    @endif
                                    >Rajshahi</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Mymensingh' )
                                    selected
                                    @endif
                                    >Mymensingh</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Sylhet' )
                                    selected
                                    @endif
                                    >Sylhet</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Barisal' )
                                    selected
                                    @endif
                                    >Barisal</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Rangpur' )
                                    selected
                                    @endif
                                    >Rangpur</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Gazipur' )
                                    selected
                                    @endif
                                    >Gazipur</option>
                                <option value={{$employee->present_city }} @if( $employee->present_city == 'Narayanganj' )
                                    selected
                                    @endif
                                    >Narayanganj</option>
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
                                <option value={{$employee->present_district }} @if( $employee->present_district == 'Dhaka' )
                                    selected
                                    @endif
                                    >Dhaka</option>
                                <option value={{$employee->present_district }} @if( $employee->present_district == 'Gazipur' )
                                    selected
                                    @endif
                                    >Gazipur</option>
                                <option value={{$employee->present_district }} @if( $employee->present_district == 'Chittagong' )
                                    selected
                                    @endif
                                    >Chittagong</option>
                                <option value={{$employee->present_district }} @if( $employee->present_district == 'Rangpur' )
                                    selected
                                    @endif
                                    >Rangpur</option>
                                <option value={{$employee->present_district }} @if( $employee->present_district == 'Rajshahi' )
                                    selected
                                    @endif
                                    >Rajshahi</option>
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
                            <input type="email" name="email" placeholder="example@example.com" required class="form-control" value="{{$employee->email }}">
                            @if($errors->has('email'))
                            <span>
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.Phone Number')}} *</label>
                            <input type="number" name="phone_number" required class="form-control" value="{{$employee->phone_number }}" required>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('Office Phone Number')}} </label>
                            <input type="number" name="office_phone_number" required class="form-control" value="{{$employee->office_phone_number }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                        <div class="col-md-12">
                            <h4 style="background:#05e6bd; text-align: center">Emergrncy Contact</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('Name')}} </label>
                                <input type="text" name="relative_name" placeholder="example@example.com" required class="form-control" value="{{$employee->relative_name }}">
                                @if($errors->has('relative_name'))
                                <span>
                                    <strong>{{ $errors->first('relative_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{trans('Relationship')}} *</label>
                                <input type="text" name="relationship" required class="form-control" value="{{$employee->relationship }}" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('Phone Number')}} </label>
                                <input type="number" name="relative_phone_number" required class="form-control" value="{{$employee->relative_phone_number }}">
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
                            <input type="date" name="joining_date" placeholder="Joining Date" required class="form-control" value="{{$employee->joining_date }}" required>
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
                                <option value={{$employee->position }} @if( $employee->position == 'sr' )
                                    selected
                                    @endif
                                    >Senior</option>
                                <option value={{$employee->position }} @if( $employee->position == 'jr' )
                                    selected
                                    @endif
                                    >Junior</option>
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
                                <option value={{$employee->grade }} @if( $employee->grade == 'Staf' )
                                    selected
                                    @endif
                                    >Staf</option>
                                <option value={{$employee->grade }} @if( $employee->grade == 'Officer' )
                                    selected
                                    @endif
                                    >Officer</option>
                                <option value={{$employee->grade }} @if( $employee->grade == 'Executive' )
                                    selected
                                    @endif
                                    >Executive</option>
                                <option value={{$employee->grade }} @if( $employee->grade == 'Manager' )
                                    selected
                                    @endif
                                    >Manager</option>
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
                                <option value={{$employee->qualification }} @if( $employee->qualification == 'post_raduation' )
                                    selected
                                    @endif
                                    >Post Graduation</option>
                                <option value={{$employee->qualification }} @if( $employee->qualification == 'graduation' )
                                    selected
                                    @endif
                                    >Post Graduation</option>
                                <option value={{$employee->qualification }} @if( $employee->qualification == 'HSC' )
                                    selected
                                    @endif
                                    >HSC</option>
                                <option value={{$employee->qualification }} @if( $employee->qualification == 'SSC' )
                                    selected
                                    @endif
                                    >SSC</option>
                                <option value={{$employee->qualification }} @if( $employee->qualification == 'JSC' )
                                    selected
                                    @endif
                                    >JSC</option>
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
                                <option value={{$employee->type_of_employee }} @if( $employee->type_of_employee == 'permanent' )
                                    selected
                                    @endif
                                    >Permanent</option>
                                <option value={{$employee->type_of_employee }} @if( $employee->type_of_employee == 'contractual' )
                                    selected
                                    @endif
                                    >Contractual</option>
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
                                <option value={{$employee->overtime_count }} @if( $employee->overtime_count == 'yes' )
                                    selected
                                    @endif
                                    >yes</option>
                                <option value={{$employee->overtime_count }} @if( $employee->overtime_count == 'no' )
                                    selected
                                    @endif
                                    >No</option>
                            </select>
                            @if($errors->has('overtime_count'))
                            <span>
                                <strong>{{ $errors->first('overtime_count') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('Effective Date')}} *</label>
                            <input type="date" name="effective_date" required class="form-control" value="{{$employee->effective_date }}" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('Shift')}} *</label>
                            <select class="form-control selectpicker" name="shift">
                                <option value="">Select</option>
                                <option value={{$employee->shift }} @if( $employee->shift == 'Day' )
                                    selected
                                    @endif
                                    >Day</option>
                                <option value={{$employee->shift }} @if( $employee->shift == 'Night' )
                                    selected
                                    @endif
                                    >Night</option>
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
                            <input type="number" name="present_salary" required class="form-control" value="{{$employee->present_salary }}">
                        </div>
                        <div class="form-group">
                            <label>{{trans('Attendance Required')}} *</label>
                            <select class="form-control selectpicker" name="attendance_required" required>
                                <option value="">Select</option>
                                <option value={{$employee->attendance_required }} @if( $employee->attendance_required == 'yes' )
                                    selected
                                    @endif
                                    >yes</option>
                                <option value={{$employee->attendance_required }} @if( $employee->attendance_required == 'no' )
                                    selected
                                    @endif
                                    >No</option>
                            </select>
                            @if($errors->has('attendance_required'))
                            <span>
                                <strong>{{ $errors->first('attendance_required') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('Work Starting Time')}} *</label>
                            <input type="time" name="work_starting_time" required class="form-control" value="{{$employee->work_starting_time}}" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('Work Ending Time')}} *</label>
                            <input type="time" name="work_ending_time" required class="form-control" value="{{$employee->work_ending_time}}" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('late Count Time')}} *</label>
                            <input type="time" name="late_count" required class="form-control" value="{{$employee->late_count}}" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('Early Count Time')}} *</label>
                            <input type="time" name="early_count" required class="form-control" value="{{$employee->early_count}}" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('logout Required')}} *</label>
                            <select class="form-control selectpicker" name="logout_required" required>
                                <option value="">Select</option>
                                <option value={{$employee->logout_required }} @if( $employee->logout_required == 'yes' )
                                    selected
                                    @endif
                                    >Yes</option>
                                <option value={{$employee->logout_required }} @if( $employee->logout_required == 'no' )
                                    selected
                                    @endif
                                    >No</option>
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
                                <option value={{$employee->half_day_absent }} @if( $employee->half_day_absent == 'yes' )
                                    selected
                                    @endif
                                    >Yes</option>
                                <option value={{$employee->half_day_absent }} @if( $employee->half_day_absent == 'no' )
                                    selected
                                    @endif
                                    >No</option>
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

                                <option value="">Select</option>
                                <option value={{$employee->weekly_holiday }} @if( $employee->weekly_holiday == 'Friday' )
                                    selected
                                    @endif
                                    >Friday</option>
                                <option value={{$employee->weekly_holiday }} @if( $employee->weekly_holiday == 'Saturday' )
                                    selected
                                    @endif
                                    >Saturday</option>
                                <option value={{$employee->weekly_holiday }} @if( $employee->weekly_holiday == 'Sunday' )
                                    selected
                                    @endif
                                    >Sunday</option>
                                <option value={{$employee->weekly_holiday }} @if( $employee->weekly_holiday == 'Monday' )
                                    selected
                                    @endif
                                    >Monday</option>
                                <option value={{$employee->weekly_holiday }} @if( $employee->weekly_holiday == 'Tuesday' )
                                    selected
                                    @endif
                                    >Tuesday</option>
                                <option value={{$employee->weekly_holiday }} @if( $employee->weekly_holiday == 'Wednesday' )
                                    selected
                                    @endif
                                    >Wednesday</option>
                                <option value={{$employee->weekly_holiday }} @if( $employee->weekly_holiday == 'Thursday' )
                                    selected
                                    @endif
                                    >Thursday</option>
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
                            <input type="text" name="total_leave" class="form-control" value={{$employee->total_leave }} required>
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

<script type="text/javascript">
    $("ul#hrm").siblings('a').attr('aria-expanded', 'true');
    $("ul#hrm").addClass("show");
    $("ul#hrm #employee-menu").addClass("active");

    $('#warehouse').hide();
    $('#biller').hide();

    $('input[name="user"]').on('change', function() {
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
            $('select[name="warehouse_id"]').prop('required', false);
            $('select[name="biller_id"]').prop('required', false);
        }
    });

    $('select[name="role_id"]').on('change', function() {
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
</script>
@endsection