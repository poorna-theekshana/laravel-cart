@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a Product</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <form action="{{route('product.store')}}" method="post">
        @csrf
        @method('post')

        <div class="form-group">
            <label for="pdct_name">Name :</label>
            <input type="text" class="form-control" name="pdct_name" placeholder="Product Name" required>
        </div>

        <div class="form-group">
            <label for="pdct_description">Description :</label>
            <input type="text" class="form-control" name="pdct_description" placeholder="Product Description" required>
        </div>

        <div class="form-group">
            <label for="pdct_price">Price : Rs.</label>
            <input type="number" step="any" class="form-control" name="pdct_price" placeholder="Product Price" required>
        </div>

        <div class="form-group">
            <label for="pdct_qty">Quantity :</label>
            <input type="number" class="form-control" name="pdct_qty" placeholder="Product Quantity" required>
        </div>

        <button type="submit" class="btn btn-primary">Add a new product</button>
    </form>
</div>
@endsection
