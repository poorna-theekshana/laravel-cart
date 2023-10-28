@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->id }}</td>
                        <td>{{ $cartItem->product_id }}</td>
                        <td>{{ $cartItem->quantity }}</td>
                        {{-- <td><img src="{{ asset($product->image) }}" class="card-img-top resized-table-image"
                                    alt="{{ $product->pdct_name }}"></td>
                            <td>
                                <form action="{{ route('product.edit', ['product' => $product]) }}" method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-info">Edit</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('product.delete', ['product' => $product]) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

{{-- 
                    <div>
        {{ $cartItem->product->pdct_name }} - Quantity: {{ $cartItem->quantity }}
        <form action="#" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Remove from Cart</button>
        </form>
    </div> --}}
