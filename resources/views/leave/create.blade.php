@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif

<section>
    <div class="container-fluid">
        <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="dripicons-plus"></i> Leave Application </button>
    </div>
    <div class="table-responsive">
        <table id="attendance-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>Sl</th>
                    <th>Application Date</th>
                    <th>Start Date</th>
                    <th> End Date </th>
                    <th> Num of Days </th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaves as $leave)
                    <tr>
                        <th></th>
                        <th>{{$loop->iteration}}</th>
                        <th>{{$leave->date}}</th>
                        <td>{{$leave->from_date}}</td>
                        <td>{{$leave->to_date}}</td>
                        <td>{{$leave->num_of_days}}</td>
                        @if ($leave->status == 2)
                        <td class="badge badge-success">Approved</td>
                        @elseif($leave->status == 3)
                        <td class="badge badge-danger">Cancelled</td>
                        @else
                        <td class="badge badge-info">Pending</td>
                        @endif
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                    @if(in_array("attendance", $all_permission))
                                        @if($leave->status == 1)
                                        <li>
                                            <button type="button" data-id="{{$leave->employee_id}}" data-leave_id="{{$leave->id}}" data-from_date="{{$leave->from_date}}" data-to_date="{{$leave->to_date}}" data-num_of_days="{{$leave->num_of_days}}" data-leave_type="{{$leave->type}}" data-reason="{{$leave->reason}}" class="edit-btn btn btn-link" data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</button>
                                            {{-- <a href="{{ route('leave.edit', $leave->employee_id) }}" class="btn btn-link"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</a> --}}
                                            <li class="divider"></li>
                                            @if(in_array("attendance", $all_permission))
                                            {{ Form::open(['route' => ['leave.destroy', $leave->id], 'method' => 'DELETE'] ) }}
                                            <li>
                                                <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button>
                                            </li>
                                            {{ Form::close() }}
                                            @endif
                                        </li>
                                        @else
                                        <li>
                                            <button type="submit" class="btn btn-link" disabled title="You can't Edit"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</button>
                                        </li>
                                        <li>
                                            <button type="submit" class="btn btn-link" disabled title="You can't Delete"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button>
                                        </li>
                                        @endif
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

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Leave Application</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'leave.store', 'method' => 'post', 'files' => true]) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>From Date *</strong> </label>
                            <input type="date" id="from_date" name="from_date" required class="form-control query_date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>To Date *</strong> </label>
                            <input type="date" id="to_date" name="to_date" required class="form-control query_date">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Number of Days</label>
                            <input type="number" name="num_of_days" id="num_of_days" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Type *</label>
                            <select name="leave_type" id="leave_type" class="form-control selectpicker" required>
                                <option value="">Please Select</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Casual Leave">Casual Leave</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Note *</label>
                            <textarea name="reason" id="reason" cols="25" rows="2" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Leave Application</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => ['leave.update',1], 'method' => 'put', 'files' => true]) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>From Date *</strong> </label>
                            <input type="date" id="from_date" name="from_date" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>To Date *</strong> </label>
                            <input type="date" id="to_date" name="to_date" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Number of Days</label>
                            <input type="number" name="num_of_days" id="num_of_days" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Type *</label>
                            <select name="leave_type" id="leave_type" class="form-control selectpicker" required>
                                <option value="">Please Select</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Casual Leave">Casual Leave</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Reason *</label>
                            <textarea name="reason" id="reason" cols="25" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="employee_id">
                    <input type="hidden" name="leave_id">
                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
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

    // Number of days counting between two dates for leave application
    $('#to_date').on('change', function() {
        var start_date=$('#from_date').val();
        var end_date=$('#to_date').val();

        var dt1 = new Date(start_date);
        var dt2 = new Date(end_date);

      var time_difference = dt2.getTime() - dt1.getTime();
      var result = time_difference / (1000 * 60 * 60 * 24) + 1;
      $("#num_of_days").val(result);
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

    $('.edit-btn').on('click', function() {
        $("#editModal input[name='employee_id']").val( $(this).data('id') );
        $("#editModal input[name='leave_id']").val( $(this).data('leave_id') );
        $("#editModal input[name='from_date']").val( $(this).data('from_date') );
        $("#editModal input[name='to_date']").val( $(this).data('to_date') );
        $("#editModal input[name='num_of_days']").val( $(this).data('num_of_days') );
        $("#editModal select[name='leave_type']").val( $(this).data('leave_type') );
        $("#editModal textarea[name='reason']").val( $(this).data('reason') );
        $('.selectpicker').selectpicker('refresh');
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
                    //if(user_verified == '1') {
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
                    }
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
