 <?php $__env->startSection('content'); ?>
<?php if(session()->has('create_message')): ?>
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('create_message'); ?></div>
<?php endif; ?>
<?php if(session()->has('edit_message')): ?>
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('edit_message')); ?></div>
<?php endif; ?>
<?php if(session()->has('import_message')): ?>
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('import_message'); ?></div>
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger">
            <?php echo e($error); ?>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<section>
    <div class="container-fluid">
        <?php if(in_array("reminder-add", $all_permission)): ?>
           <a href="#" class="btn btn-info" data-toggle="modal" data-target="#reminderModal"><i class="fa fa-clock-o"></i> Add Reminder</a>
        <?php endif; ?>
    </div>
    <div class="table-responsive">
        <table id="reminder-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>Customer</th>
                    <th>Topic</th>
                    <th>Note</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Created By</th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
               <?php $__currentLoopData = $reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reminder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr data-id="<?php echo e($reminder->id); ?>">
                      <td></td>
                      <td><?php echo e($reminder->customer->company_name); ?></td>
                      <td><?php echo e($reminder->topic); ?></td>
                      <td><?php echo e($reminder->note); ?></td>
                      <td><?php echo e(date('F d, Y', strtotime($reminder->date))); ?></td>
                      <td><?php echo e(date('h:i A', strtotime($reminder->time))); ?></td>
                      <td>
                          <?php if($reminder->status == 1): ?>
                             <a href="<?php echo e(route('status.complete',$reminder->id)); ?>" class="badge badge-success">Incomplete</a>
                          <?php else: ?>
                             <a href="<?php echo e(route('status.incomplete',$reminder->id)); ?>" class="badge badge-danger">Complete</a>
                          <?php endif; ?>
                      </td>
                      <td><?php echo e(date('F d, Y', strtotime($reminder->created_at))); ?></td>
                      <td><?php echo e($reminder->user->name); ?></td>
                      <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <?php if(in_array("reminder-edit", $all_permission)): ?>
                                <li>
                                    <a href="#" data-id=<?php echo e($reminder->id); ?> class="edit-reminder btn btn-link"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></a>
                                </li>
                                <?php endif; ?>
                                <li class="divider"></li>
                                <?php if(in_array("reminder-delete", $all_permission)): ?>
                                <?php echo e(Form::open(['route' => ['reminder.destroy', $reminder->id], 'method' => 'DELETE'] )); ?>

                                <li>
                                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> <?php echo e(trans('file.delete')); ?></button>
                                </li>
                                <?php echo e(Form::close()); ?>

                                <?php endif; ?>
                            </ul>
                        </div>
                      </td>
                   </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</section>



<div id="reminderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'reminder.store', 'method' => 'post']); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Add Reminder<h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>

            <div class="form-group">
                <label>Customer *</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    <option selected="selected" value>Select Customer</option>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->company_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Topic *</label>
                <input type="text" name="topic" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Date *</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Time *</label>
                <input type="time" name="time" class="form-control" required>
            </div>
            <div class="form-group">
                <label><?php echo e(trans('file.Note')); ?></label>
                <textarea name="note" rows="4" class="form-control"></textarea>
            </div>
            <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary" id="submit-button">
        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
</div>

<div id="edit-reminder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'reminderUpdate', 'method' => 'post']); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Update Reminder<h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>

            <div class="form-group">
                <label>Customer *</label>
                <input type="hidden" name="customer_id" id="edit_customer_id" class="form-control" required>
                <input type="text" name="customer_name" id="edit_customer_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Topic *</label>
                <input type="text" name="topic" id="edit_topic" class="form-control" required>
                <input type="hidden" name="reminder_id" id="edit_reminder_id">
            </div>
            <div class="form-group">
                <label>Date *</label>
                <input type="date" name="date" id="edit_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Time *</label>
                <input type="time" name="time" id="edit_time" class="form-control" required>
            </div>
            <div class="form-group">
                <label><?php echo e(trans('file.Note')); ?></label>
                <textarea name="note" id="edit_note" rows="4" class="form-control"></textarea>
            </div>
            <input type="submit" value="<?php echo e(trans('file.update')); ?>" class="btn btn-primary" id="submit-button">
        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
</div>

<script type="text/javascript">
    $("ul#reminder").siblings('a').attr('aria-expanded','true');
    $("ul#reminder").addClass("show");
    $("ul#reminder #reminder-list-menu").addClass("active");

    var reminder_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".edit-reminder").on("click",function(){
        var reminder_id = $(this).closest('tr').attr('data-id');
        $.get('reminder/' + reminder_id +'/edit', function (data) {
          $('#edit-reminder').modal('show');
          $('#edit_topic').val(data.topic);
          $('#edit_customer_id').val(data.customer.id);
          $('#edit_customer_name').val(data.customer.company_name);
          $('#edit_date').val(data.date);
          $('#edit_time').val(data.time);
          $('#edit_note').val(data.note);
          $('#edit_reminder_id').val(data.id);
      });

    });
    var table = $('#reminder-table').DataTable( {
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
                'targets': [0, 9]
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
                    rows: ':visible'
                },
            },
            {
                extend: 'csv',
                text: '<?php echo e(trans("file.CSV")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'print',
                text: '<?php echo e(trans("file.Print")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                text: '<?php echo e(trans("file.delete")); ?>',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    // if(user_verified == '1') {
                        reminder_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                reminder_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(reminder_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'reminder/deletebyselection',
                                data:{
                                    reminderIdArray: reminder_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!reminder_id.length)
                            alert('No reminder is selected!');
                    // }
                    // else
                    //     alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            },
        ],
    } );
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bdtech\resources\views/reminder/index.blade.php ENDPATH**/ ?>