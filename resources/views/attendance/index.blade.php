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
    <div class="table-responsive">
        <table id="attendance-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.date')}}</th>
                    <th>{{trans('file.Employee')}}</th>
                    <th> Type </th>
                    <th> Time </th>
                    <th>{{trans('file.Status')}}</th>
                    <th> Note </th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_attendance_all as $key => $attendance)
                @php 
                    $employee = \App\Employee::find($attendance->employee_id);
                    $user = \App\User::find($attendance->employee_id);
                @endphp
                <tr data-id="{{$attendance->id}}">
                    <td>{{$key}}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $user->name }}</td>
                    @if($attendance->attendance_type == 0)
                        <td> Checkin </td>
                    @else
                        <td> Checkout </td>
                    @endif
                    <td>{{ $attendance->time }}</td>
                    @if($attendance->status == 1)
                        <td><div class="badge badge-success">{{trans('file.Present')}}</div></td>
                    @elseif($attendance->status == 2)
                        <td><div class="badge badge-danger">{{trans('file.Late')}}</div></td>
                    @else
                        <td><div class="badge badge-danger">Early Leave</div></td>
                    @endif
                    <td>{{ $attendance->note }}</td>
                    <td>
                        <div class="btn-group">
                            {{ Form::open(['route' => ['attendance.destroy', $attendance->id], 'method' => 'DELETE'] ) }}
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirmDelete()" title="{{trans('file.delete')}}"><i class="dripicons-trash"></i></button>
                            {{ Form::close() }}
                        </div>
                    </td>
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
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Employee')}} *</label>
                        <select class="form-control selectpicker" name="employee_id" required title="Employee" readonly>
                            <option value="{{ Auth::id() }}" selected>{{ Auth::user()->name }}</option>
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
     format: "dd-mm-yyyy",
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
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
