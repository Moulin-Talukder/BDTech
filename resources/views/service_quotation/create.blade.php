@extends('layout.main') @section('content')
    @if(session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{trans('Add Service Receipt')}}</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic">
                                <small>{{trans('file.The field labels marked with * are required input fields')}}.
                                </small>
                            </p>
                            {!! Form::open(['route' => 'service_quotations.store', 'method' => 'post', 'files' => true, 'class' => 'payment-form']) !!}
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{trans('Quotation No')}} *</label>
                                                <input type="text" name="quotation_no"
                                                       value="{{$quotation}}" readonly
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{trans('Date')}} *</label>
                                                <input type="date" name="date" required class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>{{trans('file.Warehouse')}} *</label>
                                                <select id="warehouse_id" name="warehouse_id" required
                                                        class="selectpicker form-control" data-live-search="true"
                                                        data-live-search-style="begins" title="Select warehouse...">
                                                    @foreach($lims_warehouse_list as $warehouse)
                                                        <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{trans('file.customer')}} *</label>
                                                <div class="input-group">
                                                    <select required name="customer_id" id="customer_id"
                                                            class="selectpicker sel form-control"
                                                            data-live-search="true" data-live-search-style="begins"
                                                            title="Select customer...">
                                                        <?php $deposit = []; ?>
                                                        @foreach($lims_customer_list as $customer)
                                                            <?php $deposit[$customer->id] = $customer->deposit - $customer->expense; ?>
                                                            <option
                                                                @isset($saleModalcategory) @if($saleModalcategory==$customer->id) selected
                                                                @endif
                                                                @endisset value="{{$customer->id}}">{{$customer->company_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button id="" type="button" class="btn btn-sm"
                                                                data-toggle="modal" data-target="#createModal" title="">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span class="validation-msg"></span>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">

                                        </div>
                                    </div>

                                    <div class="form-row align-items-center">

                                        <div class="col-md-10">
                                            <label class="sr-only" for="inlineFormInputGroup">Select Product</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <button class="btn btn-secondary"><i class="fa fa-barcode"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <input type="text" name="service_code_name" id="lims_servicecodeSearch"
                                                       placeholder="Please type Service code and select..."
                                                       class="form-control"/>
                                            </div>
                                        </div>

                                        <div class="input-group-append">
                                            <button id="" type="button" class="btn btn-sm" data-toggle="modal"
                                                    data-target="#addRemoveIp" title=""><i class="fa fa-plus"></i>
                                            </button>
                                        </div>

                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <h5>{{trans('file.Order Table')}} *</h5>
                                            <div class="table-responsive mt-3">
                                                <table id="myTable" class="table table-hover order-list">
                                                    <thead>
                                                    <tr>
                                                        <th>{{trans('file.name')}}</th>
                                                        <th>{{trans('file.Code')}}</th>
                                                        <th><i class="dripicons-trash"></i></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
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
                                                <input type="hidden" name="total_vat" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="hidden" name="total_price" />
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
                                                <input type="hidden" name="pos" value="0" />
                                                <input type="hidden" name="coupon_active" value="0" />
                                            </div>
                                        </div>
                                    </div>  --}}
                                    <div class="row mt-3">
                                        {{-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{trans('file.Order Tax')}}</label>
                                        <select class="form-control" name="order_tax_rate">
                                            <option value="0">No Tax</option>
                                            @foreach($lims_tax_list as $tax)
                                            <option value="{{$tax->rate}}">{{$tax->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <strong>{{trans('file.Order Discount')}}</strong>
                                        </label>
                                        <input type="number" name="order_discount" class="form-control" min="0" step="any" />
                                    </div>
                                </div> --}}

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{trans('file.Status')}}</label>
                                                <select class="form-control" name="quotation_status">
                                                    <option value="1">{{trans('Delivered')}}</option>
                                                    <option value="2">{{trans('Received')}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{trans('Delivary Date')}} *</label>
                                                <input type="date" name="delivary_date" required class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <!-- receipt data -->
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{trans('Bareer Name')}}</label>
                                                <input type="text" name="bareer_name" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    <strong>{{trans('Designation')}}</strong>
                                                </label>
                                                <input type="text" name="designation" class="form-control"/>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    <strong>{{trans('Description')}}</strong>
                                                </label>
                                                <input type="text" name="description" class="form-control"/>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{trans('P.SL')}}</label>
                                                <input type="number" name="p_sl" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>
                                                    <strong>{{trans('Purpose')}}</strong>
                                                </label>
                                                <input type="text" name="purpose" class="form-control"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>
                                                    <strong>{{trans('BD.SL')}}</strong>
                                                </label>
                                                <input type="number" name="bd_sl" class="form-control"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>
                                                    <strong>Warranty</strong>
                                                </label>
                                                <input type="text" name="warranty" class="form-control"/>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{trans('file.Attach Document')}}</label> <i
                                                    class="dripicons-question" data-toggle="tooltip"
                                                    title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                                                <input type="file" name="document" class="form-control"/>
                                                @if($errors->has('extension'))
                                                    <span>
                                        <strong>{{ $errors->first('extension') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div id="payment">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>{{trans('file.Paid By')}}</label>
                                                    <select name="paid_by_id" class="form-control">
                                                        <option value="1">Cash</option>
                                                        <option value="2">Cheque</option>
                                                        <option value="3">Deposit</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>{{trans('file.Paid Amount')}} *</label>
                                                    <input type="number" name="paid_amount" class="form-control"
                                                           id="paid-amount" min="0" step="any"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Due Amount</label>
                                                    <p id="change" class="ml-2">0.00</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="card-element" class="form-control">
                                                    </div>
                                                    <div class="card-errors" role="alert"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="cheque">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{trans('file.Cheque Number')}} *</label>
                                                    <input type="text" name="cheque_no" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{trans('file.Payment Note')}}</label>
                                                <textarea rows="3" class="form-control" name="payment_note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{trans('Note')}}</label>
                                                <textarea rows="5" class="form-control" name="note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary"
                                               id="submit-button">
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container-fluid">
            <table class="table table-bordered table-condensed totals">
                <td><strong>{{trans('file.Items')}}</strong>
        <span class="pull-right" id="item">0.00</span>
        </td>
        <td><strong>{{trans('file.Total')}}</strong>
            <span class="pull-right" id="subtotal">0.00</span>
        </td>
        <td><strong>{{trans('Order VAT')}}</strong>
            <span class="pull-right" id="order_tax">0.00</span>
        </td>
        <td><strong>{{trans('file.Order Discount')}}</strong>
            <span class="pull-right" id="order_discount">0.00</span>
        </td>
        <td><strong>{{trans('file.grand total')}}</strong>
            <span class="pull-right" id="grand_total">0.00</span>
        </td>
        </table>
        </div> --}}

        <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
             class="modal fade text-left">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modal_header" class="modal-title"></h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>{{trans('file.Quantity')}}</label>
                                <input type="number" name="edit_qty" class="form-control" step="any" readonly>
                            </div>
                            <div class="form-group">
                                <label>{{trans('file.Unit Discount')}}</label>
                                <input type="number" name="edit_discount" class="form-control" step="any">
                            </div>
                            <div class="form-group">
                                <label>{{trans('file.Unit Price')}}</label>
                                <input type="number" name="edit_unit_price" class="form-control" step="any">
                            </div>
                            <?php
                            $tax_name_all[] = 'No Tax';
                            $tax_rate_all[] = 0;
                            foreach ($lims_tax_list as $tax) {
                                $tax_name_all[] = $tax->name;
                                $tax_rate_all[] = $tax->rate;
                            }
                            ?>
                            <div class="form-group">
                                <label>{{trans('file.Tax Rate')}}</label>
                                <select name="edit_tax_rate" class="form-control selectpicker">
                                    @foreach($tax_name_all as $key => $name)
                                        <option value="{{$key}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="button" name="update_btn"
                                    class="btn btn-primary">{{trans('file.update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                {{--{!! Form::open(['route' => 'customer.store', 'method' => 'post', 'files' => true]) !!}--}}
                <form id="customer-add-form" action="">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{trans('Add Customer')}}</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <input type="hidden" name="customerAdd" value="1">
                    <div class="modal-body">
                        <p class="italic">
                            <small>{{trans('file.The field labels marked with * are required input fields')}}.</small>
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Customer Group')}} *</strong> </label>
                                    <select required class="form-control" id="customer-group-id"
                                            name="customer_group_id" onchange='saveValue(this);'>
                                        @foreach($lims_customer_group_all as $customer_group)
                                            <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#customergroupModal" title=""><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Customer Priority')}} *</strong> </label>
                                    <select required class="form-control" id="priority_id"
                                            name="priority_id" onchange='saveValue(this);'>
                                        <option name="" id="">Select priority</option>
                                        @foreach($lims_priority_all as $priority)
                                            <option value="{{$priority->id}}">{{$priority->priority}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#customerPriorityModal" title=""><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Company Name')}} *</label>
                                    <input type="text" name="company_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Email')}}</label>
                                    <input type="email" name="email" placeholder="example@example.com"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Phone Number')}} *</label>
                                    <input type="text" name="phone_number" required class="form-control">
                                    @if($errors->has('phone_number'))
                                        <span>
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.VAT Number')}}</label>
                                    <input type="text" name="vat_no" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Factory Address')}} *</label>
                                    <textarea id="factory_address" type="text" class="form-control"
                                              name="factory_address" placeholder="Enter address ..." required
                                              rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Head Office Address')}} *</label>
                                    <textarea id="head_office_address" type="text" class="form-control"
                                              name="head_office_address" placeholder="Enter address ..." required
                                              rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Interest</label>
                                    <select class="form-control" id="interest_id" name="interest_id">
                                        <option value="">No Interest Selected</option>
                                        @foreach($interests as $key => $interest)
                                            <option value="{{ $interest->id }}">{{ $interest->topic }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Image')}}</label>
                                    <input type="file" name="image" onchange="loadFile(event);" class="form-control">
                                    @if($errors->has('image'))
                                        <span>
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <img id="output" width="30%"/>
                            </div>

                            <div class="col-md-12" id="contract_person">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>{{trans('Contract Person')}}</label>
                                            <input type="text" name="contract_person[]" class="form-control"
                                                   placeholder="Enter contract person name">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>{{trans('Phone Number')}}</label>
                                            <input type="text" name="contract_phone[]" class="form-control"
                                                   placeholder="Enter phone number">
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
                                    <label>{{trans('file.Add User')}}</label>&nbsp;
                                    <input type="checkbox" name="user" value="1"/>
                                </div>
                            </div>

                            <div class="col-md-6 user-input">
                                <div class="form-group">
                                    <label>{{trans('file.UserName')}} *</label>
                                    <input type="text" name="name" class="form-control">
                                    @if($errors->has('name'))
                                        <span>
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 user-input">
                                <div class="form-group">
                                    <label>{{trans('file.Password')}} *</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="returntosale" value="1">

                        <div class="form-group">
                            <input type="hidden" name="pos" value="0">
                            <input type="submit" id="addCustomerBtn" value="{{trans('file.submit')}}"
                                   class="btn btn-primary">
                        </div>
                    </div>
                </form>
                {{--{{ Form::close() }}--}}
            </div>
        </div>
    </div>


    <!-- Create service Modal -->
    <div id="addRemoveIp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                {{--{!! Form::open(['route' => 'services.store', 'method' => 'post', 'files' => true, 'class' => 'payment-form']) !!}--}}
                <form action="" id="serviceAddForm">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{trans('Add Service')}}</h5>
                        <button type="button" id="serviceModalCls" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <input type="hidden" name="serviceAdd" value="1">
                    <div class="modal-body">
                        <p class="italic">
                            <small>{{trans('file.The field labels marked with * are required input fields')}}.</small>
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Service Name *</strong> </label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           aria-describedby="name"
                                           required>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Service Code *</strong> </label>
                                    <div class="input-group">
                                        <input type="text" name="code" class="form-control" id="code"
                                               aria-describedby="code" required>
                                        <div class="input-group-append">
                                            <button id="genbutton" type="button" class="btn btn-sm btn-default"
                                                    title="{{trans('file.Generate')}}"><i class="fa fa-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.category')}} *</strong> </label>
                                    <div class="input-group">
                                        <select id="category_id" name="category_id" required class="form-control sel"
                                                data-live-search="true" data-live-search-style="begins"
                                        >
                                            <option value="">Select service category</option>
                                            @foreach($service_categories as $category)
                                                <option
                                                    {{--@isset($serviceModalcategory) @if($serviceModalcategory==$category->id) selected--}}
                                                    {{--@endif--}}
                                                    {{--@endisset --}}
                                                    value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button id="" type="button" class="btn btn-sm" data-toggle="modal"
                                                    data-target="#catModal" title=""><i class="fa fa-plus"></i>
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
                                        @foreach($lims_tax_list as $tax)
                                            <option value="{{$tax->id}}">{{$tax->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('tax_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Tax Method')}}</strong> </label> <i class="dripicons-question"
                                                                                             data-toggle="tooltip"
                                                                                             title="{{trans('file.Exclusive: Poduct price = Actual service price + Tax. Inclusive: Actual service price = Product price - Tax')}}"></i>
                                    <select name="tax_method" class="form-control selectpicker" required>
                                        <option value="1">{{trans('file.Exclusive')}}</option>
                                        <option value="2">{{trans('file.Inclusive')}}</option>
                                    </select>
                                    @error('tax_method')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Service Base Price *</strong> </label>
                                    <input type="number" name="price" class="form-control" step="any" min="0" required>
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Service Details</label>
                                    <textarea class="form-control" name="details" id="details" cols="30"
                                              rows="3"></textarea>
                                    @error('details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="returntoservicereceipt" value="1">

                        <div class="form-group">
                            <input type="submit" id="serviceAddBtn" value="{{trans('file.submit')}}"
                                   class="btn btn-primary">
                        </div>
                    </div>
                </form>
                {{--{{ Form::close() }}--}}
            </div>
        </div>
    </div>


    <!-- Create category Modal -->
    <div id="catModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                {{--{!! Form::open(['route' => 'categories.store', 'method' => 'post', 'files' => true]) !!}--}}
                <form action="" id="service-cat-form">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Category')}}</h5>
                        <button type="button" id="serCatModalRmv" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <input type="hidden" name="supplierSerCat" value="1">
                    <div class="modal-body">
                        <p class="italic">
                            <small>{{trans('file.The field labels marked with * are required input fields')}}.</small>
                        </p>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>{{trans('file.name')}} *</label>
                                {{Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Type category name...','required'))}}
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{trans('file.Parent Category')}}</label>
                                {{Form::select('parent_id',$categories, null, ['class' => 'form-control','placeholder' => 'No Parent Category'])}}
                            </div>
                        </div>
                        <input type="hidden" name="returntoservice" value="1">
                        <div class="form-group">
                            <input type="submit" id="service-cat" value="{{trans('file.submit')}}"
                                   class="btn btn-primary">
                        </div>
                    </div>
                </form>
                {{--{{ Form::close() }}--}}
            </div>
        </div>
    </div>


    <div id="customergroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                {{--{!! Form::open(['route' => 'customer_group.store', 'method' => 'post']) !!}--}}
                <form action="" id="customerGroupForm">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Customer Group')}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <p class="italic">
                        <small>{{trans('file.The field labels marked with * are required input fields')}}.</small>
                    </p>
                    <input type="hidden" id="" name="customerAddGroup" value="1" >
                        <div class="form-group">
                            <label>{{trans('file.name')}} *</label>
                            <input type="text" name="name" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.Percentage')}}(%) *</label>
                            <input type="text" name="percentage" required="required" class="form-control">
                        </div>

                        <input type="hidden" name="returntocustomer" value="1">
                        <div class="form-group">
                            <input type="submit" id="customerGroupBtn" value="{{trans('file.submit')}}" class="btn btn-primary">
                        </div>

                </div>
                </form>
                {{--{{ Form::close() }}--}}
            </div>
        </div>
    </div>


    <div id="customerPriorityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                {{--{!! Form::open(['route' => 'priority.store', 'method' => 'post', 'files' => true]) !!}--}}
                <form action="" id="customerPriorityForm">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">Add Priority</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                    <input type="hidden" id="" name="customerAddPriority" value="1" >
                <div class="modal-body">
                    <p class="italic">
                        <small>{{trans('file.The field labels marked with * are required input fields')}}.</small>
                    </p>
                    <div class="form-group">
                        <label>Priority *</label>
                        {{Form::text('priority',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type priority name...'))}}
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        {{Form::textarea('note',null,array('class' => 'form-control','rows'=>'4', 'placeholder' => 'Type priority note...'))}}
                    </div>

                    <input type="hidden" name="returntocustomer" value="1">

                    <div class="form-group">
                        <input type="submit" id="customerPriorityAddBtn" value="{{trans('file.submit')}}" class="btn btn-primary">
                    </div>
                </div>
                </form>
                {{--{{ Form::close() }}--}}
            </div>
        </div>
    </div>

    <script type="text/javascript">
        console.log(52);
        $("ul#service_reciept").siblings('a').attr('aria-expanded', 'true');
        $("ul#service_reciept").addClass("show");
        $("ul#service #service-create-menu").addClass("active");

        $('#genbutton').on("click", function () {
            $.get('../services/generatecode', function (data) {
                $("input[name='code']").val(data);
            });
        });

            <?php $serviceArray = []; ?>
        var lims_service_code = [@foreach($services as $service)
                <?php
                $serviceArray[] = $service->code . ' (' . $service->name . ')';
                ?>
                @endforeach
                <?php
                echo '"' . implode('","', $serviceArray) . '"';
                ?>
            ];

        var lims_servicecodeSearch = $('#lims_servicecodeSearch');


        lims_servicecodeSearch.autocomplete({

            source: function (request, response) {
                console.log('plk')
                var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
                response($.grep(lims_service_code, function (item) {
                    return matcher.test(item);

                }));
            },
            select: function (event, ui) {
                var data = ui.item.value;
                console.log(data);
                $.ajax({
                    type: 'GET',
                    url: 'getservices',
                    data: {
                        data: data
                    },
                    success: function (data) {
                        console.log('okk')
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
                            cols += '<td>' + data[0] +' </td>';
                            cols += '<td class="service-code">' + data[1] + '</td>';
                            cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger">{{trans("file.delete")}}</button></td>';
                            cols += '<input type="hidden" class="service-code" name="service_code[]" value="' + data[1] + '"/>';
                            cols += '<input type="hidden" class="service-id" name="service_id[]" value="' + data[6] + '"/>';

                            newRow.append(cols);
                            $("table.order-list tbody").append(newRow);

                            // service_price.push(parseFloat(data[2]));
                            // service_discount.push('0.00');
                            // tax_rate.push(parseFloat(data[3]));
                            // tax_name.push(data[4]);
                            // tax_method.push(data[5]);
                            // rowindex = newRow.index();
                            //alert(tax_rate);
                            // calculateRowProductData(1);
                        }
                    }
                });
            }
        });

        //Delete product
        $("table.order-list tbody").on("click", ".ibtnDel", function (event) {
            rowindex = $(this).closest('tr').index();
            // service_price.splice(rowindex, 1);
            // service_discount.splice(rowindex, 1);
            // tax_rate.splice(rowindex, 1);
            // tax_name.splice(rowindex, 1);
            // tax_method.splice(rowindex, 1);
            $(this).closest("tr").remove();
            // calculateTotal();
        });

    </script>

@endsection
@section('scripts') 

    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script type="">


        $("#payment").hide();
        $(".card-element").hide();
        $("#cheque").hide();


        $(document).ready(function () {
            var max_field = 5;
            var wrapper = $("#contract_person");
            var x = 1;
            $("#add_contact").click(function () {
                if (x < max_field) {
                    x++;
                    $(wrapper).append('<div class="row" id="new_row">\
                                    <div class="col-md-5">\
                                        <div class="form-group">\
                                            <label>{{trans('Contract Person')}}</label>\
                                            <input type="text" name="contract_person[]" class="form-control" placeholder="Enter contract person name">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-5">\
                                        <div class="form-group">\
                                            <label>{{trans('Phone Number')}}</label>\
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

            $(document).on('click', '#remove_contact', function () {
                $('#new_row').remove();
                x--;
            });
        });

        $(".user-input").hide();

        $('input[name="user"]').on('change', function () {
            if ($(this).is(':checked')) {
                $('.user-input').show(300);
                $('input[name="name"]').prop('required', true);
                $('input[name="password"]').prop('required', true);
            } else {
                $('.user-input').hide(300);
                $('input[name="name"]').prop('required', false);
                $('input[name="password"]').prop('required', false);
            }
        });


        // array data depend on warehouse
        var service_code = [];
        var service_name = [];
        var service_qty = [];
        var service_type = [];
        var service_id = [];
        var service_list = [];
        var qty_list = [];

        //alert(deposit);
        // array data with selection
        var service_price = [];
        var service_discount = [];
        var tax_rate = [];
        var tax_name = [];
        var tax_method = [];


        $('#lims_servicecodeSearch').on('input', function () {

            var customer_id = $('#customer_id').val();
            var supplier_id = $('#supplier_id').val();
            var warehouse_id = $('#warehouse_id').val();
            temp_data = $('#lims_servicecodeSearch').val();
            // if (!customer_id) {
            //     $('#lims_servicecodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            //     alert('Please select Customer!');
            // }
            //
            // if (!warehouse_id) {
            //     $('#lims_servicecodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            //     alert('Please select Warehouse!');
            // }

        });

        //Change quantity
        // $("#myTable").on('input', '.qty', function () {
        //     rowindex = $(this).closest('tr').index();
        //     if ($(this).val() < 1 && $(this).val() != '') {
        //         $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(1);
        //         alert("Quantity can't be less than 1");
        //     }
        //     calculateRowProductData($(this).val(), true);
        // });

    </script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function saveValue(e) {
            var id = e.id; // get the sender's id to save it.
            var val = e.value; // get the value.
            localStorage.setItem(id, val); // Every time user writing something, the localStorage's value will override.
        }

        $('#customerGroupBtn').on("click", function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('customer_group.store')}}",
                data: $("#customerGroupForm").serialize(),
                success: function (response) {
                    console.log(response);
                    //location.href = '../purchases/create';
                    $('#customer-group-id').append($('<option>', {
                        value: response.id,
                        text: response.name
                    }));
                    $("#customer-group-id").val(response.id).change();
                    $('#customergroupModal').click();
                    $('#customerGroupForm').trigger("reset");


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

        $('#customerPriorityAddBtn').on("click", function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('priority.store')}}",
                data: $("#customerPriorityForm").serialize(),
                success: function (response) {
                    console.log(response);
                    //location.href = '../purchases/create';
                    $('#priority_id').append($('<option>', {
                        value: response.id,
                        text: response.name
                    }));
                    $("#priority_id").val(response.id).change();
                    $('#customerPriorityModal').click();
                    $('#customerPriorityForm').trigger("reset");


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

        $('#addCustomerBtn').on("click", function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('customer.store')}}",
                data: $("#customer-add-form").serialize(),
                success: function (response) {
                    console.log(response);
                    //location.href = '../purchases/create';
                    $('#customer_id').append($('<option>', {
                        value: response.id,
                        text: response.name
                    }));
                    $("#customer_id").val(response.id).change();
                    $('.close').click();
                    $('#customer-add-form').trigger("reset");


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


        $('#service-cat').on("click", function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('categories.store')}}",
                data: $("#service-cat-form").serialize(),
                success: function (response) {
                    console.log(response);
                    //location.href = '../purchases/create';
                    $('#category_id').append($('<option>', {
                        value: response.id,
                        text: response.name
                    }));
                    $("#category_id").val(response.id).change();
                    $('#serCatModalRmv').click();
                    $('#service-cat-form').trigger("reset");


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

        $('#serviceAddBtn').on("click", function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('services.store')}}",
                data: $("#serviceAddForm").serialize(),
                success: function (response) {
                    console.log(response);
                    $.ajax({
                        type: 'GET',
                        url: 'getservices',
                        data: {
                            data: response
                        },
                        success: function (data) {

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
                                cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger">{{trans("file.delete")}}</button></td>';
                                cols += '<input type="hidden" class="service-code" name="service_code[]" value="' + data[1] + '"/>';
                                cols += '<input type="hidden" class="service-id" name="service_id[]" value="' + data[6] + '"/>';

                                newRow.append(cols);
                                $("table.order-list tbody").append(newRow);

                            }
                        }
                    });

                    //location.href = '../purchases/create';

                    $('#serviceModalCls').click();
                    $('#serviceAddForm').trigger("reset");


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


    </script>


@endsection
