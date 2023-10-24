@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row top-space ">
        @foreach (array_chunk($products->all(), 3) as $chunk)
            <div class="col-md-4">
                @foreach ($chunk as $product)
                    <div class="card mb-4 custom-card">
                        <div class="center-div">
                            <img src="{{ asset($product->image) }}" class="card-img-top resized-card-image"
                                alt="{{ $product->pdct_name }}">
                        </div>

                        <div class="card-body txt-center">
                            <h5 class="card-title" style="font-size: 1.5rem; font-weight: bold;">{{ $product->pdct_name }}
                            </h5>
                            <p class="card-text" style="font-size: 1rem;">{{ $product->pdct_description }}</p>
                            <p class="card-text" style="font-size: 1.2rem; color: #007BFF;">Price:
                                Rs.{{ $product->pdct_price }}</p>
                            <p class="card-text">Available Quantity: {{ $product->pdct_qty }}</p>
                            <p class="card-text">Created: {{ $product->created_at }}</p>
                            <p class="card-text">Last Modified: {{ $product->updated_at }}</p>
                            <a href="#" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
