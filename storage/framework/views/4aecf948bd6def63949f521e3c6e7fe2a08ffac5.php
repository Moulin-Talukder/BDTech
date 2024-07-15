 <?php $__env->startSection('content'); ?>
<?php if(session()->has('not_permitted')): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
<?php endif; ?>
<section class="forms">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Update Customer')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <?php echo Form::open(['route' => ['customer.update',$lims_customer_data->id], 'method' => 'put', 'files' => true]); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Customer Group')); ?> *</strong> </label>
                                    <div class="input-group">
                                        <select class="form-control sel" id="customer_group_id" name="customer_group_id">
                                            <?php $__currentLoopData = $lims_customer_group_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($customer_group->id); ?>" <?php echo e(($lims_customer_data->customer_group_id == $customer_group->id)?"selected":''); ?>><?php echo e($customer_group->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#customergroupModal" title=""><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="validation-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('Customer Priority')); ?> *</strong> </label>
                                    <div class="input-group">
                                    <select class="form-control sel" id="priority_id" name="priority_id">
                                        <?php $__currentLoopData = $lims_priority_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($priority->id); ?>" <?php echo e(($lims_customer_data->priority_id == $priority->id)?"selected":''); ?>><?php echo e($priority->priority); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                        <div class="input-group-append">
                                            <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#customerPriorityModal" title=""><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="validation-msg"></span>
                                </div>
                            </div>
 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Company Name')); ?> </label>
                                    <input type="text" name="company_name" value="<?php echo e($lims_customer_data->company_name); ?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('Designation')); ?></label>
                                    <input type="text" name="designation" value="<?php echo e($lims_customer_data->designation); ?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label><?php echo e(trans('file.Email')); ?></label>
                                    <input type="email" name="email" value="<?php echo e($lims_customer_data->email); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Phone Number')); ?> *</label>
                                    <input type="text" name="phone_number" required value="<?php echo e($lims_customer_data->phone_number); ?>" class="form-control">
                                    <?php if($errors->has('phone_number')): ?>
                                    <span>
                                        <strong><?php echo e($errors->first('phone_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.VAT Number')); ?></label>
                                    <input type="text" name="vat_no" class="form-control" value="<?php echo e($lims_customer_data->vat_no); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('Factory Address')); ?> *</label>
                                    <textarea id="factory_address" type="text" class="form-control" name="factory_address" placeholder="Enter address ..." required rows="2"><?php echo e($lims_customer_data->factory_address); ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('Head Office Address')); ?> *</label>
                                    <textarea id="head_office_address" type="text" class="form-control" name="head_office_address" placeholder="Enter address ..." required rows="2"><?php echo e($lims_customer_data->head_office_address); ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Interest</label>
                                    <select class="form-control" id="interest_id" name="interest_id">
                                        <?php $__currentLoopData = $interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($interest->id); ?>" <?php echo e(($lims_customer_data->interest_id == $interest->id)?"selected":''); ?>><?php echo e($interest->topic); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Image')); ?></label>
                                    <input type="file" name="image" onchange="loadFile(event);" class="form-control">
                                    <?php if($errors->has('image')): ?>
                                    <span>
                                        <strong><?php echo e($errors->first('image')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <img id="output" width="30%" />
                            </div>

                            <div class="col-md-6">
                            <label><?php echo e(trans('file.Note')); ?></label>
                            <textarea name="first_comment" rows="4" class="form-control"><?php echo e($lims_customer_data->first_comment); ?></textarea>
                            </div>

                            <?php $json_person = json_decode($lims_customer_data->contract_person,true); ?>
                            <?php $json_phone = json_decode($lims_customer_data->contract_phone,true); ?>


                            <div class="col-md-12" id="contract_person">
                                <?php $__currentLoopData = $json_phone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label><?php echo e(trans('Contract Person')); ?></label>
                                            <input type="text" name="contract_person[]" value="<?php echo e($json_person[$key]); ?>" class="form-control" placeholder="Enter contract person name">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label><?php echo e(trans('Phone Number')); ?></label>
                                            <input type="text" name="contract_phone[]" value="<?php echo e($phone); ?>" class="form-control" placeholder="Enter phone number">
                                        </div>
                                    </div>
                                    <?php if($key >0): ?>
                                    <div class="col-md-2">
                                        <a class="btn btn-danger btn-sm" style="color: white;margin-top: 35px;" id="remove_contact">- Remove Person</a>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-2">
                                        <a class="btn btn-danger btn-sm" id="add_contact" style="color: white;
                                        margin-top: 35px;">+ Add Person</a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <input type="hidden" value="<?php echo e($lims_customer_data->user_id); ?>">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="pos" value="0">
                            <input type="submit" value="<?php echo e(trans('file.update')); ?>" class="btn btn-primary">
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="customergroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <?php echo Form::open(['route' => 'customer_group.store', 'method' => 'post']); ?>

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Customer Group')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <form>
                    <div class="form-group">
                        <label><?php echo e(trans('file.name')); ?> *</label>
                        <input type="text" name="name" required="required" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('file.Percentage')); ?>(%) *</label>
                        <input type="text" name="percentage" required="required" class="form-control">
                    </div>

                    <input type="hidden" name="returntocustomer" value="1">
                    <div class="form-group">
                        <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                    </div>
                </form>
            </div>

            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>


<div id="customerPriorityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
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

                <input type="hidden" name="returntocustomer" value="1">

                <div class="form-group">
                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>

<script type="text/javascript">
    $("ul#people").siblings('a').attr('aria-expanded', 'true');
    $("ul#people").addClass("show");
    $("ul#people #customer-create-menu").addClass("active");

    $(document).ready(function() {
        var max_field = 5;
        var wrapper = $("#contract_person");
        var x = 1;
        $("#add_contact").click(function() {
            if (x < max_field) {
                x++;
                $(wrapper).append('<div class="row" id="new_row">\
                                    <div class="col-md-5">\
                                        <div class="form-group">\
                                            <label><?php echo e(trans('
                    Contract Person ')); ?></label>\
                                            <input type="text" name="contract_person[]" class="form-control" placeholder="Enter contract person name">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-5">\
                                        <div class="form-group">\
                                            <label><?php echo e(trans('
                    Phone Number ')); ?></label>\
                                            <input type="text" name="contract_phone[]" class="form-control" placeholder="Enter phone number">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-2">\
                                        <a class="btn btn-danger btn-sm" style="color: white;margin-top: 35px;"  id="remove_contact">- Remove Person</a>\
                                    </div>\
                                </div>');
            } else {
                alert('you can not add more than 5 field');
            }
        });

        $(document).on('click', '#remove_contact', function() {
            $('#new_row').remove();
            x--;
        });
    });



    //$("#name").val(getSavedValue("name"));
    //$("#customer-group-id").val(getSavedValue("customer-group-id"));

    function saveValue(e) {
        var id = e.id; // get the sender's id to save it.
        var val = e.value; // get the value.
        localStorage.setItem(id, val); // Every time user writing something, the localStorage's value will override.
    }
    //get the saved value function - return the value of "v" from localStorage.
    function getSavedValue(v) {
        if (!localStorage.getItem(v)) {
            return ""; // You can change this to your defualt value.
        }
        return localStorage.getItem(v);
    }

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    var previewFile = function(event) {
        var preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.onload = function() {
            URL.revokeObjectURL(preview.src) // free memory
        }
    };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bdtech_new\resources\views/customer/edit.blade.php ENDPATH**/ ?>