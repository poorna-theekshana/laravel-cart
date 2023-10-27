@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row top-space ">
        @foreach (array_chunk($products->all(), 3) as $chunk)
            @foreach ($chunk as $product)
                <div class="col-md-4 p-3">
                    <div class="card text-center" style="">
                        <img class="card-img-top" src="{{ asset($product->image) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->pdct_name }}</h5>
                            <p class="card-text">{{ $product->pdct_description }}</p>
                            <p class="card-text">Price: {{ $product->pdct_price }}</p>
                            <p class="card-text">Available Quantity: {{ $product->pdct_qty }}</p>
                            <a href="{{ route('cart.addToCart', ['id' => $product->id, 'pdct_name' => $product->pdct_name,'pdct_qty' => 1]) }}" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>

                </div>
            @endforeach
        @endforeach
    </div>
@endsection
