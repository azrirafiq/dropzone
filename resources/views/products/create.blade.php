@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Create Products</div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'products.store']) !!}

                        <div class="form-group">
                            {!! Form::label('product_name','Product Name') !!}
                            {!! Form::text('product_name','',['class'=>'form-control']); !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('product_description','Product Description') !!}
                            {!! Form::textarea('product_description','',['class'=>'form-control',]); !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('product_price','Product Price') !!}
                            {!! Form::text('product_price','',['class'=>'form-control',]); !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('condition','Product Condition') !!}<br>
                            {!! Form::radio('condition','new',true); !!}New<br>
                            {!! Form::radio('condition','used',false); !!}used
                        </div>

                        <div class="form-group">
                            {!! form::label('brand_id','Brand') !!}
                            {!! Form::select('brand_id', $brands, null, ['placeholder' => 'Select Brand','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'brand_id']); !!}
                            
                        </div>

                        <div class="form-group">
                            {!! form::label('state_id','State') !!}
                            {!! Form::select('state_id', $states, null, ['placeholder' => 'Select State','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'state_id']); !!}
                            
                        </div>
                        <div class="form-group">
                            {!! form::label('area_id','Area') !!}
                            {!! Form::select('area_id', [], null, ['placeholder' => 'Select Area','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'area_id']); !!}
                            
                        </div>

                        <div class="form-group">
                            {!! form::label('category_id','Category') !!}
                            {!! Form::select('category_id', $categories, null, ['placeholder' => 'Select Category','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'category_id']); !!}
                            
                        </div>

                        <div class="form-group">
                            {!! form::label('subcategory_id','Subcategory') !!}
                            {!! Form::select('subcategory_id', [], null, ['placeholder' => 'Select Subcategory','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'subcategory_id']); !!}
                            
                        </div>

                        <div class="form-group">
                            
                            <button type="submit" class="btn btn-primary">SUbmit</button>

                            <a href="{{ route('products.index') }}" class="btn btn-danger">Cancel</a>

                        </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    
    $( document ).ready(function() {
        console.log( "now at create form" );

        $( "#state_id" ).change(function() {
            var state_id = $(this).val();
            console.log(state_id);

            var ajax_url = '/products/areas/' + state_id;

            $.get( ajax_url, function( data ) {
                
                console.log(data)
            });
        });
    });

</script>

@endsection