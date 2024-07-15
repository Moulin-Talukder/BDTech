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
                            <h4><?php echo e(trans('file.Update Sale')); ?></h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                            <?php echo Form::open(['route' => ['service.quotation.update', $lims_sale_data->id], 'method' => 'put', 'files' => true, 'id' => 'payment-form']); ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo e(trans('file.customer')); ?> *</label>
                                                <div class="input-group">
                                                    <input type="hidden" name="customer_id_hidden" value="<?php echo e($lims_sale_data->customer_id); ?>" />
                                                    <select required name="customer_id" class="form-control sel" data-live-search="true" id="customer-id" data-live-search-style="begins" >
                                                        <option value="">Select customer</option>
                                                        <?php $__currentLoopData = $lims_customer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                <?php if($lims_sale_data->customer_id == $customer->id): ?>
                                                                    selected
                                                                <?php endif; ?>
                                                                value="<?php echo e($customer->id); ?>"><?php echo e($customer->company_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#createModal" title=""><i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo e(trans('file.Warehouse')); ?> *</label>
                                                <input type="hidden" name="warehouse_id_hidden" value="<?php echo e($lims_sale_data->warehouse_id); ?>" />
                                                <select required name="warehouse_id" class=" form-control" data-live-search="true" data-live-search-style="begins" >
                                                    <option value="">Select warehouse</option>
                                                    <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if($lims_sale_data->warehouse_id == $warehouse->id): ?>
                                                            selected
                                                            <?php endif; ?>
                                                            value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    <strong><?php echo e(trans('Carried By')); ?></strong>
                                                </label>
                                                <input type="text" name="carried_by" value="<?php echo e($lims_sale_data->carried_by); ?>" class="form-control" step="any" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row align-items-center">

                                        <div class="col-md-10">
                                            <label class="sr-only" for="inlineFormInputGroup">Select Service</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><button class="btn btn-secondary"><i class="fa fa-barcode"></i></button></div>
                                                </div>
                                                <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Please type service code and select..." class="form-control" />
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
                                                        <th>
                                                            <em class="dripicons-trash"></em>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                   <?php if(count($cart)): ?>
                                                       <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                           <tr>
                                                               <td class=""><?php echo e($service->name); ?> </td>
                                                               <input type="hidden" name="service_id[]" value="<?php echo e($service->id); ?>">
                                                               <td class=""><?php echo e($service->code); ?> </td>
                                                               <td>
                                                                   <button type="button" onclick="servicePriceCalcMinus(<?php echo e($service->price); ?>)" class="ibtnDel btn btn-md btn-danger">
                                                                       <?php echo e(trans("file.delete")); ?>

                                                                   </button>
                                                               </td>
                                                           </tr>
                                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                       <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="hidden" name="total_qty" value="<?php echo e($lims_sale_data->total_qty); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="hidden" name="total_discount" value="<?php echo e($lims_sale_data->total_discount); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="hidden" name="total_tax" value="<?php echo e($lims_sale_data->total_tax); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="hidden" id="total_price" name="total_price" value="<?php echo e($lims_sale_data->total_price); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="hidden" name="item" value="<?php echo e($lims_sale_data->item); ?>" />
                                                <input type="hidden" name="order_tax" value="<?php echo e($lims_sale_data->order_tax); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" name="order_tax_rate_hidden" value="<?php echo e($lims_sale_data->order_tax_rate); ?>">
                                                <label><?php echo e(trans('file.Order Tax')); ?></label>
                                                <select class="form-control" name="order_tax_rate" id="order_tax_rate">
                                                    <option value="0">No Tax</option>
                                                    <?php $__currentLoopData = $lims_tax_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if($lims_sale_data->order_tax_rate ==$tax->rate ): ?>selected <?php endif; ?>
                                                            value="<?php echo e($tax->rate); ?>"><?php echo e($tax->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    <strong><?php echo e(trans('file.Order Discount')); ?></strong>
                                                </label>
                                                <input type="number" name="order_discount" id="order_discount" class="form-control" value="<?php echo e($lims_sale_data->order_discount); ?>" step="any" min="0" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" name="payment_status" value="<?php echo e($lims_sale_data->payment_status); ?>" />
                                                <label><?php echo e(trans('file.Payment Status')); ?> *</label>
                                                <select name="payment_status" class="form-control">
                                                    <option <?php if($lims_sale_data->payment_status == 2): ?> selected <?php endif; ?> value="2"><?php echo e(trans('file.Due')); ?></option>
                                                    <option <?php if($lims_sale_data->payment_status == 4): ?> selected <?php endif; ?> value="4"><?php echo e(trans('file.Paid')); ?></option>
                                                </select>
                                                <input type="hidden" name="paid_amount" value="<?php echo e($lims_sale_data->paid_amount); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    <strong><?php echo e(trans('file.Shipping Cost')); ?></strong>
                                                </label>
                                                <input type="number" id="shipping_cost" name="shipping_cost" class="form-control" value="<?php echo e($lims_sale_data->shipping_cost); ?>" step="any" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    <strong>Commission %</strong>
                                                </label>
                                                <input type="number" id="commission_rate" name="commission_rate" class="form-control" value="<?php echo e($lims_sale_data->commission_rate); ?>" step="any" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo e(trans('file.Sale Status')); ?> *</label>
                                                <input type="hidden" name="sale_status_hidden" value="<?php echo e($lims_sale_data->sale_status); ?>" />
                                                <select name="sale_status" class="form-control">
                                                    <option <?php if($lims_sale_data->sale_status == 1): ?> selected <?php endif; ?> value="1"><?php echo e(trans('file.Completed')); ?></option>
                                                    <option <?php if($lims_sale_data->sale_status == 2): ?> selected <?php endif; ?> value="2"><?php echo e(trans('file.Pending')); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo e(trans('file.Sale Note')); ?></label>
                                                <textarea rows="5" class="form-control" name="sale_note"><?php echo e($lims_sale_data->sale_note); ?></textarea>
                                            </div>
                                        </div>
                                        
                                            
                                                
                                                
                                            
                                        
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary" id="submit-button">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="subtotal_amount" id="subtotal_amount">
                            <input type="hidden" name="grandtotal_amount" id="grandtotal_amount">
                            <input type="hidden" name="tax_amount" id="tax_amount">
                            <input type="hidden" name="commission_amount" id="commission_amount">
                            <input type="hidden" name="final_order_discount" id="final_order_discount">
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <table class="table table-bordered table-condensed totals">
                <td><strong><?php echo e(trans('file.Items')); ?></strong>
                    <span class="pull-right" id="item"><?php echo e($lims_sale_data->item); ?></span>
                </td>
                <td><strong><?php echo e(trans('file.Total')); ?></strong>
                    <span class="pull-right" id="subtotal"><?php echo e($lims_sale_data->total_price); ?></span>
                </td>
                <td><strong><?php echo e(trans('file.Order Tax')); ?></strong>
                    <span class="pull-right" id="order_tax"><?php echo e($lims_sale_data->order_tax); ?></span>
                </td>
                <td><strong><?php echo e(trans('file.Order Discount')); ?></strong>
                    <span class="pull-right" id="order_discount"><?php echo e($lims_sale_data->order_discount); ?></span>
                    <?php if($lims_sale_data->discount_method == 2): ?>
                        <span id="discount_sign">( % )</span>
                    <?php else: ?>
                        <span id="discount_sign">( Tk. )</span>
                    <?php endif; ?>
                </td>
                <td><strong>Commission</strong>
                    <span class="pull-right" id="final_commission_amount"><?php echo e($lims_sale_data->commission_amount); ?></span>
                </td>
                <td><strong><?php echo e(trans('file.Shipping Cost')); ?></strong>
                    <span class="pull-right" id="final_shipping_cost"><?php echo e($lims_sale_data->shipping_cost); ?></span>
                </td>
                <td><strong><?php echo e(trans('file.grand total')); ?></strong>
                    <span class="pull-right" id="grand_total"><?php echo e($lims_sale_data->grand_total); ?></span>
                </td>
            </table>
        </div>

        <!-- add cash register modal -->
        <div id="cash-register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <?php echo Form::open(['route' => 'cashRegister.store', 'method' => 'post']); ?>

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Cash Register')); ?></h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <div class="row">
                            <div class="col-md-6 form-group warehouse-section">
                                <label><?php echo e(trans('file.Warehouse')); ?> *</strong> </label>
                                <select required name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                    <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label><?php echo e(trans('file.Cash in Hand')); ?> *</strong> </label>
                                <input type="number" name="cash_in_hand" required class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </section>


    <!-- Create Modal -->
    <div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <?php echo Form::open(['route' => 'customer.store', 'method' => 'post', 'files' => true]); ?>

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('Add Customer')); ?></h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Customer Group')); ?> *</strong> </label>
                                <select required class="form-control selectpicker" id="customer-group-id" name="customer_group_id" onchange='saveValue(this);'>
                                    <?php $__currentLoopData = $lims_customer_group_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($customer_group->id); ?>"><?php echo e($customer_group->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Customer Priority')); ?> *</strong> </label>
                                <select required class="form-control selectpicker" id="priority_id" name="priority_id" onchange='saveValue(this);'>
                                    <?php $__currentLoopData = $lims_priority_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($priority->id); ?>"><?php echo e($priority->priority); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Company Name')); ?> *</label>
                                <input type="text" name="company_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Email')); ?></label>
                                <input type="email" name="email" placeholder="example@example.com" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Phone Number')); ?> *</label>
                                <input type="text" name="phone_number" required class="form-control">
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
                                <input type="text" name="vat_no" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Factory Address')); ?> *</label>
                                <textarea id="factory_address" type="text" class="form-control" name="factory_address" placeholder="Enter address ..." required rows="2"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Head Office Address')); ?> *</label>
                                <textarea id="head_office_address" type="text" class="form-control" name="head_office_address" placeholder="Enter address ..." required rows="2"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Interest</label>
                                <select class="form-control" id="interest_id" name="interest_id">
                                    <option value="">No Interest Selected</option>
                                    <?php $__currentLoopData = $interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($interest->id); ?>"><?php echo e($interest->topic); ?></option>
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

                        <div class="col-md-12" id="contract_person">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label><?php echo e(trans('Contract Person')); ?></label>
                                        <input type="text" name="contract_person[]" class="form-control" placeholder="Enter contract person name">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label><?php echo e(trans('Phone Number')); ?></label>
                                        <input type="text" name="contract_phone[]" class="form-control" placeholder="Enter phone number">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-danger btn-sm" id="add_contact" style="color: white;
                                        margin-top: 35px;">+ Add Person</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Add User')); ?></label>&nbsp;
                                <input type="checkbox" name="user" value="1" />
                            </div>
                        </div>

                        <div class="col-md-6 user-input">
                            <div class="form-group">
                                <label><?php echo e(trans('file.UserName')); ?> *</label>
                                <input type="text" name="name" class="form-control">
                                <?php if($errors->has('name')): ?>
                                    <span>
                                <strong><?php echo e($errors->first('name')); ?></strong>
                            </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 user-input">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Password')); ?> *</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="returntosale" value="1">

                    <div class="form-group">
                        <input type="hidden" name="pos" value="0">
                        <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

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

        $("ul#sale").siblings('a').attr('aria-expanded', 'true');
        $("ul#sale").addClass("show");
        $("ul#sale #sale-create-menu").addClass("active");


        $(document).ready(function(){
            var max_field = 5;
            var wrapper = $("#contract_person");
            var x = 1;
            $("#add_contact").click(function(){
                if(x < max_field){
                    x++;
                    $(wrapper).append('<div class="row" id="new_row">\
                                    <div class="col-md-5">\
                                        <div class="form-group">\
                                            <label><?php echo e(trans('Contract Person')); ?></label>\
                                            <input type="text" name="contract_person[]" class="form-control" placeholder="Enter contract person name">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-5">\
                                        <div class="form-group">\
                                            <label><?php echo e(trans('Phone Number')); ?></label>\
                                            <input type="text" name="contract_phone[]" class="form-control" placeholder="Enter phone number">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-2">\
                                        <a class="btn btn-danger btn-sm" style="color: white;margin-top: 35px;"  id="remove_contact">- Remove Person</a>\
                                    </div>\
                                </div>');
                }else{
                    alert('you can not add more than 5 field');
                }
            });

            $(document).on('click', '#remove_contact', function(){
                $('#new_row').remove();
                x--;
            });
        });

        $(".user-input").hide();

        $('input[name="user"]').on('change', function() {
            if ($(this).is(':checked')) {
                $('.user-input').show(300);
                $('input[name="name"]').prop('required',true);
                $('input[name="password"]').prop('required',true);
            }
            else{
                $('.user-input').hide(300);
                $('input[name="name"]').prop('required',false);
                $('input[name="password"]').prop('required',false);
            }
        });

        $("#card-element").hide();
        $("#cheque").hide();

        // array data depend on warehouse
        var lims_product_array = [];

        // array data with selection
        var product_price = [];
        var product_discount = [];
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

        var exist_type = [];
        var exist_code = [];
        var exist_qty = [];
        var rowindex;
        var customer_group_rate;
        var row_product_price;
        var currency = <?php echo json_encode($currency) ?>;
        var role_id = <?php echo json_encode(Auth::user()->role_id) ?>;

        var rownumber = $('table.order-list tbody tr:last').index();

        for (rowindex = 0; rowindex <= rownumber; rowindex++) {
            product_price.push(parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-price').val()));
            exist_code.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text());
            exist_type.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-type').val());
            var total_discount = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(5)').text());
            var quantity = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val());
            exist_qty.push(quantity);
            product_discount.push((total_discount / quantity).toFixed(2));
            tax_rate.push(parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val()));
            tax_name.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-name').val());
            tax_method.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-method').val());
             $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit').val(temp_unit_name[0]);
        }


            <?php $serviceArray = []; ?>
        var lims_service_code = [<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $serviceArray[] = $service->code . ' (' . $service->name . ')';
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php
                echo '"' . implode('","', $serviceArray) . '"';
                ?>
            ];

        $('#lims_productcodeSearch').on('keyup',function () {
            console.log(85);
        });

        var lims_productcodeSearch = $('#lims_productcodeSearch');
        lims_productcodeSearch.autocomplete({
            source: function(request, response) {
                var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
                response($.grep(lims_service_code, function(item) {
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


        function productSearch(data) {
            $.ajax({
                type: 'GET',
                url: '../../getservices',
                data: {
                    data: data
                },
                success: function(data) {
                    console.log(data);
                    var flag = 1;
                    $(".service-code").each(function () {
                        if ($(this).text() == data[1]) {
                            alert('duplicate input is not allowed!')
                            flag = 0;
                        }
                    });
                    $("input[name='service_code_name']").val('');
                    if (flag) {
                        var newRow = $("<tr>");
                        var cols = '';
                        cols += '<td>' + data[0] + '</td>';
                        cols += '<td class="service-code">' + data[1] + '</td>';
                        cols += '<td><button type="button" onclick="servicePriceCalcMinus('+data[2]+')" class="ibtnDel btn btn-md btn-danger"><?php echo e(trans("file.delete")); ?></button></td>';
                        cols += '<input type="hidden" class="service-code" name="service_code[]" value="' + data[1] + '"/>';
                        cols += '<input type="hidden" class="service-id" name="service_id[]" value="' + data[6] + '"/>';

                        newRow.append(cols);
                        $("table.order-list tbody").append(newRow);
                        $('#lims_productcodeSearch').val('');

                    }

                    servicePriceCalcPlus(data[2]);
                }
            });
        }

        //Delete product
        $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
            $(this).closest("tr").remove();
            //calculate_price();
        });

        $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
            rowindex = $(this).closest('tr').index();
            product_price.splice(rowindex, 1);
            product_discount.splice(rowindex, 1);
            tax_rate.splice(rowindex, 1);
            tax_name.splice(rowindex, 1);
            tax_method.splice(rowindex, 1);
            $(this).closest("tr").remove();


        });



        function servicePriceCalcMinus(price){
            console.log(price);
            var prvsubtotal = $('#subtotal').html();
            var prvgrandtotal = $('#grand_total').html();
            var subtotal = parseFloat(prvsubtotal) - parseFloat(price);
            total = subtotal;
            var grandtotal = parseFloat(prvgrandtotal) - parseFloat(price);

            $('#subtotal').html(subtotal);
            calc(subtotal);


        }

        function servicePriceCalcPlus(price){
            //console.log(price);
            var prvsubtotal = $('#subtotal').html();
            var prvgrandtotal = $('#grand_total').html();
            var subtotal = parseFloat(prvsubtotal) + parseFloat(price);
            total = subtotal;
            var grandtotal = parseFloat(prvgrandtotal) + parseFloat(price);

            $('#subtotal').html(subtotal);
            calc(subtotal);


        }

        function calc(subtotal){
            var basePrice = subtotal

            var discount = $('#order_discount').val();

            if(discount == ''){
                discount = 0.00;
            }

            var total = parseFloat(basePrice) - parseFloat(discount);

            var commission = $('#commission_rate').val();
            var final_commssion = 0.00;

            if(commission != 0){
                final_commssion =  parseFloat(basePrice) * (parseFloat(commission) / 100)
                $('#commission_amount').val(final_commssion);
            }

            var tax = $('#order_tax_rate').val();
            var final_tax = 0.00;

            if(tax != 0){
                final_tax =  parseFloat(basePrice) * (parseFloat(tax) / 100);
                $('#tax_amount').val(final_tax);
            }

            var shipping_cost = $('#shipping_cost').val();
            //console.log(shipping_cost);
            if(shipping_cost == ''){
                shipping_cost = 0.00;
            }

            var grand_total = (parseFloat(total) + parseFloat(shipping_cost) +
                parseFloat(final_tax)) - parseFloat(final_commssion);

            $('#subtotal').html(parseFloat(basePrice).toFixed(2));
            $('#subtotal_amount').val(parseFloat(basePrice).toFixed(2));
            $('#order_tax').html(parseFloat(final_tax).toFixed(2));
            $('#final_discount').html(parseFloat(discount).toFixed(2));
            $('#final_shipping_cost').html(parseFloat(shipping_cost).toFixed(2));
            $('#final_commission_amount').html(parseFloat(final_commssion).toFixed(2));
            $('#grand_total').html(parseFloat(grand_total).toFixed(2));
            $('#grandtotal_amount').val(parseFloat(grand_total).toFixed(2));
        }

        //console.log(total);
        function serviceCacl(){

            var basePrice = $('#subtotal').html();

            var discount = $('#order_discount').val();

            if(discount == ''){
                discount = 0.00;
            }

            var total = parseFloat(basePrice) - parseFloat(discount);

            var commission = $('#commission_rate').val();
            var final_commssion = 0.00;

            if(commission != 0){
                final_commssion =  parseFloat(basePrice) * (parseFloat(commission) / 100)
                $('#commission_amount').val(final_commssion);
            }

            var tax = $('#order_tax_rate').val();
            var final_tax = 0.00;

            if(tax != 0){
                final_tax =  parseFloat(basePrice) * (parseFloat(tax) / 100);
                $('#tax_amount').val(final_tax);
            }

            var shipping_cost = $('#shipping_cost').val();
            //console.log(shipping_cost);
            if(shipping_cost == ''){
                shipping_cost = 0.00;
            }

            var grand_total = (parseFloat(total) + parseFloat(shipping_cost) +
                parseFloat(final_tax)) - parseFloat(final_commssion);

            $('#subtotal').html(parseFloat(basePrice).toFixed(2));
            $('#total_price').val(parseFloat(basePrice).toFixed(2));
            $('#subtotal_amount').val(parseFloat(basePrice).toFixed(2));
            $('#order_tax').html(parseFloat(final_tax).toFixed(2));
            $('#final_discount').html(parseFloat(discount).toFixed(2));
            $('#final_shipping_cost').html(parseFloat(shipping_cost).toFixed(2));
            $('#final_commission_amount').html(parseFloat(final_commssion).toFixed(2));
            $('#grand_total').html(parseFloat(grand_total).toFixed(2));
            $('#grandtotal_amount').val(parseFloat(grand_total).toFixed(2));


        }

        $('#order_tax_rate').on('change',function () {
            serviceCacl();
        });


        $('#order_discount').on('keyup',function () {
            serviceCacl();
        });
        $('#shipping_cost').on('keyup',function () {
            serviceCacl();
        });

        $('#commission_rate').on('keyup',function () {
            serviceCacl();
        });


        $('[data-toggle="tooltip"]').tooltip();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
<?php $__env->stopSection(); ?> <?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bdtech\resources\views/service_quotation/service_sale_edit.blade.php ENDPATH**/ ?>