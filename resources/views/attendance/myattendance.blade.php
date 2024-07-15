@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="container-fluid">
        <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="dripicons-plus"></i> {{trans('file.Add Attendance')}} </button>
    </div>
    <div class="row ml-5">
        <div class="col-md-5">
            
                <label for="" class="text-right mr-5"> <strong>Employee Id</strong> </label>
                <p>{{$employee->employee_code}}</p>
                
            
           
                <label for="" class="mr-5"><strong>Name</strong></label>
                <p>{{ $user->name}}</p>
                
            
            
                <label for="" class="mr-5"><strong>Designation</strong></label>
                <p>{{$employee->position}}</p>
                
           
           
                <label for="" class="mr-5"><strong>Joining Date</strong></label>
                <p>{{$employee->joining_date}}</p>
                
          
           
                <label for="" class="mr-5"><strong>Work Starting Time</strong></label>
                <p>{{$employee->work_starting_time}}</p>
        </div>
    
        <div class="col-md-5">
            <label for=""><strong>Current Date</strong></label>
            <p>{{$date->toDateString()}}</p>
            <label for=""><strong>Current Time</strong></label>
            <p>{{$date->toTimeString()}}</p>
            <label for=""><strong>Leave Spent</strong></label>
            <p>00</p>
            <label for=""><strong>Service Length</strong></label>
            <p>{{$job_duration->y}} Year,{{$job_duration->m}} Months,{{$job_duration->d}}Days.</p>
            <label for=""><strong>Work Ending Time</strong></label>
            <p>{{$employee->work_ending_time}}</p>
        </div>
        <div class="col-md-2">
            @if($employee->image)
                     <img src="{{url('public/images/employee',$employee->image)}}" height="220" width="190">
                    
                    @else
                    No Image
                    @endif
            {{-- <img src="{{asset('employee/'.$getprofile->employeephoto)}}" class="rounded" alt="Image" height="180px" width="160px"> --}}
        </div>
       
    </div>
    <hr>
    <div class="table-responsive">
        <table id="attendance-table" class="table">
            <thead>
                <tr>
                    {{-- <th class="not-exported"></th>
                    <th>{{trans('file.date')}}</th>
                    <th>{{trans('file.Employee')}}</th>
                    <th> Type </th>
                    <th> Time </th>
                    <th>{{trans('file.Status')}}</th>
                    <th> Note </th>
                    <th class="not-exported">{{trans('file.action')}}</th> --}}
                    <th></th>
                    <th>Log Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Status</th>
                    <th>Working Hour</th>
                    <th>Extra Hour</th>
                    <th>Note</th>
                    <th>Remark</th>
                    {{-- <th>Action</th> --}}

                </tr>
            </thead>
            <tbody>
                @php
                    $today = today('Asia/Dhaka'); 
                    $dates = []; 

                    for($i=1; $i < $today->daysInMonth+1; ++$i) {
                        $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                    }
                @endphp
                @foreach ($dates as $date)

                    @php
                        $day = \Carbon\Carbon::parse($date)->format('l');
                        $startDate = date("Y-m-d", strtotime($date));
                        $attendance = \App\Attendance::where('employee_id',$employee->id)->whereDate('created_at',$startDate)->first();
                        $holiday = \App\Employee::where('user_id',$user->id)->first();
                    @endphp

                <tr>
                    <td></td>
                    <td>{{$date}}</td>

                    @if(isset($attendance))
                    {{-- @php
                    dd(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendance->checkout)->format('l'))
                @endphp --}}
                        <th>{{Carbon\Carbon::parse($attendance['time'])->format('H:i:s')}}</th>
    
                        @if($attendance->checkout)
                        <td>{{Carbon\Carbon::parse($attendance['checkout'])->format('H:i:s')}}</td>
                        @else
                        <td></td>
                        @endif
                        @if (\Carbon\Carbon::parse($attendance->employee->late_count)->lte(\Carbon\Carbon::parse($attendance->time)))
                            <td class="badge badge-danger">Late</td>
                        @else
                            <td class="badge badge-success">Present</td>
                        @endif

                        @php
                            $wh = \Carbon\Carbon::parse($attendance['checkout'])->diff(\Carbon\Carbon::parse($attendance['time']))->format('%H:%I:%S');
                            $dh = "08:00:00";
                        @endphp

                        <td>{{ \Carbon\Carbon::parse($attendance['checkout'])->diff(\Carbon\Carbon::parse($attendance['time']))->format('%H:%I:%S')}}</td>
                       
                            @if($wh > $dh)
                            <td>{{ \Carbon\Carbon::parse($dh)->diff(\Carbon\Carbon::parse($wh))->format('%H:%I:%S') }}</td>
                            @else
                            <td></td>
                            @endif

                        {{-- @if (Carbon\Carbon::parse($date)->format('l') == $attendance->employee->weekly_holiday) --}}
                     
                        <td class="text">{{$attendance->note}}</td>
                        {{-- @php
                            dd(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('l'))
                        @endphp --}}
                    @else
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    @endif
                        @if ($attendance == null)
                            @if(Carbon\Carbon::parse($date)->format('l') == "Friday")
                        <td class="text text-info">
                            Friday
                        </td>
                        @else
                        <td class="text text-danger">
                            Absent
                        </td>
                        @endif 
                    @else
                        <td> </td>
                    @endif
              
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Attendance')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'attendance.store', 'method' => 'post', 'files' => true]) !!}
                @php
                $employee=\App\Employee::where('user_id',Auth::user()->id)->first();
                // dd($employee->id);
                @endphp
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Employee')}} *</label>
                        <select class="form-control selectpicker" name="employee_id" required title="Employee" readonly>
                            <option value="{{ $employee->id }}" selected>{{ Auth::user()->name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.date')}} *</label>
                        <input type="text" name="date" class="form-control" value="{{date($general_setting->date_format)}}" required readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Attendance Type *</label>
                        <select class="form-control selectpicker" name="attendance_type" required title="Employee" readonly>
                            <option value="0" selected>Check in</option>
                            <option value="1" >Check out</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label>Time *</label>
                        <input type="text" id="time" name="time" class="form-control"  required readonly>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Location *</label>
                        <input type="text" id="location" name="location" class="form-control" required readonly>
                    </div>

                    <div class="col-md-12 form-group">
                        <label>{{trans('file.Note')}}</label>
                        <textarea name="note" rows="3" class="form-control"></textarea>
                    </div>
                    <input type="hidden" id="lat" name="lat">
                    <input type="hidden" id="lng" name="lng">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function(){
        //Set time
    var time = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
    $("#time").val(time);

    //Set location
        navigator.geolocation.getCurrentPosition(function(position) {        
            var  lat = position.coords.latitude;
            var  lng = position.coords.longitude;  
            $("#lat").val(lat);
            $("#lng").val(lng);
        });


    });

	$("ul#hrm").siblings('a').attr('aria-expanded','true');
    $("ul#hrm").addClass("show");
    $("ul#hrm #attendance-menu").addClass("active");

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

    var attendance_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
	var date = $('.date');
    date.datepicker({
     format: "yyyy-dd-mm-",
     autoclose: true,
     todayHighlight: true
     });

    $('#checkin, #checkout').timepicker({
    	'step': 15,
    });

    var table = $('#attendance-table').DataTable( {
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
             "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [
            {
                "orderable": false,
                'targets': [0, 7]
            },
            {
                'render': function(data, type, row, meta){
                    if(type === 'display'){
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
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[30, 31, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                text: '{{trans("file.PDF")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                }
            },
            {
                extend: 'csv',
                text: '{{trans("file.CSV")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                },
            },
            {
                extend: 'print',
                text: '{{trans("file.Print")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                },
            },
            {
                text: '{{trans("file.delete")}}',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    // if(user_verified == '1') {
                        attendance_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                attendance_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(attendance_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'attendance/deletebyselection',
                                data:{
                                    attendanceIdArray: attendance_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!attendance_id.length)
                            alert('Nothing is selected!');
                    // }
                    // else
                    //     alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '{{trans("file.Column visibility")}}',
                columns: ':gt(0)'
            },
        ],
    } );
</script>
@endsection
