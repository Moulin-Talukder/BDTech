 <?php $__env->startSection('content'); ?>
    <?php if(session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?></div>
    <?php endif; ?>
    <?php if(session()->has('not_permitted')): ?>
        <div class="alert alert-danger alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
    <?php endif; ?>

    <section>
        <div class="container-fluid">

            <a href="<?php echo e(route('service_quotations.create')); ?>" class="btn btn-info">
                <em class="dripicons-plus"></em> <?php echo e(trans('Add Service Receipt')); ?></a>

        </div>

        <div class="table-responsive">
            <table id="quotation-table" class="table quotation-list">
                <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Date')); ?></th>
                    <th><?php echo e(trans('Quotation No')); ?></th>
                    <th><?php echo e(trans('file.reference')); ?></th>
                    <th><?php echo e(trans('file.customer')); ?></th>
                    <th><?php echo e(trans('file.Supplier')); ?></th>
                    <th><?php echo e(trans('file.Quotation Status')); ?></th>
                    <th>Sale status</th>
                    <th><?php echo e(trans('Added By')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lims_quotation_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    if ($quotation->quotation_status == 1)
                        $status = trans('file.Pending');
                    else
                        $status = trans('file.Sent');
                    ?>
                    <tr class="quotation-link">
                        <td><?php echo e($key); ?></td>
                        <td><?php echo e(date($general_setting->date_format, strtotime($quotation->created_at->toDateString())) . ' '. $quotation->created_at->toTimeString()); ?></td>
                        <td><?php echo e($quotation->quotation_no); ?></td>
                        <td><?php echo e($quotation->reference_no); ?></td>
                        <td><?php echo e($quotation->customer->company_name); ?></td>
                        <?php if($quotation->supplier_id): ?>
                            <td><?php echo e($quotation->supplier->name); ?></td>
                        <?php else: ?>
                            <td>N/A</td>
                        <?php endif; ?>
                        <?php if($quotation->quotation_status == 1): ?>
                            <td>
                                <div class="badge badge-danger"><?php echo e($status); ?></div>
                            </td>
                        <?php else: ?>
                            <td>
                                <div class="badge badge-success"><?php echo e($status); ?></div>
                            </td>
                        <?php endif; ?>
                        <?php if($quotation->sale_status == 1): ?>
                            <td>
                                <div class="badge badge-success">Done</div>
                            </td>
                        <?php else: ?>
                            <td>
                                <div class="badge badge-danger">Cancel</div>
                            </td>
                        <?php endif; ?>

                        <td><?php echo e(Auth::user()->name); ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">

                                    <li>
                                        <button type="button" data-id="<?php echo e($quotation->id); ?>"
                                                onclick="openModal(<?php echo e($quotation->id); ?>)"
                                                class="open-viewModal2 btn btn-link"><i class="fa fa-eye"></i> Sale
                                            status
                                        </button>
                                    </li>
                                    
                                    
                                    
                                    <?php if(in_array("quotes-edit", $all_permission)): ?>
                                        <li>
                                            <a class="btn btn-link"
                                               href="<?php echo e(route('service_quotations.edit', $quotation->id)); ?>"><i
                                                    class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?>

                                            </a></button>
                                        </li>
                                    <?php endif; ?>
                                    <li>
                                        <a class="btn btn-link"
                                           href="<?php echo e(route('service_quotations.receipt', $quotation->id)); ?>"><i
                                                class="dripicons-document"></i> <?php echo e(trans('Receipt')); ?></a></button>
                                    </li>

                                <!-- <li>
                                    <a class="btn btn-link" href="<?php echo e(route('quotation.create_sale', ['id' => $quotation->id])); ?>"><i class="fa fa-shopping-cart"></i> <?php echo e(trans('file.Create Sale')); ?></a></button>
                                </li>
                                <li>
                                    <a class="btn btn-link" href="<?php echo e(route('quotation.create_purchase', ['id' => $quotation->id])); ?>"><i class="fa fa-shopping-basket"></i> <?php echo e(trans('file.Create Purchase')); ?></a></button>
                                </li> -->
                                    <li class="divider"></li>
                                    <?php if(in_array("quotes-delete", $all_permission)): ?>
                                        <?php echo e(Form::open(['route' => ['service_quotations.destroy', $quotation->id], 'method' => 'DELETE'] )); ?>

                                        <li>
                                            <button type="submit" class="btn btn-link" onclick="return confirmDelete()">
                                                <i class="dripicons-trash"></i> <?php echo e(trans('file.delete')); ?></button>
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


    <div id="sale-status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_header" class="modal-title">Sale status</h5>&nbsp;&nbsp;
                    
                    <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form action="<?php echo e(route('service.quotation.sale')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <select name="saleOption" id="saleOption" class="form-control">
                                    <option value="">Select sale option</option>
                                    <option value="1">Done</option>
                                    <option value="2">Cancel</option>

                                </select>
                            </div>

                            <div class="form-group row" id="saleDone">
                                <div class="col-md-4">
                                    <label for="">Price</label>
                                    <input type="text" readonly name="basePrice" id="basePrice" class="form-control"
                                           placeholder="Enter price">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Discount</label>
                                    <input type="number" value="" name="discount" id="discount" class="form-control"
                                           placeholder="Enter price">
                                </div>

                                <input type="hidden" name="service_quotation_id" id="service_quotation_id" >
                                <input type="hidden" name="grand_total" class="grand_total" id="grand_total" >
                                <input type="hidden" name="commission_amount" id="commission_amount" >
                                <input type="hidden" name="tax_amount" id="tax_amount" >
                                <input type="hidden" name="subtotal" id="subtotal_amount" >
                                <div class="col-md-4">

                                    <label><?php echo e(trans('file.Order Tax')); ?></label>
                                    <select id="tax" class="form-control" name="order_tax_rate">
                                        <option value="0">No Tax</option>
                                        <?php $__currentLoopData = $lims_tax_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tax->rate); ?>"><?php echo e($tax->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label><?php echo e(trans('file.Shipping Cost')); ?></label>
                                    <input type="number" id="shipping_cost" name="shipping_cost" class="form-control" step="any"/>
                                </div>

                                <div class="col-md-6">
                                    <label>Commission %</label>
                                    <input type="number" id="commission" name="commission" class="form-control" step="any"/>
                                </div>


                                <div class="col-md-6">

                                    <label><?php echo e(trans('file.Sale Status')); ?> *</label>
                                    <select name="sale_status" class="form-control">
                                        <option value="1"><?php echo e(trans('file.Completed')); ?></option>
                                        <option value="2"><?php echo e(trans('file.Pending')); ?></option>
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <label><?php echo e(trans('file.Payment Status')); ?> *</label>
                                    <select name="payment_status" class="form-control">
                                        <option value="2"><?php echo e(trans('file.Due')); ?></option>
                                        <option value="4"><?php echo e(trans('file.Paid')); ?></option>
                                    </select>

                                </div>

                                <div class="col-md-12">
                                    <label>Note </label>
                                    <textarea class="form-control" name="sale_note" id="" cols="30" rows="5"></textarea>

                                </div>

                                <div class="col-md-12 ">

                                        <table class="table table-bordered table-condensed totals">
                                            <tr>
                                                <td><strong><?php echo e(trans('file.Total')); ?></strong>
                                                    <span class="pull-right" id="subtotal">0.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong><?php echo e(trans('file.Order Discount')); ?></strong>
                                                    <span class="pull-right" id="final_discount">0.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Commission</strong>
                                                    <span class="pull-right" id="final_commission">0.00</span>
                                                </td>
                                            </tr>

                                           <tr>
                                               <td><strong><?php echo e(trans('file.Order Tax')); ?></strong>
                                                   <span class="pull-right" id="order_tax">0.00</span>
                                               </td>
                                           </tr>

                                            <tr>
                                                <td><strong><?php echo e(trans('file.Shipping Cost')); ?></strong>
                                                    <span class="pull-right" id="final_shipping_cost">0.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong><?php echo e(trans('file.grand total')); ?></strong>
                                                    <span class="pull-right grand_total" >0.00</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                            </div>


                            <div>
                                <button class="btn btn-info">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="quotation-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="container mt-3 pb-2 border-bottom">
                    <div class="row">
                        <div class="col-md-3">
                            <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i
                                    class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>
                            <?php echo e(Form::open(['route' => 'quotation.sendmail', 'method' => 'post', 'class' => 'sendmail-form'] )); ?>

                            <input type="hidden" name="quotation_id">
                            <button class="btn btn-default btn-sm d-print-none"><i
                                    class="dripicons-mail"></i> <?php echo e(trans('file.Email')); ?></button>
                            <?php echo e(Form::close()); ?>

                        </div>
                        <div class="col-md-6">
                            <h3 id="exampleModalLabel"
                                class="modal-title text-center container-fluid"><?php echo e($general_setting->site_title); ?></h3>
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close"
                                    class="close d-print-none"><span aria-hidden="true"><i class="dripicons-cross"></i></span>
                            </button>
                        </div>
                        <div class="col-md-12 text-center">
                            <i style="font-size: 15px;"><?php echo e(trans('file.Quotation Details')); ?></i>
                        </div>
                    </div>
                </div>
                <div id="quotation-content" class="modal-body">
                </div>
                <br>
                <table class="table table-bordered product-quotation-list">
                    <thead>
                    <th>#</th>
                    <th><?php echo e(trans('file.product')); ?></th>
                    <th>Qty</th>
                    <th><?php echo e(trans('file.Unit Price')); ?></th>
                    <th><?php echo e(trans('file.Tax')); ?></th>
                    <th><?php echo e(trans('file.Discount')); ?></th>
                    <th><?php echo e(trans('file.Subtotal')); ?></th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="quotation-footer" class="modal-body"></div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $("ul#service_reciept").siblings('a').attr('aria-expanded', 'true');
        $("ul#service_reciept").addClass("show");
        $("ul#service #service-create-menu").addClass("active");

        var all_permission = <?php echo json_encode($all_permission) ?>;
        var quotation_id = [];
        var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function confirmDelete() {
            if (confirm("Are you sure want to delete?")) {
                return true;
            }
            return false;
        }

        $("tr.quotation-link td:not(:first-child, :last-child)").on("click", function () {
            var quotation = $(this).parent().data('quotation');
            quotationDetails(quotation);
        });

        $(".view").on("click", function () {
            var quotation = $(this).parent().parent().parent().parent().parent().data('quotation');
            quotationDetails(quotation);
        });

        $("#print-btn").on("click", function () {
            var divToPrint = document.getElementById('quotation-details');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media  print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">' + divToPrint.innerHTML + '</body>');
            newWin.document.close();
            setTimeout(function () {
                newWin.close();
            }, 10);
        });

        $('#quotation-table').DataTable({
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
            'columnDefs': [
                {
                    "orderable": false,
                    'targets': [0, 8]
                },
                {
                    'render': function (data, type, row, meta) {
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
            'select': {style: 'multi', selector: 'td:first-child'},
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
                    action: function (e, dt, button, config) {
                        datatable_sum(dt, true);
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                        datatable_sum(dt, false);
                    },
                    footer: true
                },
                {
                    extend: 'csv',
                    text: '<?php echo e(trans("file.CSV")); ?>',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    action: function (e, dt, button, config) {
                        datatable_sum(dt, true);
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                        datatable_sum(dt, false);
                    },
                    footer: true
                },
                {
                    extend: 'print',
                    text: '<?php echo e(trans("file.Print")); ?>',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    action: function (e, dt, button, config) {
                        datatable_sum(dt, true);
                        $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                        datatable_sum(dt, false);
                    },
                    footer: true
                },
                {
                    text: '<?php echo e(trans("file.delete")); ?>',
                    className: 'buttons-delete',
                    action: function (e, dt, node, config) {
                        // if (user_verified == '1') {
                            quotation_id.length = 0;
                            $(':checkbox:checked').each(function (i) {
                                if (i) {
                                    var quotation = $(this).closest('tr').data('quotation');
                                    quotation_id[i - 1] = quotation[13];
                                }
                            });
                            if (quotation_id.length && confirm("Are you sure want to delete?")) {
                                $.ajax({
                                    type: 'POST',
                                    url: 'quotations/deletebyselection',
                                    data: {
                                        quotationIdArray: quotation_id
                                    },
                                    success: function (data) {
                                        alert(data);
                                    }
                                });
                                dt.rows({page: 'current', selected: true}).remove().draw(false);
                            }
                            else if (!quotation_id.length)
                                alert('Nothing is selected!');
                        }
                        // else
                        //     alert('This feature is disable for demo!');
                    //}
                },
                {
                    extend: 'colvis',
                    text: '<?php echo e(trans("file.Column visibility")); ?>',
                    columns: ':gt(0)'
                },
            ],
            drawCallback: function () {
                var api = this.api();
                datatable_sum(api, false);
            }
        });

        function datatable_sum(dt_selector, is_calling_first) {
            if (dt_selector.rows('.selected').any() && is_calling_first) {
                var rows = dt_selector.rows('.selected').indexes();

                $(dt_selector.column(7).footer()).html(dt_selector.cells(rows, 7, {page: 'current'}).data().sum().toFixed(2));
            }
            else {
                $(dt_selector.column(7).footer()).html(dt_selector.cells(rows, 7, {page: 'current'}).data().sum().toFixed(2));
            }
        }

        if (all_permission.indexOf("quotes-delete") == -1)
            $('.buttons-delete').addClass('d-none');

        function quotationDetails(quotation) {
            $('input[name="quotation_id"]').val(quotation[13]);
            var htmltext = '<strong><?php echo e(trans("file.Date")); ?>: </strong>' + quotation[0] + '<br><strong><?php echo e(trans("file.reference")); ?>: </strong>' + quotation[1] + '<br><strong><?php echo e(trans("file.Status")); ?>: </strong>' + quotation[2] + '<br><br><div class="row"><div class="col-md-6"><strong><?php echo e(trans("file.From")); ?>:</strong><br>' + quotation[3] + '<br>' + quotation[4] + '<br>' + quotation[5] + '<br>' + quotation[6] + '<br>' + quotation[7] + '<br>' + quotation[8] + '</div><div class="col-md-6"><div class="float-right"><strong><?php echo e(trans("file.To")); ?>:</strong><br>' + quotation[9] + '<br>' + quotation[10] + '<br>' + quotation[11] + '<br>' + quotation[12] + '</div></div></div>';
            $.get('quotations/product_quotation/' + quotation[13], function (data) {
                $(".product-quotation-list tbody").remove();
                var name_code = data[0];
                var qty = data[1];
                var unit_code = data[2];
                var tax = data[3];
                var tax_rate = data[4];
                var discount = data[5];
                var subtotal = data[6];
                var newBody = $("<tbody>");
                $.each(name_code, function (index) {
                    var newRow = $("<tr>");
                    var cols = '';
                    cols += '<td><strong>' + (index + 1) + '</strong></td>';
                    cols += '<td>' + name_code[index] + '</td>';
                    cols += '<td>' + qty[index] + ' ' + unit_code[index] + '</td>';
                    cols += '<td>' + parseFloat(subtotal[index] / qty[index]).toFixed(2) + '</td>';
                    cols += '<td>' + tax[index] + '(' + tax_rate[index] + '%)' + '</td>';
                    cols += '<td>' + discount[index] + '</td>';
                    cols += '<td>' + subtotal[index] + '</td>';
                    newRow.append(cols);
                    newBody.append(newRow);
                });

                var newRow = $("<tr>");
                cols = '';
                cols += '<td colspan=4><strong><?php echo e(trans("file.Total")); ?>:</strong></td>';
                cols += '<td>' + quotation[14] + '</td>';
                cols += '<td>' + quotation[15] + '</td>';
                cols += '<td>' + quotation[16] + '</td>';
                newRow.append(cols);
                newBody.append(newRow);

                var newRow = $("<tr>");
                cols = '';
                cols += '<td colspan=6><strong><?php echo e(trans("file.Order Tax")); ?>:</strong></td>';
                cols += '<td>' + quotation[17] + '(' + quotation[18] + '%)' + '</td>';
                newRow.append(cols);
                newBody.append(newRow);

                var newRow = $("<tr>");
                cols = '';
                cols += '<td colspan=6><strong><?php echo e(trans("file.Order Discount")); ?>:</strong></td>';
                cols += '<td>' + quotation[19] + '</td>';
                newRow.append(cols);
                newBody.append(newRow);

                var newRow = $("<tr>");
                cols = '';
                cols += '<td colspan=6><strong><?php echo e(trans("file.Shipping Cost")); ?>:</strong></td>';
                cols += '<td>' + quotation[20] + '</td>';
                newRow.append(cols);
                newBody.append(newRow);

                var newRow = $("<tr>");
                cols = '';
                cols += '<td colspan=6><strong><?php echo e(trans("file.grand total")); ?>:</strong></td>';
                cols += '<td>' + quotation[21] + '</td>';
                newRow.append(cols);
                newBody.append(newRow);

                $("table.product-quotation-list").append(newBody);
            });
            var htmlfooter = '<p><strong><?php echo e(trans("file.Note")); ?>:</strong> ' + quotation[22] + '</p><strong><?php echo e(trans("file.Created By")); ?>:</strong><br>' + quotation[23] + '<br>' + quotation[24];
            $('#quotation-content').html(htmltext);
            $('#quotation-footer').html(htmlfooter);
            $('#quotation-details').modal('show');
        }

        $('#saleDone').hide();
        $('#saleOption').on('change', function (e) {
            this.value == 1 ? $('#saleDone').show(300) : $('#saleDone').hide(300);
        });

        function saleTotalCalculation(){
            var basePrice = $('#basePrice').val();
            var discount = $('#discount').val();

            if(discount == ''){
                discount = 0.00;
            }

            var total = parseFloat(basePrice) - parseFloat(discount);

            var commission = $('#commission').val();
            var final_commssion = 0.00;

            if(commission != 0){
                final_commssion =  basePrice * (parseFloat(commission) / 100)
                $('#commission_amount').val(final_commssion);
            }

            var tax = $('#tax').val();
            var final_tax = 0.00;

            if(tax != 0){
                final_tax =  parseFloat(basePrice) * (parseFloat(tax) / 100);
                $('#tax_amount').val(final_tax);
            }

            var shipping_cost = $('#shipping_cost').val();
            console.log(shipping_cost);
            if(shipping_cost == ''){
                shipping_cost = 0.00;
            }
            //console.log(shipping_cost);

            var grand_total = (parseFloat(total) + parseFloat(shipping_cost) +
                            parseFloat(final_tax)) - parseFloat(final_commssion);

            //$('#subtotal').html(parseFloat(total).toFixed(2));
            $('#subtotal').html($('#basePrice').val());
            $('#subtotal_amount').val($('#basePrice').val());
            $('#order_tax').html(parseFloat(final_tax).toFixed(2));
            $('#final_discount').html(parseFloat(discount).toFixed(2));
            $('#final_shipping_cost').html(parseFloat(shipping_cost).toFixed(2));
            $('#final_commission').html(parseFloat(final_commssion).toFixed(2));
            $('.grand_total').html(parseFloat(grand_total).toFixed(2));
            $('#grand_total').val(parseFloat(grand_total).toFixed(2));
        }

        $('#tax').on('change',function () {
            saleTotalCalculation();
        });

        $('#salePrice').on('keyup', function () {
            saleTotalCalculation();
        });

        $('#discount').on('input',function () {
            saleTotalCalculation();
        });
        $('#shipping_cost').on('keyup',function () {
            saleTotalCalculation();
        });

        $('#commission').on('keyup',function () {
            saleTotalCalculation();
        });


        function openModal(id) {

            var url = "<?php echo e(route('service_quotations.services.sum', ":id")); ?>";
            url = url.replace(':id', id);
            $('#salePrice').val('');

            $.ajax({
                type: 'GET',
                url: url,

                success: function (data) {
                    $('#basePrice').val(parseFloat(data).toFixed(2));
                    $('#subtotal').html(parseFloat(data).toFixed(2));
                    $('#subtotal_amount').val(parseFloat(data).toFixed(2));
                    $('.grand_total').html(parseFloat(data).toFixed(2));
                    $('#grand_total').val(parseFloat(data).toFixed(2));
                    $('#service_quotation_id').val(id);

                }
            });

            $('#sale-status').modal('show');
        }

        // $(".open-viewModal").on("click",function(){
        //
        //
        // });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wardan\bdtech\resources\views/service_quotation/index.blade.php ENDPATH**/ ?>