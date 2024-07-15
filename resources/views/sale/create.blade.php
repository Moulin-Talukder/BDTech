@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section class="forms"> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Add Sale')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'sales.store', 'method' => 'post', 'files' => true, 'class' => 'payment-form']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label>{{trans('file.customer')}} *</label>
                                        <div class="input-group">
                                        <select required name="customer_id" id="customer_id" class=" sel form-control" data-live-search="true" data-live-search-style="begins">
                                            <option value="">Select customer</option>
                                            <?php $deposit = []; ?>
                                                @foreach($lims_customer_list as $customer)
                                                <?php $deposit[$customer->id] = $customer->deposit - $customer->expense; ?>
                                                <option
                                                    {{--@isset($saleModalcategory) --}}
                                                        {{--@if($saleModalcategory == $customer->id)      selected --}}
                                                        {{--@endif --}}
                                                    {{--@endisset --}}
                                                        value="{{$customer->id}}">{{$customer->company_name}}</option>
                                                @endforeach
                                            </select>
                                          <div class="input-group-append">
                                                <button id="" type="button" class="btn btn-sm"         data-toggle="modal" data-target="#createModal"      title=""><i class="fa fa-plus"></i>
                                            </button>
                                          </div>
                                        </div>
                                      <span class="validation-msg"></span>
                                    </div>
                                </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Warehouse')}} *</label>
                                            <select required name="warehouse_id" id="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                @foreach($lims_warehouse_list as $warehouse)
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <strong>{{trans('Carried By')}}</strong>
                                            </label>
                                            <input type="text" name="carried_by" class="form-control" step="any" />
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

                                    {{--<div class="input-group-append">--}}
                                        {{--<button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#productModal" title=""><i class="fa fa-plus"></i>--}}
                                        {{--</button>--}}
                                    {{--</div>--}}

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
                                                        <th>{{trans('file.Quantity')}}</th>
                                                        <th>{{trans('file.Net Unit Price')}}</th>
                                                        <th>{{trans('file.Discount')}}</th>
                                                        <th>{{trans('file.Tax')}}</th>
                                                        <th>{{trans('file.Subtotal')}}</th>
                                                        <th><i class="dripicons-trash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot class="tfoot active">
                                                    <th colspan="2">{{trans('file.Total')}}</th>
                                                    <th id="total-qty">0</th>
                                                    <th></th>
                                                    <th id="total-discount">0.00</th>
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
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>
                                                <strong>{{trans('file.Order Discount')}}</strong>
                                            </label>
                                            <input type="number" name="order_discount" class="form-control" step="any" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>
                                                <strong>Commission %</strong>
                                            </label>
                                            <input type="number" name="commission_rate" id="commission_rate" class="form-control" step="any" />
                                            <input type="hidden" name="commission_amount" id="commission_amount" class="form-control" step="any" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>
                                                <strong>{{trans('file.Shipping Cost')}}</strong>
                                            </label>
                                            <input type="number" name="shipping_cost" class="form-control" step="any" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Attach Document')}}</label> <i class="dripicons-question" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                                            <input type="file" name="document" class="form-control" />
                                            @if($errors->has('extension'))
                                            <span>
                                                <strong>{{ $errors->first('extension') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Sale Status')}} *</label>
                                            <select name="sale_status" class="form-control">
                                                <option value="1">{{trans('file.Completed')}}</option>
                                                <option value="2">{{trans('file.Pending')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Payment Status')}} *</label>
                                            <select name="payment_status" class="form-control">
                                                <option value="1">{{trans('file.Pending')}}</option>
                                                <option value="2">{{trans('file.Due')}}</option>
                                                <option value="3">{{trans('file.Partial')}}</option>
                                                <option value="4">{{trans('file.Paid')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="payment">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{trans('file.Paid By')}}</label>
                                                <select name="paid_by_id" class="form-control">
                                                    <option value="1">Cash</option>
                                                    <option value="2">Gift Card</option>
                                                    <option value="3">Credit Card</option>
                                                    <option value="4">Cheque</option>
                                                    <option value="5">Paypal</option>
                                                    <option value="6">Deposit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{trans('file.Recieved Amount')}} *</label>
                                                <input type="number" name="paying_amount" class="form-control" id="paying-amount" step="any" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{trans('file.Paying Amount')}} *</label>
                                                <input type="number" name="paid_amount" class="form-control" id="paid-amount" step="any" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{trans('file.Change')}}</label>
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
                                    <div class="row" id="gift-card">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> {{trans('file.Gift Card')}} *</label>
                                                <select id="gift_card_id" name="gift_card_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card..."></select>
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
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Sale Note')}}</label>
                                            <textarea rows="5" class="form-control" name="sale_note"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Staff Note')}}</label>
                                            <textarea rows="5" class="form-control" name="staff_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary" id="submit-button">
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-condensed totals">
            <td><strong>{{trans('file.Items')}}</strong>
                <span class="pull-right" id="item">0.00</span>
            </td>
            <td><strong>{{trans('file.Total')}}</strong>
                <span class="pull-right" id="subtotal">0.00</span>
            </td>
            <td><strong>{{trans('file.Order Tax')}}</strong>
                <span class="pull-right" id="order_tax">0.00</span>
            </td>
            <td><strong>{{trans('file.Order Discount')}}</strong>
                <span class="pull-right" id="order_discount">0.00</span>
            </td>
            <td><strong>Commission</strong>
                <span class="pull-right" id="order_commission">0.00</span>
            </td>
            <td><strong>{{trans('file.Shipping Cost')}}</strong>
                <span class="pull-right" id="shipping_cost">0.00</span>
            </td>
            <td><strong>{{trans('file.grand total')}}</strong>
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
                            <label>{{trans('file.Quantity')}}</label>
                            <input type="number" name="edit_qty" class="form-control" step="any">
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
                        <div id="edit_unit" class="form-group">
                            <label>{{trans('file.Product Unit')}}</label>
                            <select name="edit_unit" class="form-control selectpicker">
                            </select>
                        </div>
                        <button type="button" name="update_btn" class="btn btn-primary">{{trans('file.update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- add cash register modal -->
    <!-- <div id="cash-register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'cashRegister.store', 'method' => 'post']) !!}
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Cash Register')}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                    <div class="row">
                        <div class="col-md-6 form-group warehouse-section">
                            <label>{{trans('file.Warehouse')}} *</strong> </label>
                            <select required name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                @foreach($lims_warehouse_list as $warehouse)
                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{trans('file.Cash in Hand')}} *</strong> </label>
                            <input type="number" name="cash_in_hand" required class="form-control">
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div> -->
</section>

<!-- Create Modal -->
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {{--{!! Form::open(['route' => 'customer.store', 'method' => 'post', 'files' => true]) !!}--}}
            <form id="customer-add-form" action="">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('Add Customer')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
                <input type="hidden" name="customerAdd" value="1">
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>{{trans('file.Customer Group')}} *</strong> </label>
                            <select required class="form-control selectpicker" id="customer-group-id" name="customer_group_id" onchange='saveValue(this);'>
                                @foreach($lims_customer_group_all as $customer_group)
                                <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('Customer Priority')}} *</strong> </label>
                            <select required class="form-control selectpicker" id="priority_id" name="priority_id" onchange='saveValue(this);'>
                                @foreach($lims_priority_all as $priority)
                                <option value="{{$priority->id}}">{{$priority->priority}}</option>
                                @endforeach
                            </select>
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
                            <input type="email" name="email" placeholder="example@example.com" class="form-control">
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
                            <textarea id="factory_address" type="text" class="form-control" name="factory_address" placeholder="Enter address ..." required rows="2"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('Head Office Address')}} *</label>
                            <textarea id="head_office_address" type="text" class="form-control" name="head_office_address" placeholder="Enter address ..." required rows="2"></textarea>
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
                        <img id="output" width="30%" />
                    </div>

                    <div class="col-md-12" id="contract_person">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{trans('Contract Person')}}</label>
                                    <input type="text" name="contract_person[]" class="form-control" placeholder="Enter contract person name">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{trans('Phone Number')}}</label>
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
                            <label>{{trans('file.Add User')}}</label>&nbsp;
                            <input type="checkbox" name="user" value="1" />
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
                    <input type="submit" id="addCustomerBtn" value="{{trans('file.submit')}}" class="btn btn-primary">
                </div>
            </div>
            </form>
            {{ Form::close() }}
        </div>
    </div>
</div>



<!-- Product Modal -->
<div id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <form id="product-form">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{trans('Add Product')}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.Product Type')}} *</strong> </label>
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
                                <label>{{trans('file.Product Name')}} *</strong> </label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>
                                <span class="validation-msg" id="name-error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.Product Code')}} *</strong> </label>
                                <div class="input-group">
                                    <input type="text" name="code" class="form-control" id="code" aria-describedby="code" required>
                                    <div class="input-group-append">
                                        <button id="genbuttonProduct" type="button" class="btn btn-sm btn-default" title="{{trans('file.Generate')}}"><i class="fa fa-refresh"></i></button>
                                    </div>
                                </div>
                                <span class="validation-msg" id="code-error"></span>
                            </div>
                        </div>
                        <input type="hidden" name="productPop" value="productPop">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.Barcode Symbology')}} *</strong> </label>
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
                                <label>{{trans('file.Attach File')}} *</strong> </label>
                                <div class="input-group">
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <span class="validation-msg"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.Brand')}}</strong> </label>
                                <div class="input-group">
                                    <select name="brand_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Brand...">
                                        @foreach($lims_brand_list as $brand)
                                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.category')}} *</strong> </label>
                                <div class="input-group">
                                    <select name="category_id" required class="selectpicker form-control sel" data-live-search="true" data-live-search-style="begins" title="Select Category...">
                                        @foreach($lims_category_list as $category)
                                        <option @isset($productModalcategory) @if($productModalcategory==$category->id) selected
                                            @endif
                                            @endisset value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
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
                                    <label>{{trans('file.Product Unit')}} *</strong> </label>
                                    <div class="input-group">
                                        <select required class="form-control selectpicker" name="unit_id">
                                            <option value="" disabled selected>Select Product Unit...</option>
                                            @foreach($lims_unit_list as $unit)
                                            @if($unit->base_unit==null)
                                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="validation-msg"></span>
                                </div>
                                <div class="col-md-4">
                                    <label>{{trans('file.Sale Unit')}}</strong> </label>
                                    <div class="input-group">
                                        <select class="form-control selectpicker" name="sale_unit_id">
                                            <option value="" disabled selected>Select Sale Unit...</option>
                                            @foreach($lims_unit_list as $unit)
                                            @if($unit->base_unit==null)
                                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{trans('file.Purchase Unit')}}</strong> </label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="purchase_unit_id">
                                                <option value="" disabled selected>Select Purchase Unit...</option>
                                                @foreach($lims_unit_list as $unit)
                                                @if($unit->base_unit==null)
                                                <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cost" class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.Product Cost')}} *</strong> </label>
                                <input type="number" name="cost" required class="form-control" step="any">
                                <span class="validation-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.Product Price')}} *</strong> </label>
                                <input type="number" name="price" required class="form-control" step="any">
                                <span class="validation-msg"></span>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="qty" value="0.00">
                            </div>
                        </div>
                        <div id="alert-qty" class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.Alert Quantity')}}</strong> </label>
                                <input type="number" name="alert_quantity" class="form-control" step="any">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('Product VAT')}}</strong> </label>
                                <select name="tax_id" class="form-control selectpicker">
                                    <option value="">No Tax</option>
                                    @foreach($lims_tax_list as $tax)
                                    <option value="{{$tax->id}}">{{$tax->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('VAT Method')}}</strong> </label> <i class="dripicons-question" data-toggle="tooltip" title="{{trans('file.Exclusive: Poduct price = Actual product price + Tax. Inclusive: Actual product price = Product price - Tax')}}"></i>
                                <select name="tax_method" class="form-control selectpicker">
                                    <option value="1">{{trans('file.Exclusive')}}</option>
                                    <option value="2">{{trans('file.Inclusive')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('Item Code')}} *</strong> </label>
                                <div class="input-group">
                                    <input type="text" name="item_code" class="form-control" id="item_code" aria-describedby="item_code" required>
                                    <div class="input-group-append">
                                        <button id="genbuttonItem" type="button" class="btn btn-sm btn-default" title="{{trans('file.Generate')}}"><i class="fa fa-refresh"></i></button>
                                    </div>
                                </div>
                                <span class="validation-msg" id="code-error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('Warranty')}} *</strong> </label>
                                <input type="text" name="warranty" class="form-control" id="warranty" aria-describedby="warranty" required>
                                <span class="validation-msg" id="name-error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{trans('file.Product Image')}}</strong> </label> <i class="dripicons-question" data-toggle="tooltip" title="{{trans('file.You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image.')}}"></i>
                                <div id="imageUpload" class="dropzone"></div>
                                <span class="validation-msg" id="image-error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{trans('file.Product Details')}}</label>
                                <textarea name="product_details" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2" id="diffPrice-option">
                            <h5><input name="is_diffPrice" type="checkbox" id="is-diffPrice" value="1">&nbsp; {{trans('file.This product has different price for different warehouse')}}</h5>
                        </div>
                        <div class="col-md-6" id="diffPrice-section">
                            <div class="table-responsive ml-2">
                                <table id="diffPrice-table" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{trans('file.Warehouse')}}</th>
                                            <th>{{trans('file.Price')}}</th>
                                        </tr>
                                        @foreach($lims_warehouse_list as $warehouse)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="warehouse_id[]" value="{{$warehouse->id}}">
                                                {{$warehouse->name}}
                                            </td>
                                            <td><input type="number" name="diff_price[]" class="form-control"></td>
                                        </tr>
                                        @endforeach
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3" id="variant-option">
                            <h5><input name="is_variant" type="checkbox" id="is-variant" value="1">&nbsp; {{trans('file.This product has variant')}}</h5>
                        </div>
                        <div class="col-md-12" id="variant-section">
                            <div class="col-md-6 form-group mt-2">
                                <input type="text" name="variant" class="form-control" placeholder="{{trans('file.Enter variant seperated by comma')}}">
                            </div>
                            <div class="table-responsive ml-2">
                                <table id="variant-table" class="table table-hover variant-list">
                                    <thead>
                                        <tr>
                                            <th><i class="dripicons-view-apps"></i></th>
                                            <th>{{trans('file.name')}}</th>
                                            <th>{{trans('file.Item Code')}}</th>
                                            <th>{{trans('file.Additional Price')}}</th>
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
                                <h5> {{trans('file.Add Promotional Price')}}</h5>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4" id="promotion_price">
                                    <label>{{trans('file.Promotional Price')}}</label>
                                    <input type="number" name="promotion_price" class="form-control" step="any" />
                                </div>
                                <div class="col-md-4" id="start_date">
                                    <div class="form-group">
                                        <label>{{trans('file.Promotion Starts')}}</label>
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
                                        <label>{{trans('file.Promotion Ends')}}</label>
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
                        <input type="button" value="{{trans('file.submit')}}" id="submit-btnn" class="btn btn-primary">
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
            {!! Form::open(['route' => 'category.store', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Category')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.name')}} *</label>
                        {{Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type category name...'))}}
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Image')}}</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Parent Category')}}</label>
                        {{Form::select('parent_id', $lims_categories, null, ['class' => 'form-control','placeholder' => 'No Parent Category'])}}
                    </div>
                </div>

                <input type="hidden" name="returntopurchase" value="1">

                <div class="form-group">
                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<script type="text/javascript">
    $("ul#sale").siblings('a').attr('aria-expanded', 'true');
    $("ul#sale").addClass("show");
    $("ul#sale #sale-create-menu").addClass("active");

    //var d = "72100265 (Galaxy S9)"



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

    var public_key = <?php echo json_encode($lims_pos_setting_data->stripe_public_key) ?>;
    var currency = <?php echo json_encode($currency) ?>;

    $("#payment").hide();
    $(".card-element").hide();
    $("#gift-card").hide();
    $("#cheque").hide();

    // array data depend on warehouse
    var lims_product_array = [];
    var product_code = [];
    var product_name = [];
    var product_qty = [];
    var product_type = [];
    var product_id = [];
    var product_list = [];
    var qty_list = [];

    // array data with selection
    var product_price = [];
    var product_discount = [];
    var tax_rate = [];
    var tax_name = [];
    var tax_method = [];
    var unit_name = [];
    var unit_operator = [];
    var unit_operation_value = [];
    var gift_card_amount = [];
    var gift_card_expense = [];
    // temporary array
    var temp_unit_name = [];
    var temp_unit_operator = [];
    var temp_unit_operation_value = [];

    var deposit = <?php echo json_encode($deposit) ?>;
    var rowindex;
    var customer_group_rate;
    var row_product_price;
    var pos;
    var role_id = <?php echo json_encode(Auth::user()->role_id) ?>;

    $('.selectpicker').selectpicker({
        style: 'btn-link',
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('select[name="customer_id"]').on('change', function() {
        var id = $(this).val();
        $.get('getcustomergroup/' + id, function(data) {
            customer_group_rate = (data / 100);
        });
    });

    $('select[name="warehouse_id"]').on('change', function() {
        var id = $(this).val();
        $.get('getproduct/' + id, function(data) {
            lims_product_array = [];
            product_code = data[0];
            product_name = data[1];
            product_qty = data[2];
            product_type = data[3];
            product_id = data[4];
            product_list = data[5];
            qty_list = data[6];
            product_warehouse_price = data[7];
            $.each(product_code, function(index) {
                lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
            });
        });
        isCashRegisterAvailable(id);
    });

    $('#lims_productcodeSearch').on('input', function() {
        var customer_id = $('#customer_id').val();
        var warehouse_id = $('#warehouse_id').val();
        temp_data = $('#lims_productcodeSearch').val();
        if (!customer_id) {
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            alert('Please select Customer!');
        } else if (!warehouse_id) {
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
        if ($(this).val() < 1 && $(this).val() != '') {
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(1);
            alert("Quantity can't be less than 1");
        }
        checkQuantity($(this).val(), true);
    });


    //Delete product
    $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
        rowindex = $(this).closest('tr').index();
        product_price.splice(rowindex, 1);
        product_discount.splice(rowindex, 1);
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
        var edit_discount = $('input[name="edit_discount"]').val();
        var edit_qty = $('input[name="edit_qty"]').val();
        var edit_unit_price = $('input[name="edit_unit_price"]').val();

        if (parseFloat(edit_discount) > parseFloat(edit_unit_price)) {
            alert('Invalid Discount Input!');
            return;
        }

        if (edit_qty < 1) {
            $('input[name="edit_qty"]').val(1);
            edit_qty = 1;
            alert("Quantity can't be less than 1");
        }


        var tax_rate_all = <?php echo json_encode($tax_rate_all) ?>;
        tax_rate[rowindex] = parseFloat(tax_rate_all[$('select[name="edit_tax_rate"]').val()]);
        tax_name[rowindex] = $('select[name="edit_tax_rate"] option:selected').text();
        if (product_type[pos] == 'standard') {
            var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
            var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));
            if (row_unit_operator == '*') {
                product_price[rowindex] = $('input[name="edit_unit_price"]').val() / row_unit_operation_value;
            } else {
                product_price[rowindex] = $('input[name="edit_unit_price"]').val() * row_unit_operation_value;
            }
            var position = $('select[name="edit_unit"]').val();
            var temp_operator = temp_unit_operator[position];
            var temp_operation_value = temp_unit_operation_value[position];
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit').val(temp_unit_name[position]);
            temp_unit_name.splice(position, 1);
            temp_unit_operator.splice(position, 1);
            temp_unit_operation_value.splice(position, 1);

            temp_unit_name.unshift($('select[name="edit_unit"] option:selected').text());
            temp_unit_operator.unshift(temp_operator);
            temp_unit_operation_value.unshift(temp_operation_value);

            unit_name[rowindex] = temp_unit_name.toString() + ',';
            unit_operator[rowindex] = temp_unit_operator.toString() + ',';
            unit_operation_value[rowindex] = temp_unit_operation_value.toString() + ',';
        }
        product_discount[rowindex] = $('input[name="edit_discount"]').val();
        checkQuantity(edit_qty, false);
    });

    function isCashRegisterAvailable(warehouse_id) {
        $.ajax({
            url: '../cash-register/check-availability/' + warehouse_id,
            type: "GET",
            success: function(data) {
                if (data == 'false') {
                    $('#cash-register-modal select[name=warehouse_id]').val(warehouse_id);
                    $('.selectpicker').selectpicker('refresh');
                    if (role_id <= 2) {
                        $("#cash-register-modal .warehouse-section").removeClass('d-none');
                    } else {
                        $("#cash-register-modal .warehouse-section").addClass('d-none');
                    }
                    $("#cash-register-modal").modal('show');
                }
            }
        });
    }

    function productSearch(data) {
        //console.log(data);
        $.ajax({
            type: 'GET',
            url: 'lims_product_search',
            data: {
                data: data
            },
            success: function(data) {
                console.log(data);
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
                    cols += '<td class="net_unit_price"></td>';
                    cols += '<td class="discount">0.00</td>';
                    cols += '<td class="tax"></td>';
                    cols += '<td class="sub-total"></td>';
                    cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger">{{trans("file.delete")}}</button></td>';
                    cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data[1] + '"/>';
                    cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[9] + '"/>';
                    cols += '<input type="hidden" class="sale-unit" name="sale_unit[]" value="' + temp_unit_name[0] + '"/>';
                    cols += '<input type="hidden" class="net_unit_price" name="net_unit_price[]" />';
                    cols += '<input type="hidden" class="discount-value" name="discount[]" />';
                    cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data[3] + '"/>';
                    cols += '<input type="hidden" class="tax-value" name="tax[]" />';
                    cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';

                    newRow.append(cols);
                    $("table.order-list tbody").append(newRow);

                    pos = product_code.indexOf(data[1]);
                    if (!data[11] && product_warehouse_price[pos]) {
                        product_price.push(parseFloat(product_warehouse_price[pos] * currency['exchange_rate']) + parseFloat(product_warehouse_price[pos] * currency['exchange_rate'] * customer_group_rate));
                    } else {
                        product_price.push(parseFloat(data[2] * currency['exchange_rate']) + parseFloat(data[2] * currency['exchange_rate'] * customer_group_rate));
                    }
                    product_discount.push('0.00');
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

        $('input[name="edit_discount"]').val(parseFloat(product_discount[rowindex]).toFixed(2));

        var tax_name_all = <?php echo json_encode($tax_name_all) ?>;
        pos = tax_name_all.indexOf(tax_name[rowindex]);
        $('select[name="edit_tax_rate"]').val(pos);

        pos = product_code.indexOf(row_product_code);
        if (product_type[pos] == 'standard') {
            unitConversion();
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
            $("#edit_unit").show();
        } else {
            row_product_price = product_price[rowindex];
            $("#edit_unit").hide();
        }
        $('input[name="edit_unit_price"]').val(row_product_price.toFixed(2));
        $('.selectpicker').selectpicker('refresh');
    }

    function checkQuantity(sale_qty, flag) {
        var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
        pos = product_code.indexOf(row_product_code);
        if (product_type[pos] == 'standard') {
            var operator = unit_operator[rowindex].split(',');
            var operation_value = unit_operation_value[rowindex].split(',');
            if (operator[0] == '*')
                total_qty = sale_qty * operation_value[0];
            else if (operator[0] == '/')
                total_qty = sale_qty / operation_value[0];
            if (total_qty > parseFloat(product_qty[pos])) {
                alert('Quantity exceeds stock quantity!');
                if (flag) {
                    sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                } else {
                    edit();
                    return;
                }
            }
        } else if (product_type[pos] == 'combo') {
            child_id = product_list[pos].split(',');
            child_qty = qty_list[pos].split(',');
            $(child_id).each(function(index) {
                var position = product_id.indexOf(parseInt(child_id[index]));
                if (parseFloat(sale_qty * child_qty[index]) > product_qty[position]) {
                    alert('Quantity exceeds stock quantity!');
                    if (flag) {
                        sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                    } else {
                        edit();
                        flag = true;
                        return false;
                    }
                }
            });
        }

        if (!flag) {
            $('#editModal').modal('hide');
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
        }
        calculateRowProductData(sale_qty);
    }

    function calculateRowProductData(quantity) {
        if (product_type[pos] == 'standard')
            unitConversion();
        else
            row_product_price = product_price[rowindex];

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(5)').text((product_discount[rowindex] * quantity).toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value').val((product_discount[rowindex] * quantity).toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val(tax_rate[rowindex].toFixed(2));

        if (tax_method[rowindex] == 1) {
            var net_unit_price = row_product_price - product_discount[rowindex];
            var tax = net_unit_price * quantity * (tax_rate[rowindex] / 100);
            var sub_total = (net_unit_price * quantity) + tax;

            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(net_unit_price.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(net_unit_price.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(6)').text(tax.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(7)').text(sub_total.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed(2));
        } else {
            var sub_total_unit = row_product_price - product_discount[rowindex];
            var net_unit_price = (100 / (100 + tax_rate[rowindex])) * sub_total_unit;
            var tax = (sub_total_unit - net_unit_price) * quantity;
            var sub_total = sub_total_unit * quantity;

            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(net_unit_price.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(net_unit_price.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(6)').text(tax.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(7)').text(sub_total.toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed(2));
        }

        calculateTotal();
    }

    function unitConversion() {
        var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
        var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));

        if (row_unit_operator == '*') {
            row_product_price = product_price[rowindex] * row_unit_operation_value;
        } else {
            row_product_price = product_price[rowindex] / row_unit_operation_value;
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

        //Sum of discount
        var total_discount = 0;
        $(".discount").each(function() {
            total_discount += parseFloat($(this).text());
        });
        $("#total-discount").text(total_discount.toFixed(2));
        $('input[name="total_discount"]').val(total_discount.toFixed(2));

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
        $('input[name="total_price"]').val(total.toFixed(2));

        calculateGrandTotal();
    }

    function calculateGrandTotal() {

        var item = $('table.order-list tbody tr:last').index();

        var total_qty = parseFloat($('#total-qty').text());
        var subtotal = parseFloat($('#total').text());
        var order_tax = parseFloat($('select[name="order_tax_rate"]').val());
        var order_discount = parseFloat($('input[name="order_discount"]').val());
        var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
        var commission_rate = parseFloat($('input[name="commission_rate"]').val());

        if (!order_discount)
            order_discount = 0.00;
        if (!shipping_cost)
            shipping_cost = 0.00;
        if (!commission_rate)
            commission_rate = 0.00;

        item = ++item + '(' + total_qty + ')';
        order_tax = (subtotal - order_discount) * (order_tax / 100);
        commission_rate = (subtotal ) * (commission_rate / 100);
        var grand_total = (subtotal + order_tax + shipping_cost) - (order_discount + commission_rate) ;

        $('#item').text(item);
        $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
        $('#subtotal').text(subtotal.toFixed(2));
        $('#order_tax').text(order_tax.toFixed(2));
        $('input[name="order_tax"]').val(order_tax.toFixed(2));
        $('#order_discount').text(order_discount.toFixed(2));
        $('#commission_amount').val(commission_rate.toFixed(2));
        $('#order_commission').text(commission_rate.toFixed(2));
        $('#shipping_cost').text(shipping_cost.toFixed(2));

        $('#grand_total').text(grand_total.toFixed(2));
        if ($('select[name="payment_status"]').val() == 4) {
            $('#paying-amount').val('');
            $('#paid-amount').val(grand_total.toFixed(2));
        }
        $('input[name="grand_total"]').val(grand_total.toFixed(2));
    }

    $('input[name="order_discount"]').on("input", function() {
        calculateGrandTotal();
    });

    $('input[name="shipping_cost"]').on("input", function() {
        calculateGrandTotal();
    });

    $('input[name="commission_rate"]').on("input", function() {
        calculateGrandTotal();
    });

    $('select[name="order_tax_rate"]').on("change", function() {
        calculateGrandTotal();
    });

    $('select[name="payment_status"]').on("change", function() {
        var payment_status = $(this).val();
        if (payment_status == 3 || payment_status == 4) {
            $("#paid-amount").prop('disabled', false);
            $("#payment").show();
            $("#paying-amount").prop('required', true);
            $("#paid-amount").prop('required', true);
            if (payment_status == 4) {
                $("#paid-amount").prop('disabled', true);
                $('input[name="paying_amount"]').val($('input[name="grand_total"]').val());
                $('input[name="paid_amount"]').val($('input[name="grand_total"]').val());
            }
        } else {
            $("#paying-amount").prop('required', false);
            $("#paid-amount").prop('required', false);
            $('input[name="paying_amount"]').val('');
            $('input[name="paid_amount"]').val('');
            $("#payment").hide();
        }
    });

    $('select[name="paid_by_id"]').on("change", function() {
        var id = $(this).val();
        $(".payment-form").off("submit");
        $('input[name="cheque_no"]').attr('required', false);
        $('select[name="gift_card_id"]').attr('required', false);
        if (id == 2) {
            $("#gift-card").show();
            $.ajax({
                url: 'get_gift_card',
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="gift_card_id"]').empty();
                    $.each(data, function(index) {
                        gift_card_amount[data[index]['id']] = data[index]['amount'];
                        gift_card_expense[data[index]['id']] = data[index]['expense'];
                        $('select[name="gift_card_id"]').append('<option value="' + data[index]['id'] + '">' + data[index]['card_no'] + '</option>');
                    });
                    $('.selectpicker').selectpicker('refresh');
                }
            });
            $(".card-element").hide();
            $("#cheque").hide();
            $('select[name="gift_card_id"]').attr('required', true);
        } else if (id == 3) {
            $.getScript("../vendor/stripe/checkout.js");
            $(".card-element").show();
            $("#gift-card").hide();
            $("#cheque").hide();
        } else if (id == 4) {
            $("#cheque").show();
            $("#gift-card").hide();
            $(".card-element").hide();
            $('input[name="cheque_no"]').attr('required', true);
        } else {
            $("#gift-card").hide();
            $(".card-element").hide();
            $("#cheque").hide();
            if (id == 6) {
                if ($('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()]) {
                    alert('Amount exceeds customer deposit! Customer deposit : ' + deposit[$('#customer_id').val()]);
                }
            }
        }
    });

    $('select[name="gift_card_id"]').on("change", function() {
        var balance = gift_card_amount[$(this).val()] - gift_card_expense[$(this).val()];
        if ($('input[name="paid_amount"]').val() > balance) {
            alert('Amount exceeds card balance! Gift Card balance: ' + balance);
        }
    });

    $('input[name="paid_amount"]').on("input", function() {
        if ($(this).val() > parseFloat($('input[name="paying_amount"]').val())) {
            alert('Paying amount cannot be bigger than recieved amount');
            $(this).val('');
        } else if ($(this).val() > parseFloat($('#grand_total').text())) {
            alert('Paying amount cannot be bigger than grand total');
            $(this).val('');
        }

        $("#change").text(parseFloat($("#paying-amount").val() - $(this).val()).toFixed(2));
        var id = $('select[name="paid_by_id"]').val();
        if (id == 2) {
            var balance = gift_card_amount[$("#gift_card_id").val()] - gift_card_expense[$("#gift_card_id").val()];
            if ($(this).val() > balance)
                alert('Amount exceeds card balance! Gift Card balance: ' + balance);
        } else if (id == 6) {
            if ($('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()])
                alert('Amount exceeds customer deposit! Customer deposit : ' + deposit[$('#customer_id').val()]);
        }
    });

    $('input[name="paying_amount"]').on("input", function() {
        $("#change").text(parseFloat($(this).val() - $("#paid-amount").val()).toFixed(2));
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

    $(document).on('submit', '.payment-form', function(e) {
        var rownumber = $('table.order-list tbody tr:last').index();
        if (rownumber < 0) {
            alert("Please insert product to order table!")
            e.preventDefault();
        } else if (parseFloat($("#paying-amount").val()) < parseFloat($("#paid-amount").val())) {
            alert('Paying amount cannot be bigger than recieved amount');
            e.preventDefault();
        } else if ($('select[name="payment_status"]').val() == 3 && parseFloat($("#paid-amount").val()) == parseFloat($('input[name="grand_total"]').val())) {
            alert('Paying amount equals to grand total! Please change payment status.');
            e.preventDefault();
        } else
            $("#paid-amount").prop('disabled', false);
    });

    $("ul#sale").siblings('a').attr('aria-expanded', 'true');
    $("ul#sale").addClass("show");
    $("ul#sale li").eq(2).addClass("active");



    //add product script


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
      $.get("{{route('product.gencode')}}", function(data){
        $("input[name='code']").val(data);
      });
    });

    $('#genbuttonItem').on("click", function(){
      $.get("{{route('product.gencode')}}", function(data){
        $("input[name='item_code']").val(data);
      });
    });


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
        url: '{{route('products.store')}}',
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
                            url:"{{route('products.store')}}",
                            data: $("#product-form").serialize(),
                            success:function(response){
                                //location.href = '../purchases/create';
                                //console.log(response);
                                productSearch(response);
                            },

                            error:function(response) {
                              if(response.responseJSON.errors.name) {
                                  $("#name-error").text(response.responseJSON.errors.name);
                              }
                              else if(response.responseJSON.errors.code) {
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
<script>


    $('#addCustomerBtn').on("click", function (e) {
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:"{{route('customer.store')}}",
            data: $("#customer-add-form").serialize(),
            success:function(response){
                console.log(response);
                //location.href = '../purchases/create';
                $('#customer_id').append($('<option>', {
                    value: response.id,
                    text : response.name
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


</script>

@endsection @section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

@endsection
