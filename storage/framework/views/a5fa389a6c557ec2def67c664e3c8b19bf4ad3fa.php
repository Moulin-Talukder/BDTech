 <?php $__env->startSection('content'); ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>

<section>
    <div class="container">
            <form method="POST" action="<?php echo e(route('attendance.report')); ?>" class="form-inline">
                <?php echo csrf_field(); ?>
                    <div class="position-relative form-group">
                        <label for="">From Date</label>
                        <input type="date" placeholder="Date" name="start_date" id="" value="">

                        <label for="">To Date</label>
                        <input type="date" placeholder="Date" name="end_date" id="" value="">
                    </div>
                    <br>
                    <div class="position-relative form-group">
                        <label for="">Select Employee</label>
                        <select name="employee" id="employee">
                            <option value="">Select</option>
                            <?php $__currentLoopData = $all_employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my_employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($my_employee->id); ?>"><?php echo e($my_employee->name); ?>-<?php echo e($my_employee->employee_code); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </select>
                    </div>
                <button type="submit" class="btn btn-primary report-inputs"><i class="fa fa-line-chart" aria-hidden="true"></i></button>
            </form>
        
    </div>
    <?php if($data): ?>
    <hr>
    <div class="table-responsive">
        <table id="attendance-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>Log Date</th>
                    <th>Name</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Working Hour</th>
                    <th>Extra Hour</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_attendance_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-id="<?php echo e($attendance->id); ?>">
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e($attendance->date); ?></td>
                    <td><?php echo e($attendance->employee->name); ?></td>
                    <td><?php echo e($attendance->time); ?></td>
                    <td><?php echo e($attendance->checkout); ?></td>

                    <?php
                        $wh = \Carbon\Carbon::parse($attendance['checkout'])->diff(\Carbon\Carbon::parse($attendance['time']))->format('%H:%I:%S');
                        $dh = "08:00:00";
                    ?>

                    <td><?php echo e(\Carbon\Carbon::parse($attendance['checkout'])->diff(\Carbon\Carbon::parse($attendance['time']))->format('%H:%I:%S')); ?></td>
               
                    <?php if($wh > $dh): ?>
                        <td><?php echo e(\Carbon\Carbon::parse($dh)->diff(\Carbon\Carbon::parse($wh))->format('%H:%I:%S')); ?></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>

                    <?php if(\Carbon\Carbon::parse($attendance->employee->late_count)->lte(\Carbon\Carbon::parse($attendance->time)) && $wh < $dh): ?>
                        <td class="badge badge-danger">Late</td>
                    <?php elseif(\Carbon\Carbon::parse($attendance->employee->early_count)->gte(\Carbon\Carbon::parse($attendance->checkout)) && $wh < $dh): ?>
                        <td class="badge badge-success">Early Leave</td>
                    <?php else: ?>
                        <td class="badge badge-success">Present</td>
                    <?php endif; ?>
                    <td><?php echo e($attendance->note); ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo e(route('attendance.edit', $attendance->id)); ?>" class="btn btn-link"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    
    <div class="table-responsive">
        <h3 class="text text-center mt-5"><?php echo e($employee->name); ?>-<?php echo e($employee->employee_code); ?></h3>
        <table id="attendance-table" class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Log Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Status</th>
                    <th>Working Hour</th>
                    <th>Extra Hour</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php $__currentLoopData = $lims_attendance_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td></td>
                    <td><?php echo e($attendance->date); ?></td>

                    <?php if(isset($attendance)): ?>
                        <th><?php echo e(Carbon\Carbon::parse($attendance['time'])->format('H:i:s')); ?></th>
    
                        <?php if($attendance->checkout): ?>
                        <td><?php echo e(Carbon\Carbon::parse($attendance['checkout'])->format('H:i:s')); ?></td>
                        <?php else: ?>
                        <td></td>
                        <?php endif; ?>
                        <?php if(\Carbon\Carbon::parse($attendance->employee->late_count)->lte(\Carbon\Carbon::parse($attendance->time))): ?>
                            <td class="badge badge-danger">Late</td>
                        <?php else: ?>
                            <td class="badge badge-success">Present</td>
                        <?php endif; ?>

                        <?php
                            $wh = \Carbon\Carbon::parse($attendance['checkout'])->diff(\Carbon\Carbon::parse($attendance['time']))->format('%H:%I:%S');
                            $dh = "08:00:00";
                        ?>

                        <td><?php echo e(\Carbon\Carbon::parse($attendance['checkout'])->diff(\Carbon\Carbon::parse($attendance['time']))->format('%H:%I:%S')); ?></td>
                       
                            <?php if($wh > $dh): ?>
                            <td><?php echo e(\Carbon\Carbon::parse($dh)->diff(\Carbon\Carbon::parse($wh))->format('%H:%I:%S')); ?></td>
                            <?php else: ?>
                            <td></td>
                            <?php endif; ?>
                        <td class="text"><?php echo e($attendance->note); ?></td>
                    <?php else: ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php endif; ?>
                        <?php if($attendance == null): ?>
                            <?php if(Carbon\Carbon::parse($date)->format('l') == "Friday"): ?>
                        <td class="text text-info">
                            Friday
                        </td>
                        <?php else: ?>
                        <td class="text text-danger">
                            Absent
                        </td>
                        <?php endif; ?> 
                    <?php else: ?>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo e(route('attendance.edit', $attendance->id)); ?>" class="btn btn-link"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></a>
                        </div>
                    </td>
                    <?php endif; ?>
              
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    

</section>

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Create Attendance</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <?php echo Form::open(['route' => 'attendance.store', 'method' => 'post', 'files' => true]); ?>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Employee')); ?> *</label>
                        <select class="form-control selectpicker" name="employee_id" required title="Employee" readonly>
                            <option value="<?php echo e(Auth::id()); ?>" selected><?php echo e(Auth::user()->name); ?></option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.date')); ?> *</label>
                        <input type="text" name="date" class="form-control" value="<?php echo e(date($general_setting->date_format)); ?>" required readonly>
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
                        <label><?php echo e(trans('file.Note')); ?></label>
                        <textarea name="note" rows="3" class="form-control"></textarea>
                    </div>
                    <input type="hidden" id="lat" name="lat">
                    <input type="hidden" id="lng" name="lng">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                </div>
                <?php echo e(Form::close()); ?>

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

    // $('.btn-edit').on('click', function() {
    //     $("input[name='id']").val($(this).data('id'));
    //     $("input[name='date']").val($(this).data('date'));
    //     $("input[name='attendance_type']").val($(this).data('attendance_type'));
    //     $("input[name='time']").val($(this).data('check_in'));
    //     // $("input[name='time']").val($(this).data('checkout'));
    //     $("textarea[name='note']").val($(this).data('note'));   
    //     $("textarea[name='note']").val($(this).data('note'));   
    //     $('.selectpicker').selectpicker('refresh');   
    //     // alert($(this).data('attendance_type'));
    // });   


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
            'lengthMenu': '_MENU_ <?php echo e(trans("file.records per page")); ?>',
             "info":      '<small><?php echo e(trans("file.Showing")); ?> _START_ - _END_ (_TOTAL_)</small>',
            "search":  '<?php echo e(trans("file.Search")); ?>',
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
                text: '<?php echo e(trans("file.PDF")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                }
            },
            {
                extend: 'csv',
                text: '<?php echo e(trans("file.CSV")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                },
            },
            {
                extend: 'print',
                text: '<?php echo e(trans("file.Print")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                },
            },
            // {
            //     text: '<?php echo e(trans("file.delete")); ?>',
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
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            },
        ],
    } );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bdtech\resources\views/attendance/allemployeeattendance.blade.php ENDPATH**/ ?>