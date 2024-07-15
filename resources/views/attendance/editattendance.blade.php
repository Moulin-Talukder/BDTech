@extends('layout.main') @section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Attendance Adjustment</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small  style="color:red">{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['attendance.update',$attendance->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Employee')}} *</label>
                                <select class="form-control selectpicker" name="employee_id" required title="Employee" readonly>
                                    <option value="{{$attendance->employee_id }}" selected>{{ $attendance->employee->name }}</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{trans('file.date')}} *</label>
                                <input type="date" name="date" class="form-control" value="{{$attendance->date}}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Attendance Type *</label>
                                <select class="form-control selectpicker" name="attendance_type" required title="Employee" readonly>
                                    @if ($attendance->attendance_type==0)
                                    <option value="0" selected>Check in</option>
                                    @else
                                    <option value="1" selected>Check out</option>
                                    @endif
                                    
                                </select>
                            </div>
                            
                            <div class="col-md-4 form-group">
                                <label>Check In *</label>
                                <input type="time" id="time" name="time" class="form-control" value="{{ \Carbon\Carbon::parse($attendance->time)->format('H:i:s')}}" >
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Check Out *</label>
                                @if ($attendance->checkout!=null)
                                <input type="time" id="checkout" name="checkout" class="form-control" value="{{ \Carbon\Carbon::parse($attendance->checkout)->format('H:i:s')}}" >
                                @else
                                <input type="time" id="checkout" name="checkout" class="form-control" value="" > 
                                @endif
                                
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Location *</label>
                                <input type="text" id="location" name="location" class="form-control" value="{{$attendance->location}}" required readonly>
                            </div>
        
                            <div class="col-md-12 form-group">
                                <label>{{trans('file.Note')}}</label>
                                <textarea name="note" rows="3" class="form-control">{{$attendance->note}}</textarea>
                            </div>
                            <input type="hidden" id="lat" name="lat">
                            <input type="hidden" id="lng" name="lng">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="employee_id">
                            <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection