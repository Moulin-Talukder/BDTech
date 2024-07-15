

<?php $__env->startSection('content'); ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Edit Service</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <?php echo Form::open(['route' => ['services.update',$service_list->id], 'method' => 'put', 'files' => true, 'class' => 'payment-form']); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Service Name *</strong> </label>
                                        <input type="text" name="name" class="form-control" id="name" value="<?php echo e($service_list->name); ?>" aria-describedby="name" required>
                                        <span class="validation-msg" id="name-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label>Service Code *</strong> </label>
                                        <div class="input-group">
                                            <input type="text" name="code" class="form-control" id="code" value="<?php echo e($service_list->code); ?>" aria-describedby="code" required>
                                            <div class="input-group-append">
                                                <button id="genbutton" type="button" class="btn btn-sm btn-default" title="<?php echo e(trans('file.Generate')); ?>"><i class="fa fa-refresh"></i></button>
                                            </div>
                                        </div>
                                        <span class="validation-msg" id="code-error"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.category')); ?> *</strong> </label>
                                        <div class="input-group">
                                          <select name="category_id" class="selectpicker form-control sel" data-live-search="true" data-live-search-style="begins" title="Select Category..." required>
                                            <?php $__currentLoopData = $service_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>" <?php echo e(($category->id == $service_list->category_id) ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </select>
                                          <div class="input-group-append">
                                            <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#createModal" title=""><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                      </div>
                                      <span class="validation-msg"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Service Tax</strong> </label>
                                        <select name="tax_id" class="form-control selectpicker">
                                            <option value="">No Tax</option>
                                            <?php $__currentLoopData = $lims_tax_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($tax->id); ?>" <?php echo e(($tax->id == $service_list->tax_id) ? 'selected' : ''); ?>><?php echo e($tax->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.Tax Method')); ?></strong> </label> <i class="dripicons-question" data-toggle="tooltip" title="<?php echo e(trans('file.Exclusive: Poduct price = Actual service price + Tax. Inclusive: Actual service price = Product price - Tax')); ?>"></i>
                                        <select name="tax_method" class="form-control selectpicker" required>
                                            <option value="1" <?php echo($service_list->tax_method == 1) ? 'selected' : ''; ?>><?php echo e(trans('file.Exclusive')); ?></option>
                                            <option value="2" <?php echo($service_list->tax_method == 2) ? 'selected' : ''; ?>><?php echo e(trans('file.Inclusive')); ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Service Base Price *</strong> </label>
                                        <input type="number" name="price" value="<?php echo e($service_list->price); ?>" class="form-control" step="any" min="0" required>
                                        <span class="validation-msg"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Service Details</label>
                                        <textarea name="details" class="form-control" rows="3" required><?php echo $service_list->details; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="<?php echo e(trans('file.update')); ?>" id="submit-btn" class="btn btn-primary">
                            </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Create Modal -->
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <?php echo Form::open(['route' => 'categories.store', 'method' => 'post', 'files' => true]); ?>

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Category')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label><?php echo e(trans('file.name')); ?> *</label>
                        <?php echo e(Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Type category name...','required'))); ?>

                    </div>
                    <div class="col-md-12 form-group">
                        <label><?php echo e(trans('file.Parent Category')); ?></label>
                        <?php echo e(Form::select('parent_id',$categories, null, ['class' => 'form-control','placeholder' => 'No Parent Category'])); ?>

                    </div>
                </div>
                <input type="hidden" name="returntoservice" value="1">
                <div class="form-group">
                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>

<script type="text/javascript">
    $("ul#service").siblings('a').attr('aria-expanded','true');
    $("ul#service").addClass("show");
    $("ul#service #service-create-menu").addClass("active");

    $('#genbutton').on("click", function(){
      $.get('../generatecode', function(data){
        $("input[name='code']").val(data);
      });
    });
    tinymce.init({
      selector: 'textarea',
      height: 130,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code wordcount'
      ],
      toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
      branding:false
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wardan/bdtech.wardan.biz/resources/views/service/edit.blade.php ENDPATH**/ ?>