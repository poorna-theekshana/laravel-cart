<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Products</title>
</head>
<body>
    <h1>Create a Products</h1>
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
        <div>
            <label for="pdct_name">Name :</label>
            <input type="text" name="pdct_name" placeholder="Product Name" required>
        </div>
        <div>
            <label for="pdct_description">Description :</label>
            <input type="text" name="pdct_description" placeholder="Product Desc" required>
        </div>
        <div>
            <label for="pdct_price">Price : Rs. </label>
            <input type="number" step="any" name="pdct_price" placeholder="Product Price" required>
        </div>
        <div>
            <label for="pdct_qty">Quantity :</label>
            <input type="number" name="pdct_qty" placeholder="Product Qty" required>
        </div>
        <div>
            <input type="submit" value="add a new product">
        </div>
    </form>
</body>
</html>