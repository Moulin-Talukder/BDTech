 <?php $__env->startSection('content'); ?>
<?php if($errors->has('topic')): ?>
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e($errors->first('topic')); ?></div>
<?php endif; ?>
<?php if($errors->has('details')): ?>
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e($errors->first('details')); ?></div>
<?php endif; ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div>
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
<?php endif; ?>

<section>
    <div class="container-fluid">
        <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="dripicons-plus"></i> Add Priority </button>&nbsp;
    </div>
    <div class="table-responsive">
        <table id="interest-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>Priority</th>
                    <th>Note</th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_priority_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-id="<?php echo e($priority->id); ?>">
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e($priority->priority); ?></td> 
                    <td><?php echo e($priority->note); ?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li><button type="button" data-id="<?php echo e($priority->id); ?>" class="open-EditinterestDialog btn btn-link" data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></button></li>
                                <li class="divider"></li>
                                <?php echo e(Form::open(['route' => ['priority.destroy', $priority->id], 'method' => 'DELETE'] )); ?>

                                <li>
                                    <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure want to delete?')"><i class="dripicons-trash"></i> <?php echo e(trans('file.delete')); ?></button>
                                </li>
                                <?php echo e(Form::close()); ?>

                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</section>

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'priority.store', 'method' => 'post', 'files' => true]); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Add Priority</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
            <div class="form-group">
                <label>Priority *</label>
                <?php echo e(Form::text('priority',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type priority name...'))); ?>

            </div>
            <div class="form-group">
                <label>Note</label>
                <?php echo e(Form::textarea('note',null,array('class' => 'form-control','rows'=>'4', 'placeholder' => 'Type priority note...'))); ?>

            </div>
            <div class="form-group">
              <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
            </div>
        </div>
        <?php echo e(Form::close()); ?>

      </div>
    </div>
</div>

<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
        <?php echo e(Form::open(['route' => ['priority.update', 1], 'method' => 'PUT', 'files' => true] )); ?>

      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title"> Priority Update</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
          <div class="form-group">
            <label>Priority * </label>
            <?php echo e(Form::text('priority',null, array('required' => 'required', 'class' => 'form-control'))); ?>

        </div>
        <input type="hidden" name="priority_id">
        <div class="form-group">
            <label>Note</label>
            <?php echo e(Form::textarea('note',null,array('class' => 'form-control','id'=>'note','rows'=>'4', 'placeholder' => 'Type interest topic details...'))); ?>

        </div>
        <div class="form-group">
            <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
          </div>
        </div>
      <?php echo e(Form::close()); ?>

    </div>
  </div>
</div>


<script type="text/javascript">

    $("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #interest-menu").addClass("active");

    var interest_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( "#select_all" ).on( "change", function() {
        if ($(this).is(':checked')) {
            $("tbody input[type='checkbox']").prop('checked', true);
        }
        else {
            $("tbody input[type='checkbox']").prop('checked', false);
        }
    });


    $(document).ready(function() {
        $('.open-EditinterestDialog').on('click', function() {
            var url = "priority/"
            var id = $(this).data('id').toString();
            url = url.concat(id).concat("/edit");

            $.get(url, function(data) {
                $("input[name='priority']").val(data['priority']);
                $("#note").val(data['note']);
                $("input[name='priority_id']").val(data['id']);

            });
        });
    });

    $('#interest-table').DataTable( {
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
                'targets': [0, 1, 3]
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
                    stripHtml: false
                },
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
                    stripHtml: false
                },
            },
            {
                text: '<?php echo e(trans("file.delete")); ?>',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    // if(user_verified == '1') {
                        interest_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                interest_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(interest_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'interest/deletebyselection',
                                data:{
                                    interestIdArray: interest_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!interest_id.length)
                            alert('No interest is selected!');
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

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bdtech\resources\views/priority/index.blade.php ENDPATH**/ ?>