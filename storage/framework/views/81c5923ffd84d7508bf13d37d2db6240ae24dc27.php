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
                        <h4><?php echo e(trans('file.Add Transfer')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <?php echo Form::open(['route' => 'transfers.store', 'method' => 'post', 'files' => true, 'id' => 'transfer-form']); ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.From Warehouse')); ?> *</label>
                                            <div class="input-group">
                                                <select required name="from_warehouse_id" class="selectpicker sel form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                    <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if(isset($fromWarehouseSession)): ?> <?php if($fromWarehouseSession==$warehouse->id): ?> selected
                                                        <?php endif; ?>
                                                        <?php endif; ?> value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <div class="input-group-append">
                                                    <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#fromWarehouseModal" title=""><i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <span class="validation-msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.To Warehouse')); ?> *</label>
                                            <div class="input-group">
                                                <select required name="to_warehouse_id" class="selectpicker sel form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                    <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if(isset($toWarehouseSession)): ?> <?php if($toWarehouseSession==$warehouse->id): ?> selected
                                                        <?php endif; ?>
                                                        <?php endif; ?> value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <div class="input-group-append">
                                                    <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#toWarehouseModal" title=""><i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <span class="validation-msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans("file.Status")); ?></label>
                                            <select name="status" class="form-control selectpicker">
                                                <option value="1"><?php echo e(trans('file.Completed')); ?></option>
                                                <option value="2"><?php echo e(trans('file.Pending')); ?></option>
                                                <option value="3"><?php echo e(trans('file.Sent')); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row align-items-center">

                                    <div class="col-md-10">
                                        <label class="sr-only" for="inlineFormInputGroup">Select Product</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><button class="btn btn-secondary"><i class="fa fa-barcode"></i></button></div>
                                            </div>
                                            <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Please type product code and select..." class="form-control" />
                                        </div>
                                    </div>

                                    
                                        
                                        
                                    

                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12">

                                        <h5><?php echo e(trans('file.Order Table')); ?> *</h5>
                                        <div class="table-responsive mt-3">
                                            <table id="myTable" class="table table-hover order-list">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(trans('file.name')); ?></th>
                                                        <th><?php echo e(trans('file.Code')); ?></th>
                                                        <th><?php echo e(trans('file.Quantity')); ?></th>
                                                        <th><?php echo e(trans('file.Net Unit Cost')); ?></th>
                                                        <th><?php echo e(trans('file.Tax')); ?></th>
                                                        <th><?php echo e(trans('file.Subtotal')); ?></th>
                                                        <th><i class="dripicons-trash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot class="tfoot active">
                                                    <th colspan="2"><?php echo e(trans('file.Total')); ?></th>
                                                    <th id="total-qty">0</th>
                                                    <th></th>
                                                    <th id="total-tax">0.00</th>
                                                    <th id="total">0.00</th>
                                                    <th><i class="dripicons-trash"></i></th>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_qty" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_discount" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_cost" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="item" />
                                            <input type="hidden" name="order_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="grand_total" />
                                            <input type="hidden" name="paid_amount" value="0.00" />
                                            <input type="hidden" name="payment_status" value="1" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.Shipping Cost')); ?></label>
                                            <input type="number" name="shipping_cost" class="form-control" step="any" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.Attach Document')); ?></label>
                                            <i class="dripicons-question" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                                            <input type="file" name="document" class="form-control" />
                                            <?php if($errors->has('extension')): ?>
                                            <span>
                                                <strong><?php echo e($errors->first('extension')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.Note')); ?></label>
                                            <textarea rows="5" class="form-control" name="note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary" id="submit-button">
                                </div>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-condensed totals">
            <td><strong><?php echo e(trans('file.Items')); ?></strong>
                <span class="pull-right" id="item">0.00</span>
            </td>
            <td><strong><?php echo e(trans('file.Total')); ?></strong>
                <span class="pull-right" id="subtotal">0.00</span>
            </td>
            <td><strong><?php echo e(trans('file.Shipping Cost')); ?></strong>
                <span class="pull-right" id="shipping_cost">0.00</span>
            </td>
            <td><strong><?php echo e(trans('file.grand total')); ?></strong>
                <span class="pull-right" id="grand_total">0.00</span>
            </td>
        </table>
    </div>
    <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_header" class="modal-title"></h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label><?php echo e(trans('file.Quantity')); ?></label>
                            <input type="number" name="edit_qty" class="form-control" step="any">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(trans('file.Unit Cost')); ?></label>
                            <input type="number" name="edit_unit_cost" class="form-control" step="any">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(trans('file.Product Unit')); ?></label>
                            <select name="edit_unit" class="form-control selectpicker">
                            </select>
                        </div>
                        <button type="button" name="update_btn" class="btn btn-primary"><?php echo e(trans('file.update')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>

<div id="fromWarehouseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <?php echo Form::open(['route' => 'warehouse.store', 'method' => 'post']); ?>

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Warehouse')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <div class="form-group">
                    <label><?php echo e(trans('file.name')); ?> *</label>
                    <input type="text" placeholder="Type WareHouse Name..." name="name" required="required" class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Phone Number')); ?> *</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Email')); ?></label>
                    <input type="email" name="email" placeholder="example@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Address')); ?> *</label>
                    <textarea required class="form-control" rows="3" name="address"></textarea>
                </div>
                <input type="hidden" name="fromWarehouse" value="1">
                <div class="form-group">
                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>


<div id="toWarehouseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <?php echo Form::open(['route' => 'warehouse.store', 'method' => 'post']); ?>

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Warehouse')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <div class="form-group">
                    <label><?php echo e(trans('file.name')); ?> *</label>
                    <input type="text" placeholder="Type WareHouse Name..." name="name" required="required" class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Phone Number')); ?> *</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Email')); ?></label>
                    <input type="email" name="email" placeholder="example@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Address')); ?> *</label>
                    <textarea required class="form-control" rows="3" name="address"></textarea>
                </div>
                <input type="hidden" name="toWarehouse" value="1">
                <div class="form-group">
                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>



<!-- Create Modal -->
<div id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
        <form id="product-form">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('Add Product')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Product Type')); ?> *</strong> </label>
                            <div class="input-group">
                                <select name="type" required class="form-control selectpicker" id="type">
                                    <option value="standard">Standard</option>
                                    <option value="combo">Combo</option>
                                    <option value="digital">Digital</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Product Name')); ?> *</strong> </label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>
                            <span class="validation-msg" id="name-error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Product Code')); ?> *</strong> </label>
                            <div class="input-group">
                                <input type="text" name="code" class="form-control" id="code" aria-describedby="code" required>
                                <div class="input-group-append">
                                    <button id="genbuttonProduct" type="button" class="btn btn-sm btn-default" title="<?php echo e(trans('file.Generate')); ?>"><i class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                            <span class="validation-msg" id="code-error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Barcode Symbology')); ?> *</strong> </label>
                            <div class="input-group">
                                <select name="barcode_symbology" required class="form-control selectpicker">
                                    <option value="C128">Code 128</option>
                                    <option value="C39">Code 39</option>
                                    <option value="UPCA">UPC-A</option>
                                    <option value="UPCE">UPC-E</option>
                                    <option value="EAN8">EAN-8</option>
                                    <option value="EAN13">EAN-13</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="digital" class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Attach File')); ?> *</strong> </label>
                            <div class="input-group">
                                <input type="file" name="file" class="form-control">
                            </div>
                            <span class="validation-msg"></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Brand')); ?></strong> </label>
                            <div class="input-group">
                                <select name="brand_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Brand...">
                                    <?php $__currentLoopData = $lims_brand_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('file.category')); ?> *</strong> </label>
                            <div class="input-group">
                                <select name="category_id" required class="selectpicker form-control sel" data-live-search="true" data-live-search-style="begins" title="Select Category...">
                                    <?php $__currentLoopData = $lims_category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(isset($purchaseModalcategory)): ?> <?php if($purchaseModalcategory==$category->id): ?> selected
                                        <?php endif; ?>
                                        <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="input-group-append">
                                    <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#categoryModal" title=""><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <span class="validation-msg"></span>
                        </div>
                    </div>

                    <div id="unit" class="col-md-12">
                        <div class="row ">
                            <div class="col-md-4 form-group">
                                <label><?php echo e(trans('file.Product Unit')); ?> *</strong> </label>
                                <div class="input-group">
                                    <select required class="form-control selectpicker" name="unit_id">
                                        <option value="" disabled selected>Select Product Unit...</option>
                                        <?php $__currentLoopData = $lims_unit_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($unit->base_unit==null): ?>
                                        <option value="<?php echo e($unit->id); ?>"><?php echo e($unit->unit_name); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <span class="validation-msg"></span>
                            </div>
                            <div class="col-md-4">
                                <label><?php echo e(trans('file.Sale Unit')); ?></strong> </label>
                                <div class="input-group">
                                    <select class="form-control selectpicker" name="sale_unit_id">
                                        <option value="" disabled selected>Select Sale Unit...</option>
                                        <?php $__currentLoopData = $lims_unit_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($unit->base_unit==null): ?>
                                        <option value="<?php echo e($unit->id); ?>"><?php echo e($unit->unit_name); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Purchase Unit')); ?></strong> </label>
                                    <div class="input-group">
                                        <select class="form-control selectpicker" name="purchase_unit_id">
                                            <option value="" disabled selected>Select Purchase Unit...</option>
                                            <?php $__currentLoopData = $lims_unit_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($unit->base_unit==null): ?>
                                            <option value="<?php echo e($unit->id); ?>"><?php echo e($unit->unit_name); ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cost" class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Product Cost')); ?> *</strong> </label>
                            <input type="number" name="cost" required class="form-control" step="any">
                            <span class="validation-msg"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Product Price')); ?> *</strong> </label>
                            <input type="number" name="price" required class="form-control" step="any">
                            <span class="validation-msg"></span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="qty" value="0.00">
                        </div>
                    </div>
                    <div id="alert-qty" class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Alert Quantity')); ?></strong> </label>
                            <input type="number" name="alert_quantity" class="form-control" step="any">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('Product VAT')); ?></strong> </label>
                            <select name="tax_id" class="form-control selectpicker">
                                <option value="">No Tax</option>
                                <?php $__currentLoopData = $lims_tax_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tax->id); ?>"><?php echo e($tax->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('VAT Method')); ?></strong> </label> <i class="dripicons-question" data-toggle="tooltip" title="<?php echo e(trans('file.Exclusive: Poduct price = Actual product price + Tax. Inclusive: Actual product price = Product price - Tax')); ?>"></i>
                            <select name="tax_method" class="form-control selectpicker">
                                <option value="1"><?php echo e(trans('file.Exclusive')); ?></option>
                                <option value="2"><?php echo e(trans('file.Inclusive')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('Item Code')); ?> *</strong> </label>
                            <div class="input-group">
                                <input type="text" name="item_code" class="form-control" id="item_code" aria-describedby="item_code" required>
                                <div class="input-group-append">
                                    <button id="genbuttonItem" type="button" class="btn btn-sm btn-default" title="<?php echo e(trans('file.Generate')); ?>"><i class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                            <span class="validation-msg" id="code-error"></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(trans('Warranty')); ?> *</strong> </label>
                            <input type="text" name="warranty" class="form-control" id="warranty" aria-describedby="warranty" required>
                            <span class="validation-msg" id="name-error"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Product Image')); ?></strong> </label> <i class="dripicons-question" data-toggle="tooltip" title="<?php echo e(trans('file.You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image.')); ?>"></i>
                            <div id="imageUpload" class="dropzone"></div>
                            <span class="validation-msg" id="image-error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Product Details')); ?></label>
                            <textarea name="product_details" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2" id="diffPrice-option">
                        <h5><input name="is_diffPrice" type="checkbox" id="is-diffPrice" value="1">&nbsp; <?php echo e(trans('file.This product has different price for different warehouse')); ?></h5>
                    </div>
                    <div class="col-md-6" id="diffPrice-section">
                        <div class="table-responsive ml-2">
                            <table id="diffPrice-table" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo e(trans('file.Warehouse')); ?></th>
                                        <th><?php echo e(trans('file.Price')); ?></th>
                                    </tr>
                                    <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="warehouse_id[]" value="<?php echo e($warehouse->id); ?>">
                                            <?php echo e($warehouse->name); ?>

                                        </td>
                                        <td><input type="number" name="diff_price[]" class="form-control"></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3" id="variant-option">
                        <h5><input name="is_variant" type="checkbox" id="is-variant" value="1">&nbsp; <?php echo e(trans('file.This product has variant')); ?></h5>
                    </div>
                    <div class="col-md-12" id="variant-section">
                        <div class="col-md-6 form-group mt-2">
                            <input type="text" name="variant" class="form-control" placeholder="<?php echo e(trans('file.Enter variant seperated by comma')); ?>">
                        </div>
                        <div class="table-responsive ml-2">
                            <table id="variant-table" class="table table-hover variant-list">
                                <thead>
                                    <tr>
                                        <th><i class="dripicons-view-apps"></i></th>
                                        <th><?php echo e(trans('file.name')); ?></th>
                                        <th><?php echo e(trans('file.Item Code')); ?></th>
                                        <th><?php echo e(trans('file.Additional Price')); ?></th>
                                        <th><i class="dripicons-trash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <input name="promotion" type="checkbox" id="promotion" value="1">&nbsp;
                        <label>
                            <h5> <?php echo e(trans('file.Add Promotional Price')); ?></h5>
                        </label>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4" id="promotion_price">
                                <label><?php echo e(trans('file.Promotional Price')); ?></label>
                                <input type="number" name="promotion_price" class="form-control" step="any" />
                            </div>
                            <div class="col-md-4" id="start_date">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Promotion Starts')); ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="dripicons-calendar"></i></div>
                                        </div>
                                        <input type="text" name="starting_date" id="starting_date" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" id="last_date">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Promotion Ends')); ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="dripicons-calendar"></i></div>
                                        </div>
                                        <input type="text" name="last_date" id="ending_date" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="returntopurchase" value="1">
                <div class="form-group">
                    <input type="button" value="<?php echo e(trans('file.submit')); ?>" id="submit-btnn" class="btn btn-primary">
                </div>
            </div>
        </form>
        </div>
    </div>
</div>


<!-- Category Modal -->
<div id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <?php echo Form::open(['route' => 'category.store', 'method' => 'post', 'files' => true]); ?>

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Category')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.name')); ?> *</label>
                        <?php echo e(Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type category name...'))); ?>

                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Image')); ?></label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Parent Category')); ?></label>
                        <?php echo e(Form::select('parent_id', $lims_categories, null, ['class' => 'form-control','placeholder' => 'No Parent Category'])); ?>

                    </div>
                </div>

                <input type="hidden" name="returntopurchase" value="1">

                <div class="form-group">
                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>

<script type="text/javascript">
    $("ul#transfer").siblings('a').attr('aria-expanded', 'true');
    $("ul#transfer").addClass("show");
    $("ul#transfer #transfer-create-menu").addClass("active");
    // array data depend on warehouse
    var lims_product_array = [];
    var product_code = [];
    var product_name = [];
    var product_qty = [];

    // array data with selection
    var product_cost = [];
    var tax_rate = [];
    var tax_name = [];
    var tax_method = [];
    var unit_name = [];
    var unit_operator = [];
    var unit_operation_value = [];

    // temporary array
    var temp_unit_name = [];
    var temp_unit_operator = [];
    var temp_unit_operation_value = [];

    var rowindex;
    var row_product_cost;

    $('.selectpicker').selectpicker({
        style: 'btn-link',
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('select[name="from_warehouse_id"]').on('change', function() {
        var id = $(this).val();
        $.get('getproduct/' + id, function(data) {
            lims_product_array = [];
            product_code = data[0];
            product_name = data[1];
            product_qty = data[2];
            $.each(product_code, function(index) {
                lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
            });
        });
    });

    $('#lims_productcodeSearch').on('input', function() {
        var warehouse_id = $('select[name="from_warehouse_id"]').val();
        temp_data = $('#lims_productcodeSearch').val();

        if (!warehouse_id) {
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            alert('Please select Warehouse!');
        }
    });

    var lims_productcodeSearch = $('#lims_productcodeSearch');

    lims_productcodeSearch.autocomplete({
        source: function(request, response) {
            var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(lims_product_array, function(item) {
                return matcher.test(item);
            }));
        },
        response: function(event, ui) {
            if (ui.content.length == 1) {
                var data = ui.content[0].value;
                $(this).autocomplete("close");
                productSearch(data);
            };
        },
        select: function(event, ui) {
            var data = ui.item.value;
            productSearch(data);
        }
    });

    //Change quantity
    $("#myTable").on('input', '.qty', function() {
        rowindex = $(this).closest('tr').index();
        checkQuantity($(this).val(), true);
    });


    //Delete product
    $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
        rowindex = $(this).closest('tr').index();
        product_cost.splice(rowindex, 1);
        tax_rate.splice(rowindex, 1);
        tax_name.splice(rowindex, 1);
        tax_method.splice(rowindex, 1);
        unit_name.splice(rowindex, 1);
        unit_operator.splice(rowindex, 1);
        unit_operation_value.splice(rowindex, 1);
        $(this).closest("tr").remove();
        calculateTotal();
    });

    //Edit product
    $("table.order-list").on("click", ".edit-product", function() {
        rowindex = $(this).closest('tr').index();
        edit();
    });

    //Update product
    $('button[name="update_btn"]').on("click", function() {
        var edit_qty = $('input[name="edit_qty"]').val();
        var edit_unit_cost = $('input[name="edit_unit_cost"]').val();

        var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
        var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));

        if (row_unit_operator == '*') {
            product_cost[rowindex] = $('input[name="edit_unit_cost"]').val() / row_unit_operation_value;
        } else {
            product_cost[rowindex] = $('input[name="edit_unit_cost"]').val() * row_unit_operation_value;
        }

        var position = $('select[name="edit_unit"]').val();
        var temp_operator = temp_unit_operator[position];
        var temp_operation_value = temp_unit_operation_value[position];
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.purchase-unit').val(temp_unit_name[position]);
        temp_unit_name.splice(position, 1);
        temp_unit_operator.splice(position, 1);
        temp_unit_operation_value.splice(position, 1);

        temp_unit_name.unshift($('select[name="edit_unit"] option:selected').text());
        temp_unit_operator.unshift(temp_operator);
        temp_unit_operation_value.unshift(temp_operation_value);

        unit_name[rowindex] = temp_unit_name.toString() + ',';
        unit_operator[rowindex] = temp_unit_operator.toString() + ',';
        unit_operation_value[rowindex] = temp_unit_operation_value.toString() + ',';
        checkQuantity(edit_qty, false);
    });

    function productSearch(data) {
        $.ajax({
            type: 'GET',
            url: 'lims_product_search',
            data: {
                data: data
            },
            success: function(data) {
                var flag = 1;
                $(".product-code").each(function(i) {
                    if ($(this).val() == data[1]) {
                        rowindex = i;
                        var qty = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) + 1;
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
                        checkQuantity(String(qty), true);
                        flag = 0;
                    }
                });
                $("input[name='product_code_name']").val('');
                if (flag) {
                    var newRow = $("<tr>");
                    var cols = '';
                    temp_unit_name = (data[6]).split(',');
                    cols += '<td>' + data[0] + '<button type="button" class="edit-product btn btn-link" data-toggle="modal" data-target="#editModal"> <i class="dripicons-document-edit"></i></button></td>';
                    cols += '<td>' + data[1] + '</td>';
                    cols += '<td><input type="number" class="form-control qty" name="qty[]" value="1" step="any" required/></td>';
                    cols += '<td class="net_unit_cost"></td>';
                    cols += '<td class="tax"></td>';
                    cols += '<td class="sub-total"></td>';
                    cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger"><?php echo e(trans("file.delete")); ?></button></td>';
                    cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data[1] + '"/>';
                    cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[9] + '"/>';
                    cols += '<input type="hidden" class="purchase-unit" name="purchase_unit[]" value="' + temp_unit_name[0] + '"/>';
                    cols += '<input type="hidden" class="net_unit_cost" name="net_unit_cost[]" />';
                    cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data[3] + '"/>';
                    cols += '<input type="hidden" class="tax-value" name="tax[]" />';
                    cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';

                    newRow.append(cols);
                    $("table.order-list tbody").append(newRow);

                    product_cost.push(parseFloat(data[2]));
                    tax_rate.push(parseFloat(data[3]));
                    tax_name.push(data[4]);
                    tax_method.push(data[5]);
                    unit_name.push(data[6]);
                    unit_operator.push(data[7]);
                    unit_operation_value.push(data[8]);
                    rowindex = newRow.index();
                    checkQuantity(1, true);
                }
            }
        });
    }

    function edit() {
        var row_product_name = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(1)').text();
        var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
        $('#modal_header').text(row_product_name + '(' + row_product_code + ')');

        var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
        $('input[name="edit_qty"]').val(qty);

        unitConversion();
        $('input[name="edit_unit_cost"]').val(row_product_cost.toFixed(2));

        temp_unit_name = (unit_name[rowindex]).split(',');
        temp_unit_name.pop();
        temp_unit_operator = (unit_operator[rowindex]).split(',');
        temp_unit_operator.pop();
        temp_unit_operation_value = (unit_operation_value[rowindex]).split(',');
        temp_unit_operation_value.pop();
        $('select[name="edit_unit"]').empty();
        $.each(temp_unit_name, function(key, value) {
            $('select[name="edit_unit"]').append('<option value="' + key + '">' + value + '</option>');
        });
        $('.selectpicker').selectpicker('refresh');
    }

    function checkQuantity(purchase_qty, flag) {
        var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
        var pos = product_code.indexOf(row_product_code);
        var operator = unit_operator[rowindex].split(',');
        var operation_value = unit_operation_value[rowindex].split(',');
        if (operator[0] == '*')
            total_qty = purchase_qty * operation_value[0];
        else if (operator[0] == '/')
            total_qty = purchase_qty / operation_value[0];

        if (total_qty > parseFloat(product_qty[pos])) {
            alert('Quantity exceeds stock quantity!');
            if (flag) {
                purchase_qty = purchase_qty.substring(0, purchase_qty.length - 1);
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(purchase_qty);
            } else {
                edit();
                return;
            }
        } else {
            $('#editModal').modal('hide');
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(purchase_qty);
        }
        calculateRowProductData(purchase_qty);
    }

    function calculateRowProductData(quantity) {
        unitConversion();
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val(tax_rate[rowindex].toFixed(2));

        if (tax_method[rowindex] == 1) {
            var net_unit_cost = row_product_cost;
            var tax = net_unit_cost * quantity * (tax_rate[rowindex] / 100);
            var sub_total = (net_unit_cost * quantity) + tax;

            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(net_unit_cost.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_cost').val(net_unit_cost.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(5)').text(tax.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(6)').text(sub_total.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed(2));
        } else {

            var sub_total_unit = row_product_cost;
            var net_unit_cost = (100 / (100 + tax_rate[rowindex])) * sub_total_unit;
            var tax = (sub_total_unit - net_unit_cost) * quantity;
            var sub_total = sub_total_unit * quantity;

            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(net_unit_cost.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_cost').val(net_unit_cost.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(5)').text(tax.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(6)').text(sub_total.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed(2));
        }

        calculateTotal();
    }

    function unitConversion() {
        var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
        var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));

        if (row_unit_operator == '*') {
            row_product_cost = product_cost[rowindex] * row_unit_operation_value;
        } else {
            row_product_cost = product_cost[rowindex] / row_unit_operation_value;
        }
    }

    function calculateTotal() {
        //Sum of quantity
        var total_qty = 0;
        $(".qty").each(function() {

            if ($(this).val() == '') {
                total_qty += 0;
            } else {
                total_qty += parseFloat($(this).val());
            }
        });
        $("#total-qty").text(total_qty);
        $('input[name="total_qty"]').val(total_qty);

        //Sum of tax
        var total_tax = 0;
        $(".tax").each(function() {
            total_tax += parseFloat($(this).text());
        });
        $("#total-tax").text(total_tax.toFixed(2));
        $('input[name="total_tax"]').val(total_tax.toFixed(2));

        //Sum of subtotal
        var total = 0;
        $(".sub-total").each(function() {
            total += parseFloat($(this).text());
        });
        $("#total").text(total.toFixed(2));
        $('input[name="total_cost"]').val(total.toFixed(2));

        calculateGrandTotal();
    }

    function calculateGrandTotal() {

        var item = $('table.order-list tbody tr:last').index();

        var total_qty = parseFloat($('#total-qty').text());
        var subtotal = parseFloat($('#total').text());
        var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());

        if (!shipping_cost)
            shipping_cost = 0.00;

        item = ++item + '(' + total_qty + ')';

        var grand_total = (subtotal + shipping_cost);

        $('#item').text(item);
        $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
        $('#subtotal').text(subtotal.toFixed(2));
        $('#shipping_cost').text(shipping_cost.toFixed(2));
        $('#grand_total').text(grand_total.toFixed(2));
        $('input[name="grand_total"]').val(grand_total.toFixed(2));
    }

    $('input[name="shipping_cost"]').on("input", function() {
        calculateGrandTotal();
    });

    $(window).keydown(function(e) {
        if (e.which == 13) {
            var $targ = $(e.target);
            if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
                var focusNext = false;
                $(this).find(":input:visible:not([disabled],[readonly]), a").each(function() {
                    if (this === e.target) {
                        focusNext = true;
                    } else if (focusNext) {
                        $(this).focus();
                        return false;
                    }
                });
                return false;
            }
        }
    });

    $('#transfer-form').on('submit', function(e) {
        var rownumber = $('table.order-list tbody tr:last').index();
        if (rownumber < 0) {
            alert("Please insert product to order table!")
            e.preventDefault();
        }
        if ($('select[name="from_warehouse_id"]').val() == $('select[name="to_warehouse_id"]').val()) {
            alert('Both Warehouse can not be same!');
            e.preventDefault();
        }
    });



    //add product script
    $("ul#product").siblings('a').attr('aria-expanded','true');
    $("ul#product").addClass("show");
    $("ul#product #product-create-menu").addClass("active");

    $("#digital").hide();
    $("#combo").hide();
    $("#variant-section").hide();
    $("#diffPrice-section").hide();
    $("#promotion_price").hide();
    $("#start_date").hide();
    $("#last_date").hide();

    $('[data-toggle="tooltip"]').tooltip(); 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#genbuttonProduct').on("click", function(){
      $.get("<?php echo e(route('product.gencode')); ?>", function(data){
        $("input[name='code']").val(data);
      });
    });

    $('#genbuttonItem').on("click", function(){
      $.get("<?php echo e(route('product.gencode')); ?>", function(data){
        $("input[name='item_code']").val(data);
      });
    });

    

    // tinymce.init({ 
    //   selector: 'textarea',
    //   height: 130,
    //   plugins: [
    //     'advlist autolink lists link image charmap print preview anchor textcolor',
    //     'searchreplace visualblocks code fullscreen',
    //     'insertdatetime media table contextmenu paste code wordcount'
    //   ],
    //   toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
    //   branding:false
    // });

    $('select[name="type"]').on('change', function() {
        if($(this).val() == 'combo'){
            $("input[name='cost']").prop('required',false);
            $("select[name='unit_id']").prop('required',false);
            hide();
            $("#combo").show(300);
            $("input[name='price']").prop('disabled',true);
            $("#is-variant").prop("checked", false);
            $("#is-diffPrice").prop("checked", false);
            $("#variant-section, #variant-option, #diffPrice-option, #diffPrice-section").hide(300);
        }
        else if($(this).val() == 'digital'){
            $("input[name='cost']").prop('required',false);
            $("select[name='unit_id']").prop('required',false);
            $("input[name='file']").prop('required',true);
            hide();
            $("#digital").show(300);
            $("#combo").hide(300);
            $("input[name='price']").prop('disabled',false);
            $("#is-variant").prop("checked", false);
            $("#is-diffPrice").prop("checked", false);
            $("#variant-section, #variant-option, #diffPrice-option, #diffPrice-section").hide(300);
        }
        else if($(this).val() == 'standard'){
            $("input[name='cost']").prop('required',true);
            $("select[name='unit_id']").prop('required',true);
            $("input[name='file']").prop('required',false);
            $("#cost").show(300);
            $("#unit").show(300);
            $("#alert-qty").show(300);
            $("#variant-option").show(300);
            $("#diffPrice-option").show(300);
            $("#digital").hide(300);
            $("#combo").hide(300);
            $("input[name='price']").prop('disabled',false);
        }
    });

    $('select[name="unit_id"]').on('change', function() {
        
        unitID = $(this).val();
        if(unitID) {
            populate_category(unitID);
        }else{    
            $('select[name="sale_unit_id"]').empty();
            $('select[name="purchase_unit_id"]').empty();
        }                        
    });
    

    //Change quantity or unit price
    $("#myTable").on('input', '.qty , .unit_price', function() {
        calculate_price();
    });

    //Delete product
    $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
        $(this).closest("tr").remove();
        calculate_price();
    });

    function hide() {
        $("#cost").hide(300);
        $("#unit").hide(300);
        $("#alert-qty").hide(300);
    }

    function calculate_price() {
        var price = 0;
        $(".qty").each(function() {
            rowindex = $(this).closest('tr').index();
            quantity =  $(this).val();
            unit_price = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .unit_price').val();
            price += quantity * unit_price;
        });
        $('input[name="price"]').val(price);
    }

    function populate_category(unitID){
        $.ajax({
            url: 'saleunit/'+unitID,
            type: "GET",
            dataType: "json",
            success:function(data) {
                  $('select[name="sale_unit_id"]').empty();
                  $('select[name="purchase_unit_id"]').empty();
                  $.each(data, function(key, value) {
                      $('select[name="sale_unit_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                      $('select[name="purchase_unit_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
                  $('.selectpicker').selectpicker('refresh');
            },
        });
    }

    $("input[name='is_variant']").on("change", function () {
        if ($(this).is(':checked')) {
            $("#variant-section").show(300);
        }
        else
            $("#variant-section").hide(300);
    });

    $("input[name='is_diffPrice']").on("change", function () {
        if ($(this).is(':checked')) {
            $("#diffPrice-section").show(300);
        }
        else
            $("#diffPrice-section").hide(300);
    });

    $("input[name='variant']").on("input", function () {
        if($("#code").val() == ''){
            $("input[name='variant']").val('');
            alert('Please fillup above information first.');
        }
        else if($(this).val().indexOf(',') > -1) {
            var variant_name = $(this).val().slice(0, -1);
            var item_code = variant_name+'-'+$("#code").val();
            var newRow = $("<tr>");
            var cols = '';
            cols += '<td style="cursor:grab"><i class="dripicons-view-apps"></i></td>';
            cols += '<td><input type="text" class="form-control" name="variant_name[]" value="' + variant_name + '" /></td>';
            cols += '<td><input type="text" class="form-control" name="item_code[]" value="'+item_code+'" /></td>';
            cols += '<td><input type="number" class="form-control" name="additional_price[]" value="" step="any" /></td>';
            cols += '<td><button type="button" class="vbtnDel btn btn-sm btn-danger">X</button></td>';

            $("input[name='variant']").val('');
            newRow.append(cols);
            $("table.variant-list tbody").append(newRow);
        }
    });

    //Delete variant
    $("table#variant-table tbody").on("click", ".vbtnDel", function(event) {
        $(this).closest("tr").remove();
    });

    $( "#promotion" ).on( "change", function() {
        if ($(this).is(':checked')) {
            $("#starting_date").val($.datepicker.formatDate('dd-mm-yy', new Date()));
            $("#promotion_price").show(300);
            $("#start_date").show(300);
            $("#last_date").show(300);
        } 
        else {
            $("#promotion_price").hide(300);
            $("#start_date").hide(300);
            $("#last_date").hide(300);
        }
    });

    var starting_date = $('#starting_date');
    starting_date.datepicker({
     format: "dd-mm-yyyy",
     startDate: "<?php echo date('d-m-Y'); ?>",
     autoclose: true,
     todayHighlight: true
     });

    var ending_date = $('#ending_date');
    ending_date.datepicker({
     format: "dd-mm-yyyy",
     startDate: "<?php echo date('d-m-Y'); ?>",
     autoclose: true,
     todayHighlight: true
     });

    $(window).keydown(function(e){
        if (e.which == 13) {
            var $targ = $(e.target);

            if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
                var focusNext = false;
                $(this).find(":input:visible:not([disabled],[readonly]), a").each(function(){
                    if (this === e.target) {
                        focusNext = true;
                    }
                    else if (focusNext){
                        $(this).focus();
                        return false;
                    }
                });

                return false;
            }
        }
    });
    //dropzone portion
    Dropzone.autoDiscover = false;

    jQuery.validator.setDefaults({
        errorPlacement: function (error, element) {
            if(error.html() == 'Select Category...')
                error.html('This field is required.');
            $(element).closest('div.form-group').find('.validation-msg').html(error.html());
        },
        highlight: function (element) {
            $(element).closest('div.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('div.form-group').removeClass('has-error').addClass('has-success');
            $(element).closest('div.form-group').find('.validation-msg').html('');
        }
    });

    function validate() {
        var product_code = $("input[name='code']").val();
        var barcode_symbology = $('select[name="barcode_symbology"]').val();
        var exp = /^\d+$/;

        if(!(product_code.match(exp)) && (barcode_symbology == 'UPCA' || barcode_symbology == 'UPCE' || barcode_symbology == 'EAN8' || barcode_symbology == 'EAN13') ) {
            alert('Product code must be numeric.');
            return false;
        }
        else if(product_code.match(exp)) {
            if(barcode_symbology == 'UPCA' && product_code.length > 11){
                alert('Product code length must be less than 12');
                return false;
            }
            else if(barcode_symbology == 'EAN8' && product_code.length > 7){
                alert('Product code length must be less than 8');
                return false;
            }
            else if(barcode_symbology == 'EAN13' && product_code.length > 12){
                alert('Product code length must be less than 13');
                return false;
            }
        }

        if( $("#type").val() == 'combo' ) {
            var rownumber = $('table.order-list tbody tr:last').index();
            if (rownumber < 0) {
                alert("Please insert product to table!")
                return false;
            }
        }
        if($("#is-variant").is(":checked")) {
            rowindex = $("table#variant-table tbody tr:last").index();
            if (rowindex < 0) {
                alert('This product has variant. Please insert variant to table');
                return false;
            }
        }
        $("input[name='price']").prop('disabled',false);
        return true;
    }

    $("table#variant-table tbody").sortable({
        items: 'tr',
        cursor: 'grab',
        opacity: 0.5,
    });

    $(".dropzone").sortable({
        items:'.dz-preview',
        cursor: 'grab',
        opacity: 0.5,
        containment: '.dropzone',
        distance: 20,
        tolerance: 'pointer',
        stop: function () {
          var queue = myDropzone.getAcceptedFiles();
          newQueue = [];
          $('#imageUpload .dz-preview .dz-filename [data-dz-name]').each(function (count, el) {           
                var name = el.innerHTML;
                queue.forEach(function(file) {
                    if (file.name === name) {
                        newQueue.push(file);
                    }
                });
          });
          myDropzone.files = newQueue;
        }
    });

    myDropzone = new Dropzone('div#imageUpload', {
        addRemoveLinks: true,
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFilesize: 12,
        paramName: 'image',
        clickable: true,
        method: 'POST',
        url: '<?php echo e(route('products.store')); ?>',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        init: function () {
            var myDropzone = this;
            $('#submit-btnn').on("click", function (e) {
                e.preventDefault();
                if ( $("#product-form").valid() && validate() ) {
                    tinyMCE.triggerSave();
                    if(myDropzone.getAcceptedFiles().length) {
                        myDropzone.processQueue();
                    }
                    else {
                        $.ajax({
                            type:'POST',
                            url:"<?php echo e(route('products.store')); ?>",
                            data: $("#product-form").serialize(),
                            success:function(response){
                                location.href = '../transfers/create';
                            },
                            error:function(response) {
                              if(response.responseJSON.errors.name) {
                                  $("#name-error").text(response.responseJSON.errors.name);
                              }
                              else if(response.responseJSON.errors.code) {
                                  $("#code-error").text(response.responseJSON.errors.code);
                              }m
                            },
                        });
                    }
                }
            });

            this.on('sending', function (file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $("#product-form").serializeArray();
                $.each(data, function (key, el) {
                    formData.append(el.name, el.value);
                });
            });
        },
        error: function (file, response) {
            console.log(response);
            if(response.errors.name) {
              $("#name-error").text(response.errors.name);
              this.removeAllFiles(true);
            }
            else if(response.errors.code) {
              $("#code-error").text(response.errors.code);
              this.removeAllFiles(true);
            }
            else {
              try {
                  var res = JSON.parse(response);
                  if (typeof res.message !== 'undefined' && !$modal.hasClass('in')) {
                      $("#success-icon").attr("class", "fas fa-thumbs-down");
                      $("#success-text").html(res.message);
                      $modal.modal("show");
                  } else {
                      if ($.type(response) === "string")
                          var message = response; //dropzone sends it's own error messages in string
                      else
                          var message = response.message;
                      file.previewElement.classList.add("dz-error");
                      _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                      _results = [];
                      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                          node = _ref[_i];
                          _results.push(node.textContent = message);
                      }
                      return _results;
                  }
              } catch (error) {
                  console.log(error);
              }
            }
        },
        successmultiple: function (file, response) {
            location.href = '../products';
            //console.log(file, response);
        },
        completemultiple: function (file, response) {
            console.log(file, response, "completemultiple");
        },
        reset: function () {
            console.log("resetFiles");
            this.removeAllFiles(true);
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wardan/bdtech.wardan.biz/resources/views/transfer/create.blade.php ENDPATH**/ ?>