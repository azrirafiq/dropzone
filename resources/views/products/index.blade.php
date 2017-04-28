@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-warning">
                <div class="panel-heading">Manage Products</div>

                <div class="panel-body">

                    <a href="{{ route('products.create') }}" class="btn btn-warning">Create Product</a>
                    
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
                                    {{ $product->area->area_name}},<br>{{$product->state->state_name}}
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
