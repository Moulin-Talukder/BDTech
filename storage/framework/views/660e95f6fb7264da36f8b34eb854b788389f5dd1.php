 <?php $__env->startSection('content'); ?>
<style>

    #sale-table_paginate,
    #reminder-table_paginate,
    #deposit-table_paginate,
    #comment-table_paginate {
        float: right;
    }

    #reminder-table_filter input,
    #comment-table_filter input {
        width: 200%;
    }

    .card-header h4 {
        float: left;
        width: 94%;
    }

    button.btn.btn-info {
        margin: 0px 8px 0px 10px;
        float: right;

    }

    @media  print {

        /* Hide every other element */
        body * {
            visibility: hidden;

        }

        /* Then displaying print container elements */
        •print-container,
        .print-container * {
            visibility: visible;

        }


        @page  {
            margin-bottom: 0px;
        }



        /* .watermarked {
    -webkit-print-color-adjust: exact !important;
} */
    }
</style>
<section class="forms">

    <div class="col-md-12">

        <button class="btn btn-info" onclick="window.print()" tabindex="0" aria-controls="deposit-table" type="button"><span>Print</span></button>

    </div>
    <br><br><br>
    <div class="container-fluid print-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Customer Details')); ?></h4>

                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped table-bordered">
                            <tr>
                                <td><?php echo e(trans('file.Customer Group')); ?></td>
                                <td><?php echo e($customer->group->name); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(trans('file.Company Name')); ?></td>
                                <td><?php echo e($customer->company_name); ?> [<?php echo e($customer->phone_number); ?>]</td>
                            </tr>
                            <tr>
                                <td><?php echo e(trans('Designation')); ?></td>
                                <td><?php echo e($customer->designation); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(trans('Customer Priority')); ?></td>
                                <td>
                                    <?php if($customer->priority): ?>
                                    <?php echo e($customer->priority->priority); ?>

                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(trans('Interest')); ?></td>
                                <td>
                                    <?php if($customer->interest): ?>
                                    <?php echo e($customer->interest->topic); ?>

                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(trans('file.Date')); ?></td>
                                <td><?php echo e(date('d/m/Y', strtotime($customer->created_at))); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(trans('file.Email')); ?></td>
                                <td><?php echo e($customer->email); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(trans('file.Phone Number')); ?></td>
                                <td><?php echo e($customer->phone_number); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(trans('Factory Address')); ?></td>
                                <td><?php echo e($customer->factory_address); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(trans('Head Office Address')); ?></td>
                                <td><?php echo e($customer->head_office_address); ?></td>
                            </tr>

                            <tr>
                                <td><?php echo e(trans('Visiting Card')); ?></td>
                                <?php if($customer->image): ?>
                                <td> <img src="<?php echo e(url('public/images/customer',$customer->image)); ?>" height="80" width="80">
                                </td>
                                <?php else: ?>
                                <td>No Image</td>
                                <?php endif; ?>
                            </tr>
                            
                            <?php $json_data = json_decode($customer->contract_person,true); ?>


                            <tr>
                                <td><?php echo e(trans('Contract Person')); ?></td>
                                <td>

                                    <?php $__currentLoopData = $json_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($value); ?><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(trans('file.Balance')); ?></td>
                                <td><?php echo e(number_format($customer->deposit - $customer->expense, 2)); ?></td>
                            </tr>

                        </table>

                    </div>

                    <div class="card-header d-flex align-items-center">
                        <h4>All Deposits</h4>
                    </div>
                    <div class="card-body">
                        <table id="deposit-table" class="table table-hover table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Amount</th>
                                    <th>Note</th>
                                    <th>Cretaed By</th>
                                    <th>Cretaed Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $customer->deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($deposit->amount); ?></td>
                                    <td>
                                        <?php if(isset($deposit->note)): ?>
                                        <?php echo e($deposit->note); ?>

                                        <?php else: ?>
                                        N/A
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($deposit->user->name); ?></td>
                                    <td><?php echo e(date('d/m/Y', strtotime($deposit->created_at))); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-header d-flex align-items-center">
                        <h4>All Product Sales</h4>
                    </div>

                    <div class="card-body">
                        <table id="sale-table" class="table table-hover table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Reference</th>
                                    <th>Sale Status</th>
                                    <th>Payment status</th>
                                    <th>Grand Total</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalPaid = 0; $totalGrand = 0;
                                ?>
                                <?php $__currentLoopData = $customer->sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e(date('d/m/Y',strtotime($sale->created_at))); ?></td>
                                    <td><?php echo e($sale->reference_no); ?></td>
                                    <td>
                                        <?php if($sale->sale_status == 1): ?>
                                        <span class="badge badge-success">Complete</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($sale->payment_status == 1): ?>
                                        <span class="badge badge-info">Pending</span>
                                        <?php elseif($sale->payment_status == 2): ?>
                                        <span class="badge badge-danger">Due</span>
                                        <?php elseif($sale->payment_status == 3): ?>
                                        <span class="badge badge-warning">Partial</span>
                                        <?php elseif($sale->payment_status == 4): ?>
                                        <span class="badge badge-success">Paid</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($sale->grand_total); ?></td>
                                    <td><?php echo e($sale->paid_amount); ?></td>
                                    <?php
                                    $totalPaid += $sale->paid_amount;
                                    $totalGrand += $sale->grand_total;
                                    ?>
                                    <td><?php echo e($sale->grand_total - $sale->paid_amount); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                                <?php if(in_array("sales-edit", $all_permission)): ?>
                                                <li>
                                                    <a href="<?php echo e(route('sales.edit',$sale->id)); ?>" class="btn btn-link"><i class="dripicons-document-edit"></i> Edit</a>
                                                </li>
                                                </li>
                                                <?php endif; ?>
                                                <?php if(in_array("sales-index", $all_permission)): ?>
                                                <li>
                                                    <button type="button" data-id="<?php echo e($sale->id); ?>" class="btn btn-link view"><i class="fa fa-eye"></i> View</button>
                                                </li>
                                                <?php endif; ?>
                                                <?php if(in_array("sales-index", $all_permission)): ?>
                                                <li>
                                                    <button type="button" class="get-payment btn btn-link" data-id="<?php echo e($sale->id); ?>"><i class="fa fa-money"></i> View Payment</button>
                                                </li>
                                                <?php endif; ?>
                                                <li>
                                                    <button type="button" class="add-product-delivery btn btn-link" data-id="<?php echo e($sale->id); ?>"><i class="fa fa-truck"></i> Add Delivery</button>
                                                </li>
                                                <?php if(in_array("delivery", $all_permission)): ?>
                                                <li class="divider"></li>
                                                <?php echo e(Form::open(['route' => ['sales.destroy', $sale->id], 'method' => 'DELETE'] )); ?>

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
                            <tfoot class="tfoot active">
                                <th></th>
                                <th><?php echo e(trans('file.Total')); ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php echo e($totalGrand); ?></th>
                                <th><?php echo e($totalPaid); ?></th>
                                <th><?php echo e($totalGrand-$totalPaid); ?></th>
                                <th></th>
                            </tfoot>
                        </table>
                    </div>


                    <div class="card-header d-flex align-items-center">
                        <h4>All Service Sales</h4>
                    </div>
                    <div class="card-body">
                        <table id="service-table" class="table table-hover table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Reference</th>
                                    <th>Sale Status</th>
                                    <th>Payment status</th>
                                    <th>Grand Total</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalPaid = 0; $totalGrand = 0;
                                ?>
                                <?php $__currentLoopData = $customer->serviceSale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e(date('d/m/Y',strtotime($sale->created_at))); ?></td>
                                    <td><?php echo e($sale->reference_no); ?></td>
                                    <td>
                                        <?php if($sale->sale_status == 1): ?>
                                        <span class="badge badge-success">Complete</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($sale->payment_status == 1): ?>
                                        <span class="badge badge-danger">Pending</span>
                                        <?php elseif($sale->payment_status == 2): ?>
                                        <span class="badge badge-danger">Due</span>
                                        <?php elseif($sale->payment_status == 3): ?>
                                        <span class="badge badge-warning">Partial</span>
                                        <?php elseif($sale->payment_status == 4): ?>
                                        <span class="badge badge-success">Paid</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($sale->grand_total); ?></td>
                                    <td><?php echo e($sale->paid_amount); ?></td>
                                    <?php
                                    $totalPaid += $sale->paid_amount;
                                    $totalGrand += $sale->grand_total;
                                    ?>
                                    <td><?php echo e($sale->grand_total - $sale->paid_amount); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                                <?php if(in_array("service-sales-edit", $all_permission)): ?>
                                                <li>
                                                    <a href="<?php echo e(route('service.sale.edit',$sale->id)); ?>" class="btn btn-link"><i class="dripicons-document-edit"></i> Edit</a>
                                                </li>
                                                </li>
                                                <?php endif; ?>
                                                <?php if(in_array("service-sales-index", $all_permission)): ?>
                                                <li>
                                                    <button type="button" data-id="<?php echo e($sale->id); ?>" class="btn btn-link view"><i class="fa fa-eye"></i> View</button>
                                                </li>
                                                <?php endif; ?>
                                                <?php if(in_array("service-sales-index", $all_permission)): ?>
                                                <li>
                                                    <button type="button" class="add-payment btn btn-link" data-id="<?php echo e($sale->id); ?>" data-toggle="modal" data-target="#add-payment"><i class="fa fa-plus"></i> Add Payment</button>
                                                </li>
                                                <li>
                                                    <button type="button" class="get-payment btn btn-link" data-id="<?php echo e($sale->id); ?>"><i class="fa fa-money"></i> View Payment</button>
                                                </li>
                                                <?php endif; ?>
                                                <?php if(in_array("service_delivery", $all_permission)): ?>
                                                <li>
                                                    <button type="button" class="add-delivery btn btn-link" data-id="<?php echo e($sale->id); ?>"><i class="fa fa-truck"></i> Add Delivery</button>
                                                </li>
                                                <?php endif; ?>
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
                            <tfoot class="tfoot active">
                                <th></th>
                                <th><?php echo e(trans('file.Total')); ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php echo e($totalGrand); ?></th>
                                <th><?php echo e($totalPaid); ?></th>
                                <th><?php echo e($totalGrand-$totalPaid); ?></th>
                                <th></th>
                            </tfoot>
                        </table>
                    </div>

                    <div class="card-header d-flex align-items-center">
                        <h4>Comments</h4>
                    </div>
                    <div class="card-body">
                        <table id="comment-table" class="table table-hover table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Topic</th>
                                    <th>Details</th>
                                    <th>Created On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $customer->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($comment->topic); ?></td>
                                    <td><?php echo e($comment->details); ?></td>
                                    <td><?php echo e(date('d/m/Y', strtotime($comment->created_at))); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="card-header d-flex align-items-center">
                        <h4>Reminders</h4>
                    </div>
                    <div class="card-body">
                        <table id="reminder-table" class="table table-hover table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Topic</th>
                                    <th>Note</th>
                                    <th>Date & Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $customer->reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reminder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($reminder->topic); ?></td>
                                    <td><?php echo e($reminder->note); ?></td>
                                    <td><?php echo e(date('d/m/Y', strtotime($reminder->date))); ?> || <?php echo e(date('h:i A', strtotime($reminder->time))); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).on("click", "table#service-table .view", function(event) {
        var id = $(this).data('id').toString();

        $.get('service_sale/' + id, function(data) {
            var htmltext = '<strong><?php echo e(trans("file.Date")); ?>: </strong>' + data[17] + '<br><strong><?php echo e(trans("file.reference")); ?>: </strong>' + data[16] + '<br><strong><?php echo e(trans("file.Sale Status")); ?>: </strong>' + data[18] + '<br><br><div class="row"><div class="col-md-6"><strong><?php echo e(trans("file.From")); ?>:</strong><br>' + data[19] + '<br>' + data[20] + '<br>' + data[21] + '<br>' + data[22] + '<br>' + data[23] + '<br>' + data[24] + '</div><div class="col-md-6"><div class="float-right"><strong><?php echo e(trans("file.To")); ?>:</strong><br>' + data[25] + '<br>' + data[26] + '<br>' + data[27] + '<br>' + data[28] + '</div></div></div>';
            $(".product-sale-list tbody").remove();
            var newBody = $("<tbody>");
            product = data[0];
            qty = data[1];
            unit_price = data[2];
            discount = data[3];
            tax = data[4];
            tax_rate = data[5];
            sub_total = data[6];

            $.each(product, function(index) {
                var newRow = $("<tr>");
                var cols = '';

                cols += '<td>' + index + 1 + '</td>';
                cols += '<td>' + product[index] + '</td>';
                cols += '<td>' + qty[index] + '</td>';
                cols += '<td>' + unit_price[index] + '</td>';
                cols += '<td>' + tax[index] + ' (' + tax_rate[index] + '%)' + '</td>';
                cols += '<td>' + discount[index] + '</td>';
                cols += '<td>' + sub_total[index] + '</td>';

                newRow.append(cols);
                newBody.append(newRow);

            });
            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=4><strong><?php echo e(trans("file.Total")); ?>:</strong></td>';
            cols += '<td>' + data[14] + '</td>';
            cols += '<td>' + data[15] + '</td>';
            cols += '<td>' + data[13] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.Order Tax")); ?>:</strong></td>';
            cols += '<td>' + data[7] + '(' + data[8] + '%)' + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.Order Discount")); ?>:</strong></td>';
            cols += '<td>' + data[9] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.Shipping Cost")); ?>:</strong></td>';
            cols += '<td>' + data[10] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.grand total")); ?>:</strong></td>';
            cols += '<td>' + data[11] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.Paid Amount")); ?>:</strong></td>';
            cols += '<td>' + data[12] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.Due")); ?>:</strong></td>';
            cols += '<td>' + parseFloat(data[11] - data[12]).toFixed(2) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            $("table.product-sale-list").append(newBody);
            $('#sale-content').html(htmltext);
        });

        $('#sale-details').modal('show');
    });

    $(document).on("click", "table#service-table tbody .add-payment", function() {
        $("#cheque").hide();
        url = "get_sale/";
        var id = $(this).data('id').toString();
        url = url.concat(id);
        $.get(url, function(data) {
            var customerDeposit = (data.customer['deposit'] - data.customer['expense']);
            var due = data['grand_total'] - data['paid_amount'];
            $('input[name="customer_deposit"]').val(customerDeposit);
            $('input[name="amount"]').val(due);
            $('#add-payment input[name="balance"]').val(due);
            $('#add-payment input[name="due"]').val(due);
            $('input[name="sale_id"]').val(id);

        });
    });

    $(document).on("click", "table#service-table .get-payment", function(event) {
        var id = $(this).data('id').toString();
        $.get('servigetPaymentce/' + id, function(data) {
            $(".payment-list tbody").remove();
            var newBody = $("<tbody>");
            payment_date = data[0];
            payment_reference = data[1];
            paid_amount = data[2];
            paying_method = data[3];
            payment_id = data[4];
            payment_note = data[5];
            cheque_no = data[6];
            change = data[7];
            paying_amount = data[8];

            $.each(payment_date, function(index) {
                var newRow = $("<tr>");
                var cols = '';

                cols += '<td>' + payment_date[index] + '</td>';
                cols += '<td>' + payment_reference[index] + '</td>';
                cols += '<td>' + paid_amount[index] + '</td>';
                cols += '<td>' + paying_method[index] + ' ' + cheque_no[index] + '</td>';

                cols += '<td><div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans("file.action")); ?><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu"><?php echo e(Form::open(['
                route ' => '
                service.sale.delete - payment ', '
                method ' => '
                post '] )); ?><li><input type="hidden" name="id" value="' + payment_id[index] + '" /> <button type="submit" class="btn btn-link" onclick="return confirmPaymentDelete()"><i class="dripicons-trash"></i> <?php echo e(trans("file.delete")); ?></button></li><?php echo e(Form::close()); ?></ul></div></td>';

                newRow.append(cols);
                newBody.append(newRow);
                $("table.payment-list").append(newBody);
            });
            $('#view-payment').modal('show');
        });
    });

    /*Deliveru method for service delivery*/
    $(document).on("click", "table#service-table tbody .add-delivery", function(event) {
        var id = $(this).data('id').toString();
        $.get('service/delivery/' + id, function(data) {
            $('#dr').text(data[0]);
            $('#sr').text(data[1]);

            $('input[name="delivered_by"]').val(data[3]);
            $('input[name="recieved_by"]').val(data[4]);
            $('#customer').text(data[5]);
            $('textarea[name="address"]').val(data[6]);
            $('textarea[name="note"]').val(data[7]);
            $('input[name="reference"]').val(data[0]);
            $('input[name="sale_id"]').val(id);
            $('#add-delivery').modal('show');
        });
    });

    /*Deliveru method for product delivery*/
    $(document).on("click", "table#sale-table tbody .add-product-delivery", function(event) {
        var id = $(this).data('id').toString();
        $.get('delivery/create/' + id, function(data) {
            $('#p-dr').text(data[0]);
            $('#p-sr').text(data[1]);
            if (data[2]) {
                $('select[name="status"]').val(data[2]);
                $('.selectpicker').selectpicker('refresh');
            }
            $('input[name="delivered_by"]').val(data[3]);
            $('input[name="recieved_by"]').val(data[4]);
            $('#customer').text(data[5]);
            $('textarea[name="address"]').val(data[6]);
            $('textarea[name="note"]').val(data[7]);
            $('input[name="reference_no"]').val(data[0]);
            $('input[name="sale_id"]').val(id);
            $('#add-product-delivery').modal('show');
        });
    });

    /*Product payment view method*/
    $(document).on("click", "table#sale-table tbody .get-payment", function(event) {
        var id = $(this).data('id').toString();
        $.get('sales/getpayment/' + id, function(data) {
            $(".payment-list tbody").remove();
            var newBody = $("<tbody>");
            payment_date = data[0];
            payment_reference = data[1];
            paid_amount = data[2];
            paying_method = data[3];
            payment_id = data[4];
            payment_note = data[5];
            cheque_no = data[6];
            gift_card_id = data[7];
            change = data[8];
            paying_amount = data[9];
            account_name = data[10];
            account_id = data[11];

            $.each(payment_date, function(index) {
                var newRow = $("<tr>");
                var cols = '';

                cols += '<td>' + payment_date[index] + '</td>';
                cols += '<td>' + payment_reference[index] + '</td>';
                cols += '<td>' + paid_amount[index] + '</td>';
                cols += '<td>' + paying_method[index] + '</td>';
                if (paying_method[index] != 'Paypal')
                    cols += '<td><div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans("file.action")); ?><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu"><li><button type="button" class="btn btn-link edit-btn" data-id="' + payment_id[index] + '" data-clicked=false data-toggle="modal" data-target="#edit-payment"><i class="dripicons-document-edit"></i> <?php echo e(trans("file.edit")); ?></button></li><li class="divider"></li><?php echo e(Form::open(['
                route ' => '
                sale.delete - payment ', '
                method ' => '
                post '] )); ?><li><input type="hidden" name="id" value="' + payment_id[index] + '" /> <button type="submit" class="btn btn-link" onclick="return confirmPaymentDelete()"><i class="dripicons-trash"></i> <?php echo e(trans("file.delete")); ?></button></li><?php echo e(Form::close()); ?></ul></div></td>';
                else
                    cols += '<td><div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans("file.action")); ?><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu"><?php echo e(Form::open(['
                route ' => '
                sale.delete - payment ', '
                method ' => '
                post '] )); ?><li><input type="hidden" name="id" value="' + payment_id[index] + '" /> <button type="submit" class="btn btn-link" onclick="return confirmPaymentDelete()"><i class="dripicons-trash"></i> <?php echo e(trans("file.delete")); ?></button></li><?php echo e(Form::close()); ?></ul></div></td>';

                newRow.append(cols);
                newBody.append(newRow);
                $("table.payment-list").append(newBody);
            });
            $('#view-payment').modal('show');
        });
    });

    $(document).on("click", "table#sale-table .view", function(event) {
        var id = $(this).data('id').toString();
        console.log(id);
        $.get('product_sale/' + id, function(data) {
            console.log(data);
            var htmltext = '<strong><?php echo e(trans("file.Date")); ?>: </strong>' + data[17] + '<br><strong><?php echo e(trans("file.reference")); ?>: </strong>' + data[16] + '<br><strong><?php echo e(trans("file.Sale Status")); ?>: </strong>' + data[18] + '<br><br><div class="row"><div class="col-md-6"><strong><?php echo e(trans("file.From")); ?>:</strong><br>' + data[19] + '<br>' + data[20] + '<br>' + data[21] + '<br>' + data[22] + '<br>' + data[23] + '<br>' + data[24] + '</div><div class="col-md-6"><div class="float-right"><strong><?php echo e(trans("file.To")); ?>:</strong><br>' + data[25] + '<br>' + data[26] + '<br>' + data[27] + '<br>' + data[28] + '</div></div></div>';
            $(".product-sale-list tbody").remove();
            var newBody = $("<tbody>");
            product = data[0];
            qty = data[1];
            unit_price = data[2];
            discount = data[3];
            tax = data[4];
            tax_rate = data[5];
            sub_total = data[6];

            $.each(product, function(index) {
                var newRow = $("<tr>");
                var cols = '';

                cols += '<td>' + index + 1 + '</td>';
                cols += '<td>' + product[index] + '</td>';
                cols += '<td>' + qty[index] + '</td>';
                cols += '<td>' + unit_price[index] + '</td>';
                cols += '<td>' + tax[index] + ' (' + tax_rate[index] + '%)' + '</td>';
                cols += '<td>' + discount[index] + '</td>';
                cols += '<td>' + sub_total[index] + '</td>';

                newRow.append(cols);
                newBody.append(newRow);

            });
            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=4><strong><?php echo e(trans("file.Total")); ?>:</strong></td>';
            cols += '<td>' + data[14] + '</td>';
            cols += '<td>' + data[15] + '</td>';
            cols += '<td>' + data[13] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.Order Tax")); ?>:</strong></td>';
            cols += '<td>' + data[7] + '(' + data[8] + '%)' + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.Order Discount")); ?>:</strong></td>';
            cols += '<td>' + data[9] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.Shipping Cost")); ?>:</strong></td>';
            cols += '<td>' + data[10] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.grand total")); ?>:</strong></td>';
            cols += '<td>' + data[11] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.Paid Amount")); ?>:</strong></td>';
            cols += '<td>' + data[12] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.Due")); ?>:</strong></td>';
            cols += '<td>' + parseFloat(data[11] - data[12]).toFixed(2) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            $("table.product-sale-list").append(newBody);
            $('#sale-content').html(htmltext);
        });

        $('#sale-details').modal('show');
    });

    $('select[name="paid_by_id"]').on("change", function() {
        var id = $(this).val();
        $(".payment-form").off("submit");
        $('input[name="cheque_no"]').attr('required', false);

        if (id == 2) {
            $("#cheque").show();
            $('input[name="cheque_no"]').prop('required', true);
        } else if (id == 3) {
            $("#cheque").hide();
            var deposit = $('input[name="customer_deposit"]').val();
            if ($('input[name="amount"]').val() > $('input[name="customer_deposit"]').val()) {
                alert('Amount exceeds customer deposit! Customer deposit');
            }
        } else {
            $("#cheque").hide();
        }
    });

    $('input[name="amount"]').on("input", function() {
        if ($(this).val() > parseFloat($('input[name="balance"]').val())) {
            alert('Paying amount cannot be bigger than due amount');
            $(this).val('');
        }
        $(".change").text(parseFloat($("#due").val() - $(this).val()).toFixed(2));
        var id = $('select[name="paid_by_id"]').val();
        if (id == 3) {
            if ($('input[name="amount"]').val() > $('input[name="customer_deposit"]').val()) {
                alert('Amount exceeds customer deposit! Customer deposit');
            }
        }
    });

    var table = $('#sale-table,#deposit-table').DataTable({
        dom: '<"row"lfB>rtip',
        buttons: [{
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
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            },
        ],
    });
    var table = $('#service-table').DataTable({
        dom: '<"row"lfB>rtip',
        buttons: [{
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
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            },
        ],
    });
    var table = $('#reminder-table,#comment-table').DataTable({});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wardan/bdtech.wardan.biz/resources/views/customer/print.blade.php ENDPATH**/ ?>