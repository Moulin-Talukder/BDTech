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
    <div class="container-fluid mb-2">
        <?php if(in_array("customers-add", $all_permission)): ?>
            <a href="<?php echo e(route('customer.create')); ?>" class="btn btn-info"><i class="dripicons-plus"></i> <?php echo e(trans('file.Add Customer')); ?></a>&nbsp;
            <a href="#" data-toggle="modal" data-target="#importCustomer" class="btn btn-primary"><i class="dripicons-copy"></i> <?php echo e(trans('file.Import Customer')); ?></a>
        <?php endif; ?>
    </div>

    <div class="container-fluid" style="margin-top:20px;">
        <div class="card">
            <?php echo Form::open(['route' => 'customer.filter', 'method' => 'post']); ?>

            <div class="row pl-3 mb-3">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <div class="d-tc">
                            <div class="form-group">
                                <label class="d-tc mt-2"><strong><?php echo e(trans('file.Choose Your Date')); ?></strong> &nbsp;</label>
                                <input type="text" name="date_range" class="daterangepicker-field form-control" value="<?php echo e(isset($start_date) ? $start_date.' To '.$end_date : ''); ?>" placeholder="Please select your date range" autocomplete="off"/>
                                <input type="hidden" name="start_date"/>
                                <input type="hidden" name="end_date"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="form-group<?php echo e($errors->has('interest_id') ? ' has-error' : ''); ?> has-feedback">
                        <label class="d-tc mt-2"><strong>Choose Interest</strong> &nbsp;</label>
                        <select name="interest_id" id="interest_id" class="form-control">
                            <option value="0">Select Interest</option>
                            <?php $__currentLoopData = $interests_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($interest_id)): ?>
                                    <option value="<?php echo e($interest->id); ?>" <?php echo e(($interest->id == $interest_id) ? 'selected':''); ?>><?php echo e($interest->topic); ?></option>
                                <?php else: ?>
                                   <option value="<?php echo e($interest->id); ?>"><?php echo e($interest->topic); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('interest_id')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('interest_id')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="form-group<?php echo e($errors->has('group_id') ? ' has-error' : ''); ?> has-feedback">
                        <label class="d-tc mt-2"><strong>Customer Group</strong> &nbsp;</label>
                        <select name="group_id" id="group_id" class="form-control">
                            <option value="0">Select Customer Group</option>
                            <?php $__currentLoopData = $lims_customer_group_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($customer_group_id)): ?>
                                    <option value="<?php echo e($customer_group->id); ?>" <?php echo e(($customer_group->id == $customer_group_id) ? 'selected':''); ?>><?php echo e($customer_group->name); ?></option>
                                <?php else: ?>
                                   <option value="<?php echo e($customer_group->id); ?>"><?php echo e($customer_group->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('group_id')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('group_id')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="form-group<?php echo e($errors->has('priority_id') ? ' has-error' : ''); ?> has-feedback">
                        <label class="d-tc mt-2"><strong>Customer Priority</strong> &nbsp;</label>
                        <select name="priority_id" id="priority_id" class="form-control">
                            <option value="0">Select Customer Priority</option>
                            <?php $__currentLoopData = $lims_priority_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($priority_id)): ?>
                                    <option value="<?php echo e($priority->id); ?>" <?php echo e(($priority->id == $priority_id) ? 'selected':''); ?>><?php echo e($priority->priority); ?></option>
                                <?php else: ?>
                                   <option value="<?php echo e($priority->id); ?>"><?php echo e($priority->priority); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('priority_id')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('priority_id')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-2 mt-4">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" style="margin-top:40px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>


        </div>
    </div>


    <div class="table-responsive">
        <table id="customer-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Customer Group')); ?></th>
                    <th><?php echo e(trans('Priority')); ?></th>
                    <th><?php echo e(trans('file.Date')); ?></th>
                    <th><?php echo e(trans('file.Company Name')); ?></th>
                    <th><?php echo e(trans('file.Email')); ?></th>
                    <th>Interest</th>
                    <th><?php echo e(trans('file.Balance')); ?></th>
                    <th><?php echo e(trans('First Comment')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_customer_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-id="<?php echo e($customer->id); ?>">
                    <td><?php echo e($key); ?></td>
                    <td>
                        <?php $customer_group = DB::table('customer_groups')->where('id',$customer->customer_group_id)->first(); ?>
                        <?php echo e($customer_group->name); ?>

                    </td>
                    <td>
                        <?php if(!empty($customer->priority)): ?>
                            <?php echo e($customer->priority->priority); ?>

                        <?php else: ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e(date("d/m/Y", strtotime($customer->created_at))); ?></td>
                    <td><?php echo e($customer->company_name); ?> [<?php echo e($customer->phone_number); ?>]</td>
                    <td><?php echo e($customer->email); ?></td>
                    <td>

                        <?php if($customer->interest == null): ?>
                           N/A
                        <?php else: ?>
                          <?php echo e($customer->interest->topic); ?>

                        <?php endif; ?>

                    </td>
                    <td><?php echo e(number_format($customer->deposit - $customer->expense, 2)); ?></td>
                    <td><?php echo e($customer->first_comment); ?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <?php if(in_array("customers-edit", $all_permission)): ?>
                                <li>
                                    <a href="<?php echo e(route('customer.edit', $customer->id)); ?>" class="btn btn-link"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></a>
                                </li>
                                <?php endif; ?>
                               <li>
                                    <button type="button" data-id="<?php echo e($customer->id); ?>" class="comment btn btn-link" data-toggle="modal" data-target="#commentModal" ><i class="fa fa-comment"></i> <?php echo e(trans('Comment')); ?></button>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('customer.show', $customer->id)); ?>" class="btn btn-link"><i class="fa fa-file"></i> Details</a>
                                </li>
                                <li>
                                    <button type="button" data-id="<?php echo e($customer->id); ?>" class="deposit btn btn-link" data-toggle="modal" data-target="#depositModal" ><i class="dripicons-plus"></i> <?php echo e(trans('file.Add Deposit')); ?></button>
                                </li>
                                <li>
                                    <button type="button" data-id="<?php echo e($customer->id); ?>" class="getDeposit btn btn-link"><i class="fa fa-money"></i> <?php echo e(trans('file.View Deposit')); ?></button>
                                </li>
                                <li>
                                    <button type="button" data-id="<?php echo e($customer->id); ?>" class="reminder btn btn-link" data-toggle="modal" data-target="#reminderModal" ><i class="fa fa-clock-o"></i> Reminder</button>
                                </li>
                                <li class="divider"></li>
                                <?php if(in_array("customers-delete", $all_permission)): ?>
                                <?php echo e(Form::open(['route' => ['customer.destroy', $customer->id], 'method' => 'DELETE'] )); ?>

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

<div id="importCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'customer.import', 'method' => 'post', 'files' => true]); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Import Customer')); ?></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
           <p><?php echo e(trans('file.The correct column order is')); ?> (customer_group*, customer_priority*,company_name*,email, phone_number*, address*, city*, state, postal_code, customer_interest*,country) <?php echo e(trans('file.and you must follow this')); ?>.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo e(trans('file.Upload CSV File')); ?> *</label>
                        <?php echo e(Form::file('file', array('class' => 'form-control','required'))); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> <?php echo e(trans('file.Sample File')); ?></label>
                        <a href="public/sample_file/customer.csv" class="btn btn-info btn-block btn-md"><i class="dripicons-download"></i>  <?php echo e(trans('file.Download')); ?></a>
                    </div>
                </div>
            </div>
            <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary" id="submit-button">
        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
</div>

<div id="depositModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'customer.addDeposit', 'method' => 'post']); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Deposit')); ?></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
            <div class="form-group">
                <input type="hidden" name="customer_id">
                <label><?php echo e(trans('file.Amount')); ?> *</label>
                <input type="number" name="amount" step="any" class="form-control" required>
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

<div id="view-deposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.All Deposit')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover deposit-list">
                    <thead>
                        <tr>
                            <th><?php echo e(trans('file.date')); ?></th>
                            <th><?php echo e(trans('file.Amount')); ?></th>
                            <th><?php echo e(trans('file.Note')); ?></th>
                            <th><?php echo e(trans('file.Created By')); ?></th>
                            <th><?php echo e(trans('file.action')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="edit-deposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Update Deposit')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <?php echo Form::open(['route' => 'customer.updateDeposit', 'method' => 'post']); ?>

                    <div class="form-group">
                        <label><?php echo e(trans('file.Amount')); ?> *</label>
                        <input type="number" name="amount" step="any" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('file.Note')); ?></label>
                        <textarea name="note" rows="4" class="form-control"></textarea>
                    </div>
                    <input type="hidden" name="deposit_id">
                    <button type="submit" class="btn btn-primary"><?php echo e(trans('file.update')); ?></button>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>

<div id="reminderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'customer.addReminder', 'method' => 'post']); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Add Reminder<h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Topic *</label>
                        <input type="text" name="topic" class="form-control" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Customer Name *</label>
                        <input type="hidden" name="customer_id">
                        <input type="text" name="customer" class="form-control" readonly>
                    </div>
                </div>
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

<div id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'customer.addComment', 'method' => 'post']); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Add Comment<h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Topic *</label>
                        <input type="text" name="topic" class="form-control" required>
                    </div>
                </div>
                        <input type="hidden" name="customer_id">
                     
            </div>
            <div class="form-group">
            <label><?php echo e(trans('file.Note')); ?> *</label>
                <textarea name="details" rows="4" class="form-control" required></textarea>
            </div>
            <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary" id="submit-button">
        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
</div>

<script type="text/javascript">
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
    $("ul#people #customer-list-menu").addClass("active");

    function confirmDelete() {
      if (confirm("Are you sure want to delete?")) {
          return true;
      }
      return false;
    }

    var customer_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    var all_permission = <?php echo json_encode($all_permission) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $(".deposit").on("click", function() {
        var id = $(this).data('id').toString();
        $("#depositModal input[name='customer_id']").val(id);
  });

  $(".reminder").on("click",function(){
       var id = $(this).data('id').toString();
       $("#reminderModal input[name='customer_id']").val(id);
       $.get('customer/getCustomer/' + id, function(data) {
            $("#reminderModal input[name='customer']").val(data.name);
       });
    });
  $(".comment").on("click",function(){
      var id = $(this).data('id').toString();
      $("#commentModal input[name='customer_id']").val(id);
      $.get('customer/getCustomer/' + id, function(data) {
          console.log(data);
            $("#commentModal input[name='customer']").val(data.name);
       });
  });

  $(".getDeposit").on("click", function() {
        var id = $(this).data('id').toString();
        $.get('customer/getDeposit/' + id, function(data) {
            $(".deposit-list tbody").remove();
            var newBody = $("<tbody>");
            $.each(data[0], function(index){
                var newRow = $("<tr>");
                var cols = '';

                cols += '<td>' + data[1][index] + '</td>';
                cols += '<td>' + data[2][index] + '</td>';
                if(data[3][index])
                    cols += '<td>' + data[3][index] + '</td>';
                else
                    cols += '<td>N/A</td>';
                cols += '<td>' + data[4][index] + '<br>' + data[5][index] + '</td>';
                cols += '<td><div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans("file.action")); ?><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu"><li><button type="button" class="btn btn-link edit-btn" data-id="' + data[0][index] +'" data-toggle="modal" data-target="#edit-deposit"><i class="dripicons-document-edit"></i> <?php echo e(trans("file.edit")); ?></button></li><li class="divider"></li><?php echo e(Form::open(['route' => 'customer.deleteDeposit', 'method' => 'post'] )); ?><li><input type="hidden" name="id" value="' + data[0][index] + '" /> <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> <?php echo e(trans("file.delete")); ?></button></li><?php echo e(Form::close()); ?></ul></div></td>'
                newRow.append(cols);
                newBody.append(newRow);
                $("table.deposit-list").append(newBody);
            });
            $("#view-deposit").modal('show');
        });
  });

  $("table.deposit-list").on("click", ".edit-btn", function(event) {
        var id = $(this).data('id');
        var rowindex = $(this).closest('tr').index();
        var amount = $('table.deposit-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
        var note = $('table.deposit-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(3)').text();
        if(note == 'N/A')
            note = '';

        $('#edit-deposit input[name="deposit_id"]').val(id);
        $('#edit-deposit input[name="amount"]').val(amount);
        $('#edit-deposit textarea[name="note"]').val(note);
        $('#view-deposit').modal('hide');
    });

    var table = $('#customer-table').DataTable( {
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
                'targets': [0, 8]
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
                        customer_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                customer_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(customer_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'customer/deletebyselection',
                                data:{
                                    customerIdArray: customer_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!customer_id.length)
                            alert('No customer is selected!');
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

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  if(all_permission.indexOf("customers-delete") == -1)
        $('.buttons-delete').addClass('d-none');

    $("#export").on("click", function(e){
        e.preventDefault();
        var customer = [];
        $(':checkbox:checked').each(function(i){
          customer[i] = $(this).val();
        });
        $.ajax({
           type:'POST',
           url:'/exportcustomer',
           data:{
                customerArray: customer
            },
           success:function(data){
             alert('Exported to CSV file successfully! Click Ok to download file');
             window.location.href = data;
           }
        });
    });

$(".daterangepicker-field").daterangepicker({
  callback: function(startDate, endDate, period){
    var start_date = startDate.format('YYYY-MM-DD');
    var end_date = endDate.format('YYYY-MM-DD');
    var title = start_date + ' To ' + end_date;
    $('input[name="date_range"]').val(title);
    $('input[name="start_date"]').val(start_date);
    $('input[name="end_date"]').val(end_date);
  }
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bdtech\resources\views/customer/index.blade.php ENDPATH**/ ?>