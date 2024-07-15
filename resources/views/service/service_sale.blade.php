@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
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
                        <h4>{{trans('Add Service Sale')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'service.sale.store', 'method' => 'post', 'files' => true, 'class' => 'payment-form']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.customer')}} *</label>
                                            <div class="input-group">
                                                <select required name="customer_id" id="customer_id" class="selectpicker sel form-control" data-live-search="true" data-live-search-style="begins" title="Select customer...">
                                                    <?php $deposit = []; ?>
                                                    @foreach($lims_customer_list as $customer)
                                                    <?php $deposit[$customer->id] = $customer->deposit - $customer->expense; ?>
                                                    <option @isset($saleModalcategory) @if($saleModalcategory==$customer->id) selected
                                                        @endif
                                                        @endisset value="{{$customer->id}}">{{$customer->company_name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#createModal" title=""><i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <span class="validation-msg"></span>
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
                                            <input type="text" name="service_code_name" id="lims_servicecodeSearch" placeholder="Please type Service code and select..." class="form-control" />
                                        </div>
                                    </div>
                                    
                                        <div class="input-group-append">
                                            <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#addRemoveIp" title=""><i class="fa fa-plus"></i>
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
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <strong>{{trans('file.Shipping Cost')}}</strong>
                                            </label>
                                            <input type="number" name="shipping_cost" class="form-control" min="0" step="any" />
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
                                                <input type="number" name="paid_amount" class="form-control" id="paid-amount" min="0" step="any" />
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

                        <button type="button" name="update_btn" class="btn btn-primary">{{trans('file.update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- Create Modal -->
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'customer.store', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Category')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Customer Group')}} *</strong> </label>
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

                <input type="hidden" name="returntoservicesale" value="1">

                <div class="form-group">
                    <input type="hidden" name="pos" value="0">
                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<!-- Create service Modal -->
<div id="addRemoveIp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'services.store', 'method' => 'post', 'files' => true, 'class' => 'payment-form']) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('Add Service')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Service Name *</strong> </label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Service Code *</strong> </label>
                            <div class="input-group">
                                <input type="text" name="code" class="form-control" id="code" aria-describedby="code" required>
                                <div class="input-group-append">
                                    <button id="genbutton" type="button" class="btn btn-sm btn-default" title="{{trans('file.Generate')}}"><i class="fa fa-refresh"></i></button>
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
                                <select name="category_id" required class="selectpicker form-control sel" data-live-search="true" data-live-search-style="begins" title="Select Category...">
                                    @foreach($service_categories as $category)
                                    <option @isset($serviceModalcategory) @if($serviceModalcategory==$category->id) selected
                                        @endif
                                        @endisset value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#catModal" title=""><i class="fa fa-plus"></i>
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
                            <label>{{trans('file.Tax Method')}}</strong> </label> <i class="dripicons-question" data-toggle="tooltip" title="{{trans('file.Exclusive: Poduct price = Actual service price + Tax. Inclusive: Actual service price = Product price - Tax')}}"></i>
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
                            <textarea name="details" id="details" cols="30" rows="10"></textarea>
                            @error('details')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <input type="hidden" name="returntoservice" value="1">

                <div class="form-group">
                    <input type="submit" value="{{trans('file.submit')}}" id="submit-btn" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>


<!-- Create category Modal -->
<div id="catModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => 'categories.store', 'method' => 'post', 'files' => true]) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Category')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
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
              <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
            </div>
        </div>
        {{ Form::close() }}
      </div>
    </div>
</div>

<script type="text/javascript">
    $("ul#service").siblings('a').attr('aria-expanded', 'true');
    $("ul#service").addClass("show");
    $("ul#service #service-sale-menu").addClass("active");

    $("#payment").hide();
    $(".card-element").hide();
    $("#cheque").hide();

    $('#genbutton').on("click", function() {
        $.get('generatecode', function(data) {
            $("input[name='code']").val(data);
        });
    });


    $(document).ready(function() {
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

        $(document).on('click', '#remove_contact', function() {
            $('#new_row').remove();
            x--;
        });
    });

    $(".user-input").hide();

    $('input[name="user"]').on('change', function() {
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
    var deposit = <?php echo json_encode($deposit) ?>;
    //alert(deposit);
    // array data with selection
    var service_price = [];
    var service_discount = [];
    var tax_rate = [];
    var tax_name = [];
    var tax_method = [];


    <?php $serviceArray = []; ?>
    var service_code = [@foreach($services as $service)
        <?php
        $serviceArray[] = $service->code . ' (' . $service->name . ')';
        ?>
        @endforeach
        <?php
        echo  '"' . implode('","', $serviceArray) . '"';
        ?>
    ];

    $('#lims_servicecodeSearch').on('input', function() {
        var customer_id = $('#customer_id').val();
        temp_data = $('#lims_servicecodeSearch').val();
        if (!customer_id) {
            $('#lims_servicecodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            alert('Please select Customer!');
        }

    });

    //Change quantity
    $("#myTable").on('input', '.qty', function() {
        rowindex = $(this).closest('tr').index();
        if ($(this).val() < 1 && $(this).val() != '') {
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(1);
            alert("Quantity can't be less than 1");
        }
        calculateRowProductData($(this).val(), true);
    });

    //Delete product
    $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
        rowindex = $(this).closest('tr').index();
        service_price.splice(rowindex, 1);
        service_discount.splice(rowindex, 1);
        tax_rate.splice(rowindex, 1);
        tax_name.splice(rowindex, 1);
        tax_method.splice(rowindex, 1);
        $(this).closest("tr").remove();
        calculateTotal();
    });

    //Edit product
    $("table.order-list").on("click", ".edit-service", function() {
        rowindex = $(this).closest('tr').index();
        //alert(rowindex);
        edit();
    });

    var lims_servicecodeSearch = $('#lims_servicecodeSearch');

    lims_servicecodeSearch.autocomplete({
        
        source: function(request, response) {
            var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(service_code, function(item) {
                return matcher.test(item);
                console.log(8);
            }));
        },
        select: function(event, ui) {
            var data = ui.item.value;
            $.ajax({
                type: 'GET',
                url: 'service_search_sale',
                data: {
                    data: data
                },
                success: function(data) {
                    console.log(0);
                    var flag = 1;
                    $(".service-code").each(function() {
                        if ($(this).text() == data[1]) {
                            alert('duplicate input is not allowed!')
                            flag = 0;
                        }
                    });
                    $("input[name='service_code_name']").val('');
                    if (flag) {
                        var newRow = $("<tr>");
                        var cols = '';
                        cols += '<td>' + data[0] + '<button type="button" class="edit-service btn btn-link" data-toggle="modal" data-target="#editModal"> <i class="dripicons-document-edit"></i></button></td>';
                        cols += '<td class="service-code">' + data[1] + '</td>';
                        cols += '<td><input type="number" class="form-control qty" name="qty[]" value="1" step="any" required /></td>';
                        cols += '<td class="net_unit_price"><input type="number" class="form-control price" name="net_unit_price[]" value="' + data[2] + '" step="any" required/></td>';
                        cols += '<td class="discount">0.00</td>';
                        cols += '<td class="tax"></td>';
                        cols += '<td class="sub-total"></td>';
                        cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger">{{trans("file.delete")}}</button></td>';
                        cols += '<input type="hidden" class="service-code" name="service_code[]" value="' + data[1] + '"/>';
                        cols += '<input type="hidden" class="service-id" name="service_id[]" value="' + data[6] + '"/>';
                        cols += '<input type="hidden" class="discount-value" name="discount[]" />';
                        cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data[3] + '"/>';
                        cols += '<input type="hidden" class="tax-value" name="tax[]" />';
                        cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';

                        newRow.append(cols);
                        $("table.order-list tbody").append(newRow);

                        service_price.push(parseFloat(data[2]));
                        service_discount.push('0.00');
                        tax_rate.push(parseFloat(data[3]));
                        tax_name.push(data[4]);
                        tax_method.push(data[5]);
                        rowindex = newRow.index();
                        //alert(tax_rate);
                        calculateRowProductData(1);
                    }
                }
            });
        }
    });

    function edit() {
        var row_service_name = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(1)').text();
        var row_service_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
        $('#modal_header').text(row_service_name + '(' + row_service_code + ')');

        var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
        $('input[name="edit_qty"]').val(qty);

        var tax_name_all = <?php echo json_encode($tax_name_all) ?>;
        tex = tax_name_all.indexOf(tax_name[rowindex]);
        $('select[name="edit_tax_rate"]').val(tex);
        $('input[name="edit_discount"]').val(parseFloat(service_discount[rowindex]).toFixed(2));
        row_service_price = service_price[rowindex];

        $('input[name="edit_unit_price"]').val(row_service_price.toFixed(2));
        $('.selectpicker').selectpicker('refresh');
    }

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
        service_discount[rowindex] = $('input[name="edit_discount"]').val();
        service_price[rowindex] = edit_unit_price;

        calculateRowProductData(edit_qty, false);

        $('#editModal').modal('hide');
    });


    function calculateRowProductData(quantity) {
        var row_service_tax_rate = tax_rate[rowindex];
        var row_service_price = service_price[rowindex];

        if (tax_method[rowindex] == 1) {
            var net_unit_price = row_service_price - service_discount[rowindex];
            var tax = net_unit_price * quantity * (tax_rate[rowindex] / 100);
            var sub_total = (net_unit_price * quantity) + tax;

        } else {
            var net_unit_price = row_service_price - service_discount[rowindex];
            var tax = net_unit_price * quantity * (tax_rate[rowindex] / 100);
            var sub_total = (net_unit_price * quantity);
        }

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(service_price[rowindex]);
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(service_price[rowindex]);

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(5)').text((service_discount[rowindex] * quantity).toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value').val((service_discount[rowindex] * quantity).toFixed(2));

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(6)').text(tax.toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(7)').text(sub_total.toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed(2));

        calculateTotal();

    }

    function calculateTotal() {
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

        //total qty
        var total_qty = 0;
        $(".qty").each(function() {
            total_qty += parseFloat($(this).val());
        });
        $("#total-qty").text(total_qty.toFixed(2));
        $('input[name="total_qty"]').val(total_qty.toFixed(2));
        //alert(total_qty);
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
        //alert(total_qty);
        var subtotal = parseFloat($('#total').text());
        var order_tax = parseFloat($('select[name="order_tax_rate"]').val());
        var order_discount = parseFloat($('input[name="order_discount"]').val());
        var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());

        //alert(subtotal);
        if (!order_discount)
            order_discount = 0.00;
        if (!shipping_cost)
            shipping_cost = 0.00;

        item = ++item + '(' + total_qty + ')';
        order_tax = (subtotal - order_discount) * (order_tax / 100);
        var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;

        $('#item').text(item);
        $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
        $('#subtotal').text(subtotal.toFixed(2));
        $('#order_tax').text(order_tax.toFixed(2));
        $('input[name="order_tax"]').val(order_tax.toFixed(2));
        $('#order_discount').text(order_discount.toFixed(2));
        $('#shipping_cost').text(shipping_cost.toFixed(2));
        $('#grand_total').text(grand_total.toFixed(2));
        if ($('select[name="payment_status"]').val() == 4) {
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
    $('select[name="order_tax_rate"]').on("change", function() {
        calculateGrandTotal();
    });

    $('select[name="payment_status"]').on("change", function() {
        var payment_status = $(this).val();
        if (payment_status == 3 || payment_status == 4) {
            $("#paid-amount").prop('disabled', false);
            $("#payment").show();
            $("#paid-amount").prop('required', true);
            if (payment_status == 4) {
                $("#paid-amount").prop('disabled', true);
                $('input[name="paid_amount"]').val($('input[name="grand_total"]').val());
            }
        } else {
            $("#paid-amount").prop('required', false);
            $('input[name="paid_amount"]').val('');
            $("#payment").hide();
        }
    });

    $('select[name="paid_by_id"]').on("change", function() {
        var id = $(this).val();
        $(".payment-form").off("submit");
        $('input[name="cheque_no"]').attr('required', false);

        if (id == 2) {
            $("#cheque").show();
            $('input[name="cheque_no"]').prop('required', true);
        } else {
            $("#cheque").hide();
            if (id == 3) {
                if ($('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()]) {
                    alert('Amount exceeds customer deposit! Customer deposit : ' + deposit[$('#customer_id').val()]);
                }
            }
        }
    });

    $('input[name="paid_amount"]').on("input", function() {
        if ($(this).val() > parseFloat($('#grand_total').text())) {
            alert('Paying amount cannot be bigger than grand total');
            $(this).val('');
        }
        $("#change").text(parseFloat($("#grand_total").text() - $(this).val()).toFixed(2));
        var id = $('select[name="paid_by_id"]').val();
        if (id == 3) {
            if ($('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()])
                alert('Amount exceeds customer deposit! Customer deposit : ' + deposit[$('#customer_id').val()]);
        } 

    });

    // $(document).on('submit', '.payment-form', function(e) {
    //     var rownumber = $('table.order-list tbody tr:last').index();
    //     if (rownumber < 0) {
    //         alert("Please insert product to order table!")
    //         e.preventDefault();
    //     } else if ($('select[name="payment_status"]').val() == 3 && parseFloat($("#paid-amount").val()) == parseFloat($('input[name="grand_total"]').val())) {
    //         alert('Paying amount equals to grand total! Please change payment status.');
    //         e.preventDefault();
    //     } else
    //         $("#paid-amount").prop('disabled', false);
    // });
</script>
@endsection
@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

@endsection