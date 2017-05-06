@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Create Products</div>

                <div class="panel-body">
                    @if($errors->all())
                    <div class="alert alert-danger" role="alert">
                        <p style="font-weight: bold;">please fix :</p>
                            <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                            </ul>
                    </div>
                    @endif


                    {!! Form::open(['route' => 'products.store','files' => true]) !!}
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : false}}">
                            {!! Form::label('category_id','Category') !!}
                            {!! Form::select('category_id', $categories, null, ['placeholder' => 'Select Category','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'category_id']); !!}
                            
                        </div>

                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : false}}">
                            {!! Form::label('subcategory_id','Subcategory') !!}
                            {!! Form::select('subcategory_id', [], null, ['placeholder' => 'Select Subcategory','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'subcategory_id']); !!}
                            
                        </div>
                        <div class="form-group {{ $errors->has('state_id') ? 'has-error' : false}}">
                            {!! Form::label('state_id','State') !!}
                            {!! Form::select('state_id', $states, null, ['placeholder' => 'Select State','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'state_id']); !!}
                            
                        </div>
                        <div class="form-group {{ $errors->has('area_id') ? 'has-error' : false}}">
                            {!! Form::label('area_id','Area') !!}
                            {!! Form::select('area_id', [], null, ['placeholder' => 'Select Area','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'area_id']); !!}
                            
                        </div>

                        <div class="form-group {{ $errors->has('brand_id') ? 'has-error' : false}}">
                            {!! Form::label('brand_id','Brand') !!}
                            {!! Form::select('brand_id', $brands, null, ['placeholder' => 'Select Brand','class'=>'form-control','style'=>'background-color: #99ff99','id'=>'brand_id']); !!}
                            
                        </div>
                        <div class="form-group {{ $errors->has('product_name') ? 'has-error' : false}}">
                            {!! Form::label('product_name','Product Name') !!}
                            {!! Form::text('product_name','',['class'=>'form-control']); !!}
                        </div>

                        <div class="form-group {{ $errors->has('product_description') ? 'has-error' : false}}">
                            {!! Form::label('product_description','Product Description') !!}
                            {!! Form::textarea('product_description','',['class'=>'form-control',]); !!}
                        </div>

                        <div class="form-group {{ $errors->has('product_price') ? 'has-error' : false}}">
                            {!! Form::label('product_price','Product Price') !!}
                            {!! Form::text('product_price','',['class'=>'form-control',]); !!}
                        </div>

                        <div class="form-group {{ $errors->has('condition') ? 'has-error' : false}}">
                            {!! Form::label('condition','Product Condition') !!}<br>
                            {!! Form::radio('condition','new',true); !!}New
                            {!! Form::radio('condition','used',false); !!}used
                        </div>

                        <div class="form-group {{ $errors->has('product_image') ? 'has-error' : false}}">
                            {!! Form::label('product_image','Product image') !!}
                            {!! Form::file('product_image') !!}
                        </div>

                        <div class="form-group">
                            
                            <button type="submit" class="btn btn-primary">SUBMIT</button>

                            <a href="{{ route('my_products') }}" class="btn btn-danger">CANCEL</a>

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
        // console.log( "now at create form" );

        var selected_state_id = '{{ old('state_id') }}';
            console.log(selected_state_id);

        if (selected_state_id.length>0) {
            getStateAreas(selected_state_id);

            
        };
        var selected_category_id = '{{ old('category_id')}}';
        if (selected_category_id.length > 0) {
            getCategorySub(selected_category_id);
        }

        function getStateAreas(state_id) {
            var ajax_url = '/products/areas/' + state_id;


            $.get( ajax_url, function( data ) {
                
                // console.log(data)

                $('#area_id').empty().append('<option value="">Select Area</option');

                $.each(data, function(area_id,area_name) {

                    $('#area_id').append('<option value='+area_id+'>'+area_name+'</option');
                });
                
                var selected_area_id = '{{ old('area_id') }}';
                if (selected_area_id.length>0) {

                $('#area_id').val(selected_area_id);
                }

            });
        }

        $( "#state_id" ).change(function() {
            var state_id = $(this).val();
            console.log(state_id);

            getStateAreas(state_id);
           
        });

        function getCategorySub(category_id) {
            var ajax_url = '/products/subcategories/' + category_id;

            $.get( ajax_url, function( data ) {

                
                // console.log(data)

                $('#subcategory_id').empty().append('<option value="">Select Subcategory</option');

                $.each(data, function(subcategory_id,subcategory_name) {

                    $('#subcategory_id').append('<option value='+subcategory_id+'>'+subcategory_name+'</option');
                });
                
                var selected_subcategory_id = '{{ old('subcategory_id') }}';
                if (selected_subcategory_id.length>0) {

                $('#subcategory_id').val(selected_subcategory_id);
                }

            });
        }

         $( "#category_id" ).change(function() {
            var category_id = $(this).val();
            // console.log(category_id);

            getCategorySub(category_id);

            // var ajax_url = '/products/subcategories/' + category_id;

            // $.get( ajax_url, function( data ) {
                
            //     // console.log(data)

            //     $('#subcategory_id').empty().append('<option value="">Select Subcategory</option');

            //     $.each(data, function(subcategory_id,subcategory_name) {

            //         $('#subcategory_id').append('<option value='+subcategory_id+'>'+subcategory_name+'</option');
            //     });

            // });
        });
    });

</script>

@endsection