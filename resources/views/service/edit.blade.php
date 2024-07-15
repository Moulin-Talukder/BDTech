@extends('layout.main')

@section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Edit Service</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['services.update',$service_list->id], 'method' => 'put', 'files' => true, 'class' => 'payment-form']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Service Name *</strong> </label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $service_list->name }}" aria-describedby="name" required>
                                        <span class="validation-msg" id="name-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label>Service Code *</strong> </label>
                                        <div class="input-group">
                                            <input type="text" name="code" class="form-control" id="code" value="{{ $service_list->code }}" aria-describedby="code" required>
                                            <div class="input-group-append">
                                                <button id="genbutton" type="button" class="btn btn-sm btn-default" title="{{trans('file.Generate')}}"><i class="fa fa-refresh"></i></button>
                                            </div>
                                        </div>
                                        <span class="validation-msg" id="code-error"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.category')}} *</strong> </label>
                                        <div class="input-group">
                                          <select name="category_id" class="selectpicker form-control sel" data-live-search="true" data-live-search-style="begins" title="Select Category..." required>
                                            @foreach($service_categories as $category)
                                                <option value="{{$category->id}}" {{($category->id == $service_list->category_id) ? 'selected' : ''}}>{{$category->name}}</option>
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Service Tax</strong> </label>
                                        <select name="tax_id" class="form-control selectpicker">
                                            <option value="">No Tax</option>
                                            @foreach($lims_tax_list as $tax)
                                                <option value="{{$tax->id}}" {{($tax->id == $service_list->tax_id) ? 'selected' : ''}}>{{$tax->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.Tax Method')}}</strong> </label> <i class="dripicons-question" data-toggle="tooltip" title="{{trans('file.Exclusive: Poduct price = Actual service price + Tax. Inclusive: Actual service price = Product price - Tax')}}"></i>
                                        <select name="tax_method" class="form-control selectpicker" required>
                                            <option value="1" <?php echo($service_list->tax_method == 1) ? 'selected' : ''; ?>>{{trans('file.Exclusive')}}</option>
                                            <option value="2" <?php echo($service_list->tax_method == 2) ? 'selected' : ''; ?>>{{trans('file.Inclusive')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Service Base Price *</strong> </label>
                                        <input type="number" name="price" value="{{ $service_list->price }}" class="form-control" step="any" min="0" required>
                                        <span class="validation-msg"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Service Details</label>
                                        <textarea name="details" class="form-control" rows="3" required>{!! $service_list->details !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="{{trans('file.update')}}" id="submit-btn" class="btn btn-primary">
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Create Modal -->
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
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
    $("ul#service").siblings('a').attr('aria-expanded','true');
    $("ul#service").addClass("show");
    $("ul#service #service-create-menu").addClass("active");

    $('#genbutton').on("click", function() {
        $.get('../generatecode', function(data) {
            $("input[name='code']").val(data);
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
      branding:false
    });
</script>

@endsection
