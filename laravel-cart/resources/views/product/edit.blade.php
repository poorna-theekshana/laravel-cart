<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Products</title>
</head>
<body>
    <h1>Edit a Products</h1>
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
        <div>
            <label for="pdct_name">Name :</label>
            <input type="text" name="pdct_name" placeholder="Product Name" value="{{$product->pdct_name}}" required>
        </div>
        <div>
            <label for="pdct_description">Description :</label>
            <input type="text" name="pdct_description" placeholder="Product Desc" value="{{$product->pdct_description}}" required>
        </div>
        <div>
            <label for="pdct_price">Price : Rs. </label>
            <input type="number" step="any" name="pdct_price" placeholder="Product Price" value="{{$product->pdct_price}}" required>
        </div>
        <div>
            <label for="pdct_qty">Quantity :</label>
            <input type="number" name="pdct_qty" placeholder="Product Qty" value="{{$product->pdct_qty}}" required>
        </div>
        <div>
            <input type="submit" value="update product">
        </div>
    </form>
</body>
</html>