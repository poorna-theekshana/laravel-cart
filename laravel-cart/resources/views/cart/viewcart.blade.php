@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Cart Items</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($cartData)
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Image</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartData as $cartItem)
                                        @if ($cartItem['product'])
                                            <tr>
                                                <td>{{ $cartItem['product']->id }}</td>
                                                <td>{{ $cartItem['product']->pdct_name }}</td>
                                                <td>{{ $cartItem['product']->pdct_description }}</td>
                                                <td>{{ $cartItem['product']->pdct_price }}</td>
                                                <td>{{ $cartItem['quantity'] }}</td>
                                                <td><img src="{{ asset($cartItem['product']->image) }}"
                                                        class="card-img-top resized-table-image"
                                                        alt="{{ $cartItem['product']->pdct_name }}"></td>
                                                <td>
                                                    <form
                                                        action="{{ route('cart.delete', ['cartItemId' => $cartItem['cartItemId']]) }}"
                                                        method="post"
                                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <h2 class="text-right">Total Amount: {{ $totalAmount }}</h2>
                            <hr>
                            <form
                                class="btn btn-primary btn-block"
                                action="{{ route('cart.checkout', ['cartItemId' => $cartItem['cartItemId'], 'totalAmount' => $totalAmount]) }}"
                                method="post">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-primary">Checkout</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
