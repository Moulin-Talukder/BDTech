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
                        <h4>{{trans('file.Add Customer')}}</h4>
                    </div>
                    <div class="card-body"> 
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'customer.store', 'method' => 'post', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Customer Group')}} *</strong> </label>
                                    <div class="input-group">
                                        <select required class="form-control sel selectpicker" id="customer-group-id" name="customer_group_id" onchange='saveValue(this);'>
                                            @foreach($lims_customer_group_all as $customer_group)
                                            <option @isset($customerGroupModal) @if($customerGroupModal==$customer_group->id) selected
                                                @endif
                                                @endisset value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#customergroupModal" title=""><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="validation-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Customer Priority')}} *</strong> </label>
                                    <div class="input-group">
                                        <select required class="form-control sel selectpicker" id="priority_id" name="priority_id" onchange='saveValue(this);'>
                                            @foreach($lims_priority_all as $priority)
                                            <option @isset($customerPriorityModal) @if($customerPriorityModal==$priority->id) selected
                                                @endif
                                                @endisset value="{{$priority->id}}">{{$priority->priority}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button id="" type="button" class="btn btn-sm" data-toggle="modal" data-target="#customerPriorityModal" title=""><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="validation-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Company Name')}} *</label>
                                    <input type="text" name="company_name" class="form-control" required>
                                </div> 
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Designation')}}</label>
                                    <input type="text" name="designation" class="form-control">
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

                            <div class="col-md-6">
                            <label>{{trans('file.Note')}}</label>
                            <textarea name="first_comment" rows="4" class="form-control"></textarea>
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
                        <div class="form-group">
                            <input type="hidden" name="pos" value="0">
                            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="customergroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'customer_group.store', 'method' => 'post']) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Customer Group')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <form>
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
                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                    </div>
                </form>
            </div>

            {{ Form::close() }}
        </div>
    </div>
</div>


<div id="customerPriorityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'priority.store', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Add Priority</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
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
                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<script type="text/javascript">
    $("ul#crm").siblings('a').attr('aria-expanded', 'true');
    $("ul#crm").addClass("show");
    $("ul#crm #customer-list-menu").addClass("active");

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


    //$("#name").val(getSavedValue("name"));
    //$("#customer-group-id").val(getSavedValue("customer-group-id"));

    function saveValue(e) {
        var id = e.id; // get the sender's id to save it.
        var val = e.value; // get the value.
        localStorage.setItem(id, val); // Every time user writing something, the localStorage's value will override.
    }
    //get the saved value function - return the value of "v" from localStorage.
    function getSavedValue(v) {
        if (!localStorage.getItem(v)) {
            return ""; // You can change this to your defualt value.
        }
        return localStorage.getItem(v);
    }

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    var previewFile = function(event) {
        var preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.onload = function() {
            URL.revokeObjectURL(preview.src) // free memory
        }
    };
</script>
@endsection