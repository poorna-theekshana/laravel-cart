@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit a Product</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <form action="{{route('product.update', ['product' => $product])}}" method="post">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="pdct_name">Name :</label>
            <input type="text" class="form-control" name="pdct_name" placeholder="Product Name" value="{{$product->pdct_name}}" required>
        </div>

        <div class="form-group">
            <label for="pdct_description">Description :</label>
            <input type="text" class="form-control" name="pdct_description" placeholder="Product Description" value="{{$product->pdct_description}}" required>
        </div>

        <div class="form-group">
            <label for="pdct_price">Price : Rs.</label>
            <input type="number" step="any" class="form-control" name="pdct_price" placeholder="Product Price" value="{{$product->pdct_price}}" required>
        </div>

        <div class="form-group">
            <label for="pdct_qty">Quantity :</label>
            <input type="number" class="form-control" name="pdct_qty" placeholder="Product Quantity" value="{{$product->pdct_qty}}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
@endsection
