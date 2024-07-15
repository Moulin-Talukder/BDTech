@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif

<section>
    <div class="container">
            <form method="POST" action="{{route('attendance.report.momthly')}}" class="form-inline">
                @csrf
                    <div class="position-relative form-group">
                        <label for="">From Date</label>
                        <input type="month" placeholder="Date" name="month" id="" value="">
                    </div>
                <button type="submit" class="btn btn-primary report-inputs"><i class="fa fa-line-chart" aria-hidden="true"></i></button>
            </form>
        {{-- <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="dripicons-plus"></i> {{trans('file.Add Attendance')}} </button> --}}
    </div>

    <div class="table-responsive">



        <table class="table">
        	<thead>
	        	 <tr>

	             </tr>
	         </thead>
        </table>


         <table class="table table-bordered">
        		<tr>

                </tr>
         </table>

    </div>

    {{-- @endif --}}

</section>

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
    $("ul#hrm #monthly-attendance-menu").addClass("active");

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
            // {
            //     text: '{{trans("file.delete")}}',
            //     className: 'buttons-delete',
            //     action: function ( e, dt, node, config ) {
            //         if(user_verified == '1') {
            //             attendance_id.length = 0;
            //             $(':checkbox:checked').each(function(i){
            //                 if(i){
            //                     attendance_id[i-1] = $(this).closest('tr').data('id');
            //                 }
            //             });
            //             if(attendance_id.length && confirm("Are you sure want to delete?")) {
            //                 $.ajax({
            //                     type:'POST',
            //                     url:'attendance/deletebyselection',
            //                     data:{
            //                         attendanceIdArray: attendance_id
            //                     },
            //                     success:function(data){
            //                         alert(data);
            //                     }
            //                 });
            //                 dt.rows({ page: 'current', selected: true }).remove().draw(false);
            //             }
            //             else if(!attendance_id.length)
            //                 alert('Nothing is selected!');
            //         }
            //         else
            //             alert('This feature is disable for demo!');
            //     }
            // },
            {
                extend: 'colvis',
                text: '{{trans("file.Column visibility")}}',
                columns: ':gt(0)'
            },
        ],
    } );
</script>
@endsection
