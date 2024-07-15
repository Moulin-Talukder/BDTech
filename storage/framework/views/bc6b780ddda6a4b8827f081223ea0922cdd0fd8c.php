 <?php $__env->startSection('content'); ?>

<?php if($errors->has('name')): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e($errors->first('name')); ?></div>
<?php endif; ?>
<?php if(session()->has('message')): ?>
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div>
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
<?php endif; ?>

<section>
    <div class="container-fluid">
        <?php if(in_array("service-sales-add", $all_permission)): ?>
        <!-- Trigger the modal with a button -->
        
        <!-- <a href="#" class="btn btn-primary"><i class="dripicons-copy"></i> <?php echo e(trans('file.Import Sale')); ?></a> -->
        <?php endif; ?>
    </div>
    <div class="table-responsive">
        <table id="service-table" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Date')); ?></th>
                    <th><?php echo e(trans('file.reference')); ?></th>
                    <!-- <th><?php echo e(trans('file.Biller')); ?></th>  -->
                    <th><?php echo e(trans('file.customer')); ?></th>
                    <th><?php echo e(trans('file.Sale Status')); ?></th>
                    <th><?php echo e(trans('file.Payment Status')); ?></th>
                    <th><?php echo e(trans('file.grand total')); ?></th>
                    <th><?php echo e(trans('file.Paid')); ?></th>
                    <th><?php echo e(trans('file.Due')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $all_service_sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-id="<?php echo e($sale->id); ?>">
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date('d F Y',strtotime($sale->created_at))); ?></td>
                    <td><?php echo e($sale->reference_no); ?></td>
                    <!-- <td><?php echo e($sale->biller->name ?? "-"); ?></td> -->
                    <td><?php echo e($sale->customer->company_name); ?></td>
                    <td class="">
                        <?php if($sale->sale_status == 1): ?>
                        <div class="badge badge-success">Completed</div>
                        <?php elseif($sale->sale_status == 2): ?>
                        <div class="badge badge-danger">Pending</div>
                        <?php else: ?>
                        <div class="badge badge-warning">Draft</div>
                        <?php endif; ?>
                    </td>
                    <td class="">
                        <?php if($sale->payment_status == 1): ?>
                        <div class="badge badge-danger">Pending</div>
                        <?php elseif($sale->payment_status == 2): ?>
                        <div class="badge badge-danger">Due</div>
                        <?php elseif($sale->payment_status == 3): ?>
                        <div class="badge badge-warning">Partial</div>
                        <?php else: ?>
                        <div class="badge badge-success">Paid</div>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e(number_format($sale->grand_total, 2)); ?></td>
                    <td><?php echo e(number_format($sale->paid_amount, 2)); ?></td>
                    <td><?php echo e(number_format($sale->grand_total - $sale->paid_amount, 0)); ?> </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <a href="<?php echo e(route('service.invoice',$sale->id)); ?>" class="btn btn-link"><i class="fa fa-copy"></i> Generate Invoice</a>
                                <li>

                                <li>
                                    <a href="<?php echo e(route('service.chalan',$sale->id)); ?>" class="btn btn-link"><i class="fa fa-copy"></i> Chalan</a>
                                </li>
                                <?php if(in_array("service-sales-edit", $all_permission)): ?>
                                <li>
                                    <a href="<?php echo e(route('service.sale.edit',$sale->id)); ?>" class="btn btn-link"><i class="dripicons-document-edit"></i> Edit</a>
                                </li>
                                </li>
                                <?php endif; ?>
                                <!-- <?php if(in_array("service-sales-index", $all_permission)): ?>
                                <li>
                                    <button type="button" data-id="<?php echo e($sale->id); ?>" class="btn btn-link view"><i class="fa fa-eye"></i> View</button>
                                </li>
                                <?php endif; ?> -->
                                <!-- <li>
                                    <button type="button" class="add-payment btn btn-link" data-id="<?php echo e($sale->id); ?>" data-toggle="modal" data-target="#add-payment"><i class="fa fa-plus"></i> Add Payment</button>
                                </li>
                                <li>
                                    <button type="button" class="get-payment btn btn-link" data-id="<?php echo e($sale->id); ?>"><i class="fa fa-money"></i> View Payment</button>
                                </li> -->
                                <!-- <?php if(in_array("service_delivery", $all_permission)): ?>
                                <li>
                                    <button type="button" class="add-delivery btn btn-link" data-id="<?php echo e($sale->id); ?>"><i class="fa fa-truck"></i> Add Delivery</button>
                                </li>
                                <?php endif; ?> -->
                                <?php if(in_array("service-sales-delete", $all_permission)): ?>
                                <li class="divider"></li>
                                <?php echo e(Form::open(['route' => ['services.destroy', $sale->id], 'method' => 'DELETE'] )); ?>

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

<div id="sale-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="container mt-3 pb-2 border-bottom">
                <div class="row">
                    <div class="col-md-3">
                        <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>

                        <?php echo e(Form::open(['route' => 'sale.sendmail', 'method' => 'post', 'class' => 'sendmail-form'] )); ?>

                        <input type="hidden" name="sale_id">
                        <button class="btn btn-default btn-sm d-print-none"><i class="dripicons-mail"></i> <?php echo e(trans('file.Email')); ?></button>
                        <?php echo e(Form::close()); ?>

                    </div>
                    <div class="col-md-6">
                        <h3 id="exampleModalLabel" class="modal-title text-center container-fluid"><?php echo e($general_setting->site_title); ?></h3>
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close d-print-none"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="col-md-12 text-center">
                        <i style="font-size: 15px;"><?php echo e(trans('file.Sale Details')); ?></i>
                    </div>
                </div>
            </div>
            <div id="sale-content" class="modal-body">
            </div>
            <br>
            <table class="table table-bordered product-sale-list">
                <thead>
                    <th>#</th>
                    <th>Service</th>
                    <th><?php echo e(trans('file.Qty')); ?></th>
                    <th><?php echo e(trans('file.Unit Price')); ?></th>
                    <th><?php echo e(trans('file.Tax')); ?></th>
                    <th><?php echo e(trans('file.Discount')); ?></th>
                    <th><?php echo e(trans('file.Subtotal')); ?></th>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div id="sale-footer" class="modal-body"></div>
        </div>
    </div>
</div>


<div id="view-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.All')); ?> <?php echo e(trans('file.Payment')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover payment-list">
                    <thead>
                        <tr>
                            <th><?php echo e(trans('file.date')); ?></th>
                            <th><?php echo e(trans('file.reference')); ?></th>
                            <th><?php echo e(trans('file.Amount')); ?></th>
                            <th><?php echo e(trans('file.Paid By')); ?></th>
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

<div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Payment')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <?php echo Form::open(['route' => 'service-sale.add-payment', 'method' => 'post', 'files' => true, 'class' => 'payment-form' ]); ?>

                <div class="row">
                    <input type="hidden" name="balance">
                    <div class="col-md-6">
                        <label>Total Due Amount *</label>
                        <input type="text" name="due" id="due" class="form-control" step="any" readonly>
                    </div>
                    <div class="col-md-6">
                        <label><?php echo e(trans('file.Paid Amount')); ?> *</label>
                        <input type="hidden" name="customer_deposit" id="customer_deposit" readonly>
                        <input type="number" id="amount" name="amount" class="form-control" step="any" min="0" required>
                    </div>
                    <div class="col-md-6 mt-1">
                        <label>Due Amount : </label>
                        <p class="change ml-2">0.00</p>
                    </div>
                    <div class="col-md-6 mt-1">
                        <label><?php echo e(trans('file.Paid By')); ?></label>
                        <select name="paid_by_id" class="form-control">
                            <option value="1">Cash</option>
                            <option value="2">Cheque</option>
                            <option value="3">Deposit</option>
                        </select>
                    </div>
                </div>
                <div id="cheque">
                    <div class="form-group">
                        <label><?php echo e(trans('file.Cheque Number')); ?> *</label>
                        <input type="text" name="cheque_no" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label> <?php echo e(trans('file.Account')); ?></label>
                    <select class="form-control selectpicker" name="account_id">
                        <?php $__currentLoopData = $lims_account_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($account->is_default): ?>
                        <option selected value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?> [<?php echo e($account->account_no); ?>]</option>
                        <?php else: ?>
                        <option value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?> [<?php echo e($account->account_no); ?>]</option>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Payment Note')); ?></label>
                    <textarea rows="3" class="form-control" name="payment_note"></textarea>
                </div>

                <input type="hidden" name="sale_id">

                <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>


<div id="add-delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Delivery')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <?php echo Form::open(['route' => 'service.delivery.store', 'method' => 'post', 'files' => true]); ?>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Delivery Reference')); ?></label>
                        <p id="dr"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Sale Reference')); ?></label>
                        <p id="sr"></p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label><?php echo e(trans('file.Status')); ?> *</label>
                        <select name="status" required class="form-control selectpicker">
                            <option value="1">Pending</option>
                            <option value="2">Processing</option>
                            <option value="3">Delivered</option>
                            <option value="4">Failed</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2 form-group">
                        <label><?php echo e(trans('file.Delivered By')); ?></label>
                        <input type="text" name="delivered_by" class="form-control" required>
                    </div>
                    <div class="col-md-6 mt-2 form-group">
                        <label><?php echo e(trans('file.Recieved By')); ?> </label>
                        <input type="text" name="recieved_by" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.customer')); ?> *</label>
                        <p id="customer"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Attach File')); ?></label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Address')); ?> *</label>
                        <textarea rows="3" name="address" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Note')); ?></label>
                        <textarea rows="3" name="note" class="form-control"></textarea>
                    </div>
                </div>
                <input type="hidden" name="reference">
                <input type="hidden" name="sale_id">
                <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $("ul#service").siblings('a').attr('aria-expanded', 'true');
    $("ul#service").addClass("show");
    $("ul#service #service-sale-list-menu").addClass("active");

    $('#category-table').DataTable({

    });


    //     $(document).on("click", "table#category-table .get-payment", function(event) {
    //         var id = $(this).data('id').toString();
    //         $.get('servigetPaymentce/' + id, function(data) {
    //             $(".payment-list tbody").remove();
    //             var newBody = $("<tbody>");
    //             payment_date  = data[0];
    //             payment_reference = data[1];
    //             paid_amount = data[2];
    //             paying_method = data[3];
    //             payment_id = data[4];
    //             payment_note = data[5];
    //             cheque_no = data[6];
    //             change = data[7];
    //             paying_amount = data[8];

    //             $.each(payment_date, function(index){
    //                 var newRow = $("<tr>");
    //                 var cols = '';

    //                 cols += '<td>' + payment_date[index] + '</td>';
    //                 cols += '<td>' + payment_reference[index] + '</td>';
    //                 cols += '<td>' + paid_amount[index] + '</td>';
    //                 cols += '<td>' + paying_method[index] +' '+ cheque_no[index] +'</td>';

    //                 cols += '<td><div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans("file.action")); ?><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu"><?php echo e(Form::open(['route' => 'service.sale.delete-payment', 'method' => 'post'] )); ?><li><input type="hidden" name="id" value="' + payment_id[index] + '" /> <button type="submit" class="btn btn-link" onclick="return confirmPaymentDelete()"><i class="dripicons-trash"></i> <?php echo e(trans("file.delete")); ?></button></li><?php echo e(Form::close()); ?></ul></div></td>';

    //                 newRow.append(cols);
    //                 newBody.append(newRow);
    //                 $("table.payment-list").append(newBody);
    //             });
    //             $('#view-payment').modal('show');
    //         });
    //     });

    //     $(document).on("click", "table#category-table .view", function(event){
    //         var id = $(this).data('id').toString();

    //         $.get('service_sale/' + id, function(data){
    //             var htmltext = '<strong><?php echo e(trans("file.Date")); ?>: </strong>'+data[17]+'<br><strong><?php echo e(trans("file.reference")); ?>: </strong>'+data[16]+'<br><strong><?php echo e(trans("file.Sale Status")); ?>: </strong>'+data[18]+'<br><br><div class="row"><div class="col-md-6"><strong><?php echo e(trans("file.From")); ?>:</strong><br>'+data[19]+'<br>'+data[20]+'<br>'+data[21]+'<br>'+data[22]+'<br>'+data[23]+'<br>'+data[24]+'</div><div class="col-md-6"><div class="float-right"><strong><?php echo e(trans("file.To")); ?>:</strong><br>'+data[25]+'<br>'+data[26]+'<br>'+data[27]+'<br>'+data[28]+'</div></div></div>';
    //             $(".product-sale-list tbody").remove();
    //             var newBody = $("<tbody>");
    //             product = data[0];
    //             qty = data[1];
    //             unit_price = data[2];
    //             discount = data[3];
    //             tax = data[4];
    //             tax_rate = data[5];
    //             sub_total = data[6];

    //             $.each(product, function(index){
    //                 var newRow = $("<tr>");
    //                 var cols = '';

    //                 cols += '<td>' + index + 1 + '</td>';
    //                 cols += '<td>' + product[index] + '</td>';
    //                 cols += '<td>' + qty[index] + '</td>';
    //                 cols += '<td>' + unit_price[index] + '</td>';
    //                 cols += '<td>' + tax[index] + ' ('+ tax_rate[index] +'%)' +'</td>';
    //                 cols += '<td>' + discount[index] +'</td>';
    //                 cols += '<td>' + sub_total[index] +'</td>';

    //                 newRow.append(cols);
    //                 newBody.append(newRow);

    //             });
    //             var newRow = $("<tr>");
    //             cols = '';
    //             cols += '<td colspan=4><strong><?php echo e(trans("file.Total")); ?>:</strong></td>';
    //             cols += '<td>' + data[14] + '</td>';
    //             cols += '<td>' + data[15] + '</td>';
    //             cols += '<td>' + data[13] + '</td>';
    //             newRow.append(cols);
    //             newBody.append(newRow);

    //             var newRow = $("<tr>");
    //             cols = '';
    //             cols += '<td colspan=6><strong><?php echo e(trans("file.Order Tax")); ?>:</strong></td>';
    //             cols += '<td>' + data[7] + '(' + data[8] + '%)' + '</td>';
    //             newRow.append(cols);
    //             newBody.append(newRow);

    //             var newRow = $("<tr>");
    //             cols = '';
    //             cols += '<td colspan=6><strong><?php echo e(trans("file.Order Discount")); ?>:</strong></td>';
    //             cols += '<td>' + data[9] + '</td>';
    //             newRow.append(cols);
    //             newBody.append(newRow);

    //             var newRow = $("<tr>");
    //             cols = '';
    //             cols += '<td colspan=6><strong><?php echo e(trans("file.Shipping Cost")); ?>:</strong></td>';
    //             cols += '<td>' + data[10] + '</td>';
    //             newRow.append(cols);
    //             newBody.append(newRow);

    //             var newRow = $("<tr>");
    //             cols = '';
    //             cols += '<td colspan=6><strong><?php echo e(trans("file.grand total")); ?>:</strong></td>';
    //             cols += '<td>' + data[11] + '</td>';
    //             newRow.append(cols);
    //             newBody.append(newRow);

    //             var newRow = $("<tr>");
    //             cols = '';
    //             cols += '<td colspan=6><strong><?php echo e(trans("file.Paid Amount")); ?>:</strong></td>';
    //             cols += '<td>' + data[12] + '</td>';
    //             newRow.append(cols);
    //             newBody.append(newRow);

    //             var newRow = $("<tr>");
    //             cols = '';
    //             cols += '<td colspan=6><strong><?php echo e(trans("file.Due")); ?>:</strong></td>';
    //             cols += '<td>' + parseFloat(data[11] - data[12]).toFixed(2) + '</td>';
    //             newRow.append(cols);
    //             newBody.append(newRow);

    //             $("table.product-sale-list").append(newBody);
    //             $('#sale-content').html(htmltext);
    //         });

    //         $('#sale-details').modal('show');
    //     });

    //     $(document).on("click", "table#category-table tbody .add-delivery", function(event) {
    //         var id = $(this).data('id').toString();
    //         $.get('service/delivery/'+id, function(data) {
    //             $('#dr').text(data[0]);
    //             $('#sr').text(data[1]);

    //             $('input[name="delivered_by"]').val(data[3]);
    //             $('input[name="recieved_by"]').val(data[4]);
    //             $('#customer').text(data[5]);
    //             $('textarea[name="address"]').val(data[6]);
    //             $('textarea[name="note"]').val(data[7]);
    //             $('input[name="reference"]').val(data[0]);
    //             $('input[name="sale_id"]').val(id);
    //             $('#add-delivery').modal('show');
    //         });
    //     });


    //     $(document).on("click", "table#category-table tbody .add-payment", function() {
    //         $("#cheque").hide();
    //         url ="get_sale/";
    //         var id = $(this).data('id').toString();
    //         url = url.concat(id);
    //         $.get(url, function(data){
    //             var customerDeposit = (data.customer['deposit'] - data.customer['expense']);
    //             var due = data['grand_total'] - data['paid_amount'];
    //             $('input[name="customer_deposit"]').val(customerDeposit);
    //             $('input[name="amount"]').val(due);
    //             $('#add-payment input[name="balance"]').val(due);
    //             $('#add-payment input[name="due"]').val(due);
    //             $('input[name="sale_id"]').val(id);

    //         });
    //     });

    // $('select[name="paid_by_id"]').on("change", function() {
    //     var id = $(this).val();
    //     $(".payment-form").off("submit");
    //     $('input[name="cheque_no"]').attr('required', false);

    //     if(id == 2) {
    //         $("#cheque").show();
    //         $('input[name="cheque_no"]').prop('required', true);
    //     }else if(id == 3){
    //         $("#cheque").hide();
    //         if($('input[name="amount"]').val() > $('input[name="customer_deposit"]').val()){
    //             alert('Amount exceeds customer deposit! Customer deposit');
    //         }
    //     }else{
    //         $("#cheque").hide();
    //     }
    // });

    //     $('input[name="amount"]').on("input", function() {
    //          if( $(this).val() > parseFloat($('input[name="balance"]').val()) ) {
    //             alert('Paying amount cannot be bigger than due amount');
    //             $(this).val('');
    //         }
    //         $(".change").text( parseFloat($("#due").val() - $(this).val()).toFixed(2) );
    //         var id = $('select[name="paid_by_id"]').val();
    //         if(id == 3){
    //         if($('input[name="amount"]').val() > $('input[name="customer_deposit"]').val()){
    //                 alert('Amount exceeds customer deposit! Customer deposit');
    //             }
    //         }
    //     });


    var category_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#select_all").on("change", function() {
        if ($(this).is(':checked')) {
            $("tbody input[type='checkbox']").prop('checked', true);
        } else {
            $("tbody input[type='checkbox']").prop('checked', false);
        }
    });

    $("#print-btn").on("click", function() {
        var divToPrint = document.getElementById('sale-details');
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media  print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">' + divToPrint.innerHTML + '</body>');
        newWin.document.close();
        setTimeout(function() {
            newWin.close();
        }, 10);
    });

    $('#service-table').DataTable({
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ <?php echo e(trans("file.records per page")); ?>',
            "info": '<small><?php echo e(trans("file.Showing")); ?> _START_ - _END_ (_TOTAL_)</small>',
            "search": '<?php echo e(trans("file.Search")); ?>',
            'paginate': {
                'previous': '<i class="dripicons-chevron-left"></i>',
                'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [{
                "orderable": false,
                'targets': [0, 2, 3, 6, 7, 8, 9]
            },
            {
                'render': function(data, type, row, meta) {
                    if (type === 'display') {
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
        'select': {
            style: 'multi',
            selector: 'td:first-child'
        },
        'lengthMenu': [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: '<"row"lfB>rtip',
        buttons: [{
                extend: 'pdf',
                text: '<?php echo e(trans("file.PDF")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                },
                footer: true
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
                action: function(e, dt, node, config) {
                    // if (user_verified == '1') {
                        category_id.length = 0;
                        $(':checkbox:checked').each(function(i) {
                            if (i) {
                                category_id[i - 1] = $(this).closest('tr').data('id');
                            }
                        });
                        if (category_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type: 'POST',
                                url: 'categories/deletebyselection',
                                data: {
                                    categoryIdArray: category_id
                                },
                                success: function(data) {
                                    alert(data);
                                }
                            });
                            dt.rows({
                                page: 'current',
                                selected: true
                            }).remove().draw(false);
                        } else if (!category_id.length)
                            alert('No interest is selected!');
                    // } else
                    //     alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            },
        ],
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bdtech\resources\views/service/sale_list.blade.php ENDPATH**/ ?>