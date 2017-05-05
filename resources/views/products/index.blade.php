@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">


            <div class="panel panel-primary">
                <div class="panel-heading">Search Product</div>
                <div class="panel-body">
                    <form action="{{ route('products.index')}}">
                        <div class="row">                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('search_category','Category') !!}
                                    {!! Form::select('search_category', $categories, Request::get('search_category'), ['placeholder' => 'Select Category','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'category_id']); !!}                            
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('search_state','State') !!}
                                    {!! Form::select('search_state', $states, Request::get('search_state'), ['placeholder' => 'Select State','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'state_id']); !!}                            
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('search_brand','Brand') !!}
                                    {!! Form::select('search_brand', $brands, Request::get('search_brand'), ['placeholder' => 'Select Brand','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'brand_id']); !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('search_anything','By Product Name/Desc') !!}
                                    {!! Form::text('search_anything',Request::get('search_anything'),['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group" style="padding-top: 25px">
                                    <button type="submit" class="btn btn-success">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('search_subcategory','Subcategory') !!}
                                    {!! Form::select('search_subcategory', [], null, ['placeholder' => 'Select Subcategory','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'subcategory_id']); !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('search_area','Area') !!}
                                    {!! Form::select('search_area', [], null, ['placeholder' => 'Select Area','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'area_id']); !!}                          
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="panel panel-warning">
                <div class="panel-heading">Manage Products</div>

                <div class="panel-body" style="overflow-x: auto;">

                    <a href="{{ route('products.create') }}" class="btn btn-warning" style="margin-bottom: 15px">Create Product</a>
                    
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Description</th>
                                <th>Price</th>
                                <th>Location</th>
                                <th>Condition</th>
                                <th>Subcategory</th>
                                <th>Brand</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    {{ $product->product_name}}
                                </td>
                                <td>
                                    {{ $product->product_description}}
                                </td>
                                <td>
                                    {{ $product->product_price}}
                                </td>
                                <td>
                                    {{ $product->area->area_name}}, {{$product->state->state_name}}
                                </td>
                                <td>
                                    {{ $product->condition}}
                                </td>
                                <td>
                                    {{ $product->subcategory->subcategory_name}}
                                </td>
                                <td>
                                    {{ $product->brand->brand_name}}
                                </td>
                                <td>
                                    {{ $product->user->name}}
                                </td>
                                <td>
                                    <a href="{{ route('products.edit',$product->id) }}" class="btn btn-info">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript">
    $( document ).ready(function() {

        $( "#state_id" ).change(function() {
            var state_id = $(this).val();

            getStateAreas(state_id);
           
        });

        var selected_state_id = '{{ Request::get('search_state') }}';

        if (selected_state_id.length>0) {

            getStateAreas(selected_state_id);
        }

        function getStateAreas(state_id) {
            var ajax_url = '/products/areas/' + state_id;


            $.get( ajax_url, function( data ) {
                
                // console.log(data)

                $('#area_id').empty().append('<option value="">Select Area</option');

                $.each(data, function(area_id,area_name) {

                    $('#area_id').append('<option value='+area_id+'>'+area_name+'</option');
                });
                
                var selected_area_id = '{{ Request::get('search_area') }}';
                if (selected_area_id.length>0) {

                $('#area_id').val(selected_area_id);
                }

            });
        }

        //subcategory
        $( "#state_id" ).change(function() {
            var state_id = $(this).val();

            getStateAreas(state_id);
           
        });

        var selected_state_id = '{{ Request::get('search_state') }}';

        if (selected_state_id.length>0) {

            getStateAreas(selected_state_id);
        }

        function getStateAreas(state_id) {
            var ajax_url = '/products/areas/' + state_id;


            $.get( ajax_url, function( data ) {
                
                // console.log(data)

                $('#area_id').empty().append('<option value="">Select Area</option');

                $.each(data, function(area_id,area_name) {

                    $('#area_id').append('<option value='+area_id+'>'+area_name+'</option');
                });
                
                var selected_area_id = '{{ Request::get('search_area') }}';
                if (selected_area_id.length>0) {

                $('#area_id').val(selected_area_id);
                }

            });
        }

    });

</script>

@endsection