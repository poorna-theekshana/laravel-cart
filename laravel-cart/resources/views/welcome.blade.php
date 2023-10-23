@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach (array_chunk($products->all(), 3) as $chunk)
            <div class="col-md-4">
                @foreach ($chunk as $product)
                    <div class="card mb-4">
                        <img src="{{ asset('path-to-your-product-image') }}" class="card-img-top" alt="{{ $product->pdct_name }}">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 1.5rem; font-weight: bold;">{{ $product->pdct_name }}</h5>
                            <p class="card-text" style="font-size: 1rem;">{{ $product->pdct_description }}</p>
                            <p class="card-text" style="font-size: 1.2rem; color: #007BFF;">Price: Rs.{{ $product->pdct_price }}</p>
                            <p class="card-text">Available Quantity: {{ $product->pdct_qty }}</p>
                            <p class="card-text">Created: {{ $product->created_at }}</p>
                            <p class="card-text">Last Modified: {{ $product->updated_at }}</p>
                            {{-- <a href="{{ route('product.addToCart', ['product' => $product]) }}" class="btn btn-primary">Add to Cart</a> --}}
                            <!-- Add more buttons or actions as needed -->
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
