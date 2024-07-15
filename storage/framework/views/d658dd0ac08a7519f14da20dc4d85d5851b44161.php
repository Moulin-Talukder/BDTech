<?php $__env->startSection('content'); ?>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4><?php echo e(trans('file.add_product')); ?></h4>
                        </div>
                        <div class="card-body">
                            <p class="italic">
                                <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.
                                </small>
                            </p>
                            <form id="product-form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label></strong><?php echo e(trans('file.Product Type')); ?> *</strong> </label>
                                            <div class="input-group">
                                                <select name="type" required class="form-control selectpicker"
                                                        id="type">
                                                    <option value="standard">Standard</option>
                                                    <option value="combo">Combo</option>
                                                    <option value="digital">Digital</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label></strong><?php echo e(trans('file.Product Name')); ?> *</strong> </label>
                                            <input type="text" name="name"
                                                   <?php if(isset($oldProduct['name'])): ?> value="<?php echo e($oldProduct['name']); ?>" <?php endif; ?>
                                                   class="form-control" id="name" aria-describedby="name" required>
                                            <span class="validation-msg" id="name-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong><?php echo e(trans('file.Product Code')); ?> *</strong> </label>
                                            <div class="input-group">
                                                <input type="text" name="code" class="form-control" id="code"
                                                       aria-describedby="code"
                                                       <?php if(isset($oldProduct['code'])): ?> value="<?php echo e($oldProduct['code']); ?>"
                                                       <?php endif; ?> required>
                                                <div class="input-group-append">
                                                    <button id="genbuttonProduct" type="button"
                                                            class="btn btn-sm btn-default"
                                                            title="<?php echo e(trans('file.Generate')); ?>"><i
                                                            class="fa fa-refresh"></i></button>
                                                </div>
                                            </div>
                                            <span class="validation-msg" id="code-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label></strong><?php echo e(trans('file.Barcode Symbology')); ?> *</strong> </label>
                                            <div class="input-group">
                                                <select name="barcode_symbology" required
                                                        class="form-control selectpicker">
                                                    <option
                                                        <?php if(isset($oldProduct['barcode_symbology'])): ?> <?php if($oldProduct['barcode_symbology'] == "C128"): ?> selected
                                                        <?php endif; ?>  <?php endif; ?> value="C128">Code 128
                                                    </option>
                                                    <option
                                                        <?php if(isset($oldProduct['barcode_symbology'])): ?> <?php if($oldProduct['barcode_symbology'] == "C39"): ?> selected
                                                        <?php endif; ?> <?php endif; ?> value="C39">Code 39
                                                    </option>
                                                    <option
                                                        <?php if(isset($oldProduct['barcode_symbology'])): ?> <?php if($oldProduct['barcode_symbology'] == "UPCA"): ?> selected
                                                        <?php endif; ?> <?php endif; ?> value="UPCA">UPC-A
                                                    </option>
                                                    <option
                                                        <?php if(isset($oldProduct['barcode_symbology'])): ?> <?php if($oldProduct['barcode_symbology'] == "UPCE"): ?> selected
                                                        <?php endif; ?> <?php endif; ?> value="UPCE">UPC-E
                                                    </option>
                                                    <option
                                                        <?php if(isset($oldProduct['barcode_symbology'])): ?> <?php if($oldProduct['barcode_symbology'] == "UPCE"): ?> selected
                                                        <?php endif; ?> <?php endif; ?> value="UPCE">EAN-8
                                                    </option>
                                                    <option
                                                        <?php if(isset($oldProduct['barcode_symbology'])): ?> <?php if($oldProduct['barcode_symbology'] == "EAN13"): ?> selected
                                                        <?php endif; ?> <?php endif; ?> value="EAN13">EAN-13
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="digital" class="col-md-4">
                                        <div class="form-group">
                                            <label></strong><?php echo e(trans('file.Attach File')); ?> *</strong> </label>
                                            <div class="input-group">
                                                <input type="file" name="file" class="form-control">
                                            </div>
                                            <span class="validation-msg"></span>
                                        </div>
                                    </div>
                                    <div id="combo" class="col-md-9 mb-1">
                                        <label><?php echo e(trans('file.add_product')); ?></label>
                                        <div class="search-box input-group mb-3">
                                            <button class="btn btn-secondary"><i class="fa fa-barcode"></i></button>
                                            <input type="text" name="product_code_name" id="lims_productcodeSearch"
                                                   placeholder="Please type product code and select..."
                                                   class="form-control"/>
                                        </div>
                                        <label><?php echo e(trans('file.Combo Products')); ?></label>
                                        <div class="table-responsive">
                                            <table id="myTable" class="table table-hover order-list">
                                                <thead>
                                                <tr>
                                                    <th><?php echo e(trans('file.product')); ?></th>
                                                    <th><?php echo e(trans('file.Quantity')); ?></th>
                                                    <th><?php echo e(trans('file.Unit Price')); ?></th>
                                                    <th><i class="dripicons-trash"></i></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.Brand')); ?></strong> </label>
                                            <div class="input-group">
                                                <select id="brand_id" name="brand_id" class="sel form-control">
                                                    <option value="">Select brand</option>
                                                    <?php $__currentLoopData = $lims_brand_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <div class="input-group-append">
                                                    <button id="" type="button" class="btn btn-sm" data-toggle="modal"
                                                            data-target="#brandModal" title=""><i
                                                            class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <span class="validation-msg"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.category')); ?> *</strong> </label>
                                            <div class="input-group">
                                                <select id="category_id" name="category_id" required
                                                        class=" form-control sel" data-live-search="true"
                                                        data-live-search-style="begins" >
                                                    <option value="">Select category</option>
                                                    <?php $__currentLoopData = $lims_category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <div class="input-group-append">
                                                    <button id="" type="button" class="btn btn-sm" data-toggle="modal"
                                                            data-target="#createModal" title=""><i
                                                            class="fa fa-plus"></i>
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
                                                        <option value="" disabled selected>Select Product Unit...
                                                        </option>
                                                        <?php $__currentLoopData = $lims_unit_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($unit->base_unit==null): ?>

                                                                <option
                                                                    <?php if(isset($oldProduct['unit_id'])): ?>
                                                                    <?php if($oldProduct['unit_id'] == $unit->id): ?> selected
                                                                    <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    value="<?php echo e($unit->id); ?>"><?php echo e($unit->unit_name); ?></option>
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
                                                                <option
                                                                    <?php if(isset($oldProduct['sale_unit_id'])): ?>
                                                                    <?php if($oldProduct['sale_unit_id'] == $unit->id): ?> selected
                                                                    <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    value="<?php echo e($unit->id); ?>"><?php echo e($unit->unit_name); ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><?php echo e(trans('file.Purchase Unit')); ?></strong> </label>
                                                    <div class="input-group">
                                                        <select class="form-control selectpicker"
                                                                name="purchase_unit_id">
                                                            <option value="" disabled selected>Select Purchase Unit...
                                                            </option>
                                                            <?php $__currentLoopData = $lims_unit_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($unit->base_unit==null): ?>
                                                                    <option
                                                                        <?php if(isset($oldProduct['purchase_unit_id'])): ?>
                                                                        <?php if($oldProduct['purchase_unit_id'] == $unit->id): ?> selected
                                                                        <?php endif; ?>
                                                                        <?php endif; ?>
                                                                        value="<?php echo e($unit->id); ?>"><?php echo e($unit->unit_name); ?></option>
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
                                            <input type="number"
                                                   <?php if(isset($oldProduct['cost'])): ?> value="<?php echo e($oldProduct['cost']); ?>" <?php endif; ?>
                                                   name="cost" required class="form-control" step="any">
                                            <span class="validation-msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.Product Price')); ?> *</strong> </label>
                                            <input type="number" name="price"
                                                   <?php if(isset($oldProduct['price'])): ?> value="<?php echo e($oldProduct['price']); ?>"
                                                   <?php endif; ?>
                                                   required class="form-control" step="any">
                                            <span class="validation-msg"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="qty" value="0.00">
                                        </div>
                                    </div>
                                    <div id="alert-qty" class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.Alert Quantity')); ?></strong> </label>
                                            <input
                                                <?php if(isset($oldProduct['alert_quantity'])): ?> value="<?php echo e($oldProduct['alert_quantity']); ?>"
                                                <?php endif; ?>
                                                type="number" name="alert_quantity" class="form-control" step="any">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('Product VAT')); ?></strong> </label>
                                            <select name="tax_id" class="form-control selectpicker">
                                                <option value="">No Tax</option>
                                                <?php $__currentLoopData = $lims_tax_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                        <?php if(isset($oldProduct['tax_id'])): ?>
                                                        <?php if($oldProduct['tax_id'] == $tax->id): ?> selected <?php endif; ?>
                                                        <?php endif; ?>
                                                        value="<?php echo e($tax->id); ?>"><?php echo e($tax->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('VAT Method')); ?></strong> </label> <i
                                                class="dripicons-question" data-toggle="tooltip"
                                                title="<?php echo e(trans('file.Exclusive: Poduct price = Actual product price + Tax. Inclusive: Actual product price = Product price - Tax')); ?>"></i>
                                            <select name="tax_method" class="form-control selectpicker">
                                                <option
                                                    <?php if(isset($oldProduct['tax_method'])): ?>
                                                    <?php if($oldProduct['tax_method'] == 1): ?> selected <?php endif; ?>
                                                    <?php endif; ?>
                                                    value="1"><?php echo e(trans('file.Exclusive')); ?></option>
                                                <option
                                                    <?php if(isset($oldProduct['tax_method'])): ?>
                                                    <?php if($oldProduct['tax_method'] == 2): ?> selected <?php endif; ?>
                                                    <?php endif; ?>
                                                    value="2"><?php echo e(trans('file.Inclusive')); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('Item Code')); ?> *</strong> </label>
                                            <div class="input-group">
                                                <input
                                                    <?php if(isset($oldProduct['product_item_code'])): ?>
                                                    value="<?php echo e($oldProduct['product_item_code']); ?>"
                                                    <?php endif; ?>
                                                    type="text" name="product_item_code" class="form-control" id="item_code"
                                                    aria-describedby="product_item_code" required>
                                                <div class="input-group-append">
                                                    <button id="genbuttonItem" type="button"
                                                            class="btn btn-sm btn-default"
                                                            title="<?php echo e(trans('file.Generate')); ?>"><i
                                                            class="fa fa-refresh"></i></button>
                                                </div>
                                            </div>
                                            <span class="validation-msg" id="code-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(trans('Warranty')); ?> *</strong> </label>
                                            <input <?php if(isset($oldProduct['warranty'])): ?> value="<?php echo e($oldProduct['warranty']); ?>"
                                                   <?php endif; ?>
                                                   type="text" name="warranty" class="form-control" id="warranty"
                                                   aria-describedby="warranty" required>
                                            <span class="validation-msg" id="name-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.Product Image')); ?></strong> </label> <i
                                                class="dripicons-question" data-toggle="tooltip"
                                                title="<?php echo e(trans('file.You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image.')); ?>"></i>
                                            <div id="imageUpload" class="dropzone"></div>
                                            <span class="validation-msg" id="image-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.Product Details')); ?></label>
                                            <textarea

                                                name="product_details" class="form-control" rows="3">
                                                <?php if(isset($oldProduct['product_details'])): ?> value="<?php echo e($oldProduct['product_details']); ?>"
                                                <?php endif; ?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2" id="diffPrice-option">
                                        <h5><input
                                                <?php if(isset($oldProduct['is_diffPrice'])): ?> <?php if($oldProduct['is_diffPrice'] == 1): ?> checked="checked"
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                name="is_diffPrice" type="checkbox" id="is-diffPrice"
                                                value="1">&nbsp; <?php echo e(trans('file.This product has different price for different warehouse')); ?>

                                        </h5>
                                    </div>
                                    <div class="col-md-6" id="diffPrice-section">
                                        <div class="table-responsive ml-2">
                                            <table id="diffPrice-table" class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th><?php echo e(trans('file.Warehouse')); ?></th>
                                                    <th><?php echo e(trans('file.Price')); ?></th>
                                                </tr>
                                                <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="warehouse_id[]"
                                                                   value="<?php echo e($warehouse->id); ?>">
                                                            <?php echo e($warehouse->name); ?>

                                                        </td>
                                                        <td><input
                                                                <?php if(isset($oldProduct['diff_price'][$key])): ?> value="<?php echo e($oldProduct['diff_price'][$key]); ?>"
                                                                <?php endif; ?>
                                                                type="number" name="diff_price[]"
                                                                class="form-control"></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3" id="variant-option">
                                        <h5><input
                                                <?php if(isset($oldProduct['is_variant'])): ?>
                                                    <?php if($oldProduct['is_variant'] == 1): ?>
                                                        checked="checked"
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                name="is_variant" type="checkbox" id="is-variant"
                                                value="1">&nbsp; <?php echo e(trans('file.This product has variant')); ?></h5>
                                    </div>
                                    <div class="col-md-12" id="variant-section">
                                        <div class="col-md-6 form-group mt-2">
                                            <input type="text" name="variant" class="form-control"
                                                   placeholder="<?php echo e(trans('file.Enter variant seperated by comma')); ?>">
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
                                        <input
                                            <?php if(isset($oldProduct['promotion'])): ?>
                                            <?php if($oldProduct['promotion'] == 1): ?>
                                            checked="checked"
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            name="promotion" type="checkbox" id="promotion" value="1">&nbsp;
                                        <label><h5> <?php echo e(trans('file.Add Promotional Price')); ?></h5></label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4" id="promotion_price">
                                                <label><?php echo e(trans('file.Promotional Price')); ?></label>
                                                <input
                                                    <?php if(isset($oldProduct['promotion_price'])): ?> value="<?php echo e($oldProduct['promotion_price']); ?>"
                                                    <?php endif; ?>
                                                    type="number" name="promotion_price" class="form-control"
                                                       step="any"/>
                                            </div>
                                            <div class="col-md-4" id="start_date">
                                                <div class="form-group">
                                                    <label><?php echo e(trans('file.Promotion Starts')); ?></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i
                                                                    class="dripicons-calendar"></i></div>
                                                        </div>
                                                        <input
                                                            <?php if(isset($oldProduct['starting_date'])): ?> value="<?php echo e($oldProduct['starting_date']); ?>"
                                                            <?php endif; ?>
                                                            type="text" name="starting_date" id="starting_date"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="last_date">
                                                <div class="form-group">
                                                    <label><?php echo e(trans('file.Promotion Ends')); ?></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i
                                                                    class="dripicons-calendar"></i></div>
                                                        </div>
                                                        <input
                                                            <?php if(isset($oldProduct['last_date'])): ?> value="<?php echo e($oldProduct['last_date']); ?>"
                                                            <?php endif; ?>
                                                            type="text" name="last_date" id="ending_date"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="button" value="<?php echo e(trans('file.submit')); ?>" id="submit-btn"
                                           class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Create Modal -->
    <div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                
                <form action="" id="cat-form">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Category')); ?></h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                    <input type="hidden" name="catAdd" value="1"/>
                <div class="modal-body">
                    <p class="italic">
                        <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
                    </p>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.name')); ?> *</label>
                            <?php echo e(Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type category name...'))); ?>

                        </div>
                        <input type="hidden" value="" id="product_old_value_cat" name="product_old_value">
                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.Image')); ?></label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.Parent Category')); ?></label>
                            <?php echo e(Form::select('parent_id', $lims_categories, null, ['class' => 'form-control','placeholder' => 'No Parent Category'])); ?>

                        </div>
                    </div>

                    <input type="hidden" name="returntoproduct" value="1">

                    <div class="form-group">
                        <input id="addCategoryBtn" type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                    </div>
                </div>
                </form>
                
            </div>
        </div>
    </div>

    <!-- brand model -->
    <div id="brandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <form id="addBrand" action="<?php echo e(route('brand.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" value="" id="product_old_value" name="product_old_value">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Brand')); ?></h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <input type="hidden" name="brandAdd" value="1">
                    <div class="modal-body">
                        <p class="italic">
                            <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
                        </p>
                        <div class="form-group">
                            <label><?php echo e(trans('file.Title')); ?> *</label>
                            <?php echo e(Form::text('title',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type brand title...'))); ?>

                        </div>
                        <div class="form-group">
                            <label><?php echo e(trans('file.Image')); ?></label>
                            <?php echo e(Form::file('image', array('class' => 'form-control'))); ?>

                        </div>

                        <input type="hidden" name="returntoproduct" value="1">

                        <div class="form-group">
                            <input type="submit" id="addBrandBtn" value="<?php echo e(trans('file.submit')); ?>"
                                   class="btn btn-primary">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $("ul#product").siblings('a').attr('aria-expanded', 'true');
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

        $('#genbuttonProduct').on("click", function () {
            $.get('gencode', function (data) {
                $("input[name='code']").val(data);
            });
        });

        $('#genbuttonItem').on("click", function () {
            $.get('gencode', function (data) {
                $("input[name='product_item_code']").val(data);
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
            branding: false
        });

        $('select[name="type"]').on('change', function () {
            if ($(this).val() == 'combo') {
                $("input[name='cost']").prop('required', false);
                $("select[name='unit_id']").prop('required', false);
                hide();
                $("#combo").show(300);
                $("input[name='price']").prop('disabled', true);
                $("#is-variant").prop("checked", false);
                $("#is-diffPrice").prop("checked", false);
                $("#variant-section, #variant-option, #diffPrice-option, #diffPrice-section").hide(300);
            }
            else if ($(this).val() == 'digital') {
                $("input[name='cost']").prop('required', false);
                $("select[name='unit_id']").prop('required', false);
                $("input[name='file']").prop('required', true);
                hide();
                $("#digital").show(300);
                $("#combo").hide(300);
                $("input[name='price']").prop('disabled', false);
                $("#is-variant").prop("checked", false);
                $("#is-diffPrice").prop("checked", false);
                $("#variant-section, #variant-option, #diffPrice-option, #diffPrice-section").hide(300);
            }
            else if ($(this).val() == 'standard') {
                $("input[name='cost']").prop('required', true);
                $("select[name='unit_id']").prop('required', true);
                $("input[name='file']").prop('required', false);
                $("#cost").show(300);
                $("#unit").show(300);
                $("#alert-qty").show(300);
                $("#variant-option").show(300);
                $("#diffPrice-option").show(300);
                $("#digital").hide(300);
                $("#combo").hide(300);
                $("input[name='price']").prop('disabled', false);
            }
        });

        $('select[name="unit_id"]').on('change', function () {

            unitID = $(this).val();
            if (unitID) {
                populate_category(unitID);
            } else {
                $('select[name="sale_unit_id"]').empty();
                $('select[name="purchase_unit_id"]').empty();
            }
        });
            <?php $productArray = []; ?>
        var lims_product_code = [ <?php $__currentLoopData = $lims_product_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $productArray[] = htmlspecialchars($product->code . ' [ ' . $product->name . ' ]');
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php
                echo '"' . implode('","', $productArray) . '"';
                ?> ];

        var lims_productcodeSearch = $('#lims_productcodeSearch');

        lims_productcodeSearch.autocomplete({
            source: function (request, response) {
                var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
                response($.grep(lims_product_code, function (item) {
                    return matcher.test(item);
                }));
            },
            select: function (event, ui) {
                var data = ui.item.value;
                
                $.ajax({
                    type: 'GET',
                    url: 'search',
                    data: {
                        data: data
                    },
                    success: function (data) {
                        var flag = 1;
                        $(".product-id").each(function () {
                            if ($(this).val() == data[4]) {
                                alert('Duplicate input is not allowed!')
                                flag = 0;
                            }
                        });
                        $("input[name='product_code_name']").val('');
                        if (flag) {
                            var newRow = $("<tr>");
                            var cols = '';
                            cols += '<td>' + data[0] + ' [' + data[1] + ']</td>';
                            cols += '<td><input type="number" class="form-control qty" name="product_qty[]" value="1" step="any"/></td>';
                            cols += '<td><input type="number" class="form-control unit_price" name="unit_price[]" value="' + data[3] + '" step="any"/></td>';
                            cols += '<td><button type="button" class="ibtnDel btn btn-sm btn-danger">X</button></td>';
                            cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[4] + '"/>';

                            newRow.append(cols);
                            $("table.order-list tbody").append(newRow);
                            calculate_price();
                        }
                    }
                });
            }
        });

        //Change quantity or unit price
        $("#myTable").on('input', '.qty , .unit_price', function () {
            calculate_price();
        });

        //Delete product
        $("table.order-list tbody").on("click", ".ibtnDel", function (event) {
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
            $(".qty").each(function () {
                rowindex = $(this).closest('tr').index();
                quantity = $(this).val();
                unit_price = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .unit_price').val();
                price += quantity * unit_price;
            });
            $('input[name="price"]').val(price);
        }

        function populate_category(unitID) {
            $.ajax({
                url: 'saleunit/' + unitID,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="sale_unit_id"]').empty();
                    $('select[name="purchase_unit_id"]').empty();
                    $.each(data, function (key, value) {
                        $('select[name="sale_unit_id"]').append('<option value="' + key + '">' + value + '</option>');
                        $('select[name="purchase_unit_id"]').append('<option value="' + key + '">' + value + '</option>');
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
            if ($("#code").val() == '') {
                $("input[name='variant']").val('');
                alert('Please fillup above information first.');
            }
            else if ($(this).val().indexOf(',') > -1) {
                var variant_name = $(this).val().slice(0, -1);
                var item_code = variant_name + '-' + $("#code").val();
                var newRow = $("<tr>");
                var cols = '';
                cols += '<td style="cursor:grab"><i class="dripicons-view-apps"></i></td>';
                cols += '<td><input type="text" class="form-control" name="variant_name[]" value="' + variant_name + '" /></td>';
                cols += '<td><input type="text" class="form-control" name="item_code[]" value="' + item_code + '" /></td>';
                cols += '<td><input type="number" class="form-control" name="additional_price[]" value="" step="any" /></td>';
                cols += '<td><button type="button" class="vbtnDel btn btn-sm btn-danger">X</button></td>';

                $("input[name='variant']").val('');
                newRow.append(cols);
                $("table.variant-list tbody").append(newRow);
            }
        });

        //Delete variant
        $("table#variant-table tbody").on("click", ".vbtnDel", function (event) {
            $(this).closest("tr").remove();
        });

        $("#promotion").on("change", function () {
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

        $(window).keydown(function (e) {
            if (e.which == 13) {
                var $targ = $(e.target);

                if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
                    var focusNext = false;
                    $(this).find(":input:visible:not([disabled],[readonly]), a").each(function () {
                        if (this === e.target) {
                            focusNext = true;
                        }
                        else if (focusNext) {
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
                if (error.html() == 'Select Category...')
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

            if (!(product_code.match(exp)) && (barcode_symbology == 'UPCA' || barcode_symbology == 'UPCE' || barcode_symbology == 'EAN8' || barcode_symbology == 'EAN13')) {
                alert('Product code must be numeric.');
                return false;
            }
            else if (product_code.match(exp)) {
                if (barcode_symbology == 'UPCA' && product_code.length > 11) {
                    alert('Product code length must be less than 12');
                    return false;
                }
                else if (barcode_symbology == 'EAN8' && product_code.length > 7) {
                    alert('Product code length must be less than 8');
                    return false;
                }
                else if (barcode_symbology == 'EAN13' && product_code.length > 12) {
                    alert('Product code length must be less than 13');
                    return false;
                }
            }

            if ($("#type").val() == 'combo') {
                var rownumber = $('table.order-list tbody tr:last').index();
                if (rownumber < 0) {
                    alert("Please insert product to table!")
                    return false;
                }
            }
            if ($("#is-variant").is(":checked")) {
                rowindex = $("table#variant-table tbody tr:last").index();
                if (rowindex < 0) {
                    alert('This product has variant. Please insert variant to table');
                    return false;
                }
            }
            $("input[name='price']").prop('disabled', false);
            return true;
        }

        $("table#variant-table tbody").sortable({
            items: 'tr',
            cursor: 'grab',
            opacity: 0.5,
        });

        $(".dropzone").sortable({
            items: '.dz-preview',
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
                    queue.forEach(function (file) {
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
            renameFile: function (file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            init: function () {
                var myDropzone = this;
                $('#submit-btn').on("click", function (e) {
                    e.preventDefault();
                    if ($("#product-form").valid() && validate()) {
                        tinyMCE.triggerSave();
                        if (myDropzone.getAcceptedFiles().length) {
                            myDropzone.processQueue();
                        }
                        else {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo e(route('products.store')); ?>',
                                data: $("#product-form").serialize(),
                                success: function (response) {
                                    //console.log(response);
                                    location.href = '../products';
                                },
                                error: function (response) {
                                    if (response.responseJSON.errors.name) {
                                        $("#name-error").text(response.responseJSON.errors.name);
                                    }
                                    else if (response.responseJSON.errors.code) {
                                        $("#code-error").text(response.responseJSON.errors.code);
                                    }
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
                if (response.errors.name) {
                    $("#name-error").text(response.errors.name);
                    this.removeAllFiles(true);
                }
                else if (response.errors.code) {
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

    <script>
        if ($('#is-diffPrice').is(':checked')) {

            $("#diffPrice-section").show()
        }
        if ($('#promotion').is(':checked')) {

            $("#promotion_price").show();
            $("#starting_date").show();
            $("#ending_date").show();
        }
        $('#addBrandBtn').on('click', function (e) {
            $('#product_old_value').val($("#product-form").serialize());
        })
        $('#addCategoryBtn').on('click', function (e) {
            $('#product_old_value_cat').val($("#product-form").serialize());
        })

    </script>

    <script>


        $('#addBrandBtn').on("click", function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "<?php echo e(route('brand.store')); ?>",
                data: $("#addBrand").serialize(),
                success: function (response) {
                    //console.log(response);
                    //location.href = '../purchases/create';
                    $('#brand_id').append($('<option>', {
                        value: response.id,
                        text: response.name
                    }));
                    $("#brand_id").val(response.id).change();
                    $('.close').click();
                    $('#addBrand').trigger("reset");
                },
                // error:function(response) {
                //     if(response.responseJSON.errors.name) {
                //         $("#name-error").text(response.responseJSON.errors.name);
                //     }
                //     else if(response.responseJSON.errors.code) {
                //         $("#code-error").text(response.responseJSON.errors.code);
                //     }
                // },
            });
        });
        $('#addCategoryBtn').on("click", function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "<?php echo e(route('category.store')); ?>",
                data: $("#cat-form").serialize(),
                success: function (response) {
                    console.log(response);
                    //location.href = '../purchases/create';
                    $('#category_id').append($('<option>', {
                        value: response.id,
                        text: response.name
                    }));
                    $("#category_id").val(response.id).change();
                    $('.close').click();
                    $('#cat-form').trigger("reset");
                },

            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bdtech_new\resources\views/product/create.blade.php ENDPATH**/ ?>